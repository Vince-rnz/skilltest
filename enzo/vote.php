<?php
session_start();
include 'connect.php';

// must be logged in
if(!isset($_SESSION['voterID'])){
    header('location:login.php');
    exit;
}
$voterID = $_SESSION['voterID'];

// check the voter again (active and not yet voted)
$voter = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM voters WHERE voterID=$voterID"));
if($voter['voterStat'] != 'active' || $voter['voted'] == 'Y'){
    session_destroy();
    header('location:login.php');
    exit;
}

$error = '';
if(isset($_POST['submit'])){
    $picked = array();   // posID => list of candID

    $positions = mysqli_query($con, "SELECT * FROM positions WHERE posStat='open'");
    while($p = mysqli_fetch_assoc($positions)){
        $posID = $p['posID'];
        if(isset($_POST['cand'][$posID])){
            $list = $_POST['cand'][$posID];

            // votes must be <= number of vacant positions
            if(count($list) > $p['numOfPositions']){
                $error .= 'You can only vote up to '.$p['numOfPositions'].' candidate(s) for '.$p['posName'].'.<br>';
            }
            $picked[$posID] = $list;
        }
    }

    if(count($picked) == 0){
        $error = 'Please select at least one candidate.';
    }

    if($error == ''){
        foreach($picked as $posID => $list){
            foreach($list as $candID){
                mysqli_query($con, "INSERT INTO votes(posID, voterID, candID)
                VALUES('$posID','$voterID','$candID')");
            }
        }
        // mark the voter as already voted
        mysqli_query($con, "UPDATE voters SET voted='Y' WHERE voterID=$voterID");
        session_destroy();
        header('location:login.php?done=1');
        exit;
    }
}
include 'header.php';
?>

<h3>Vote</h3>
<p>Voter: <b><?php echo $voter['voterFName'].' '.$voter['voterLName']; ?></b>
  <a href="logout.php" class="btn btn-secondary btn-sm ms-2">Logout</a></p>

<?php
if($error != ''){
    echo '<div class="alert alert-danger">'.$error.'</div>';
}
?>

<form method="post">
<?php
$positions = mysqli_query($con, "SELECT * FROM positions WHERE posStat='open' ORDER BY posID");
while($p = mysqli_fetch_assoc($positions)){
    $posID = $p['posID'];

    echo '<div class="card my-3">
      <div class="card-header"><b>'.$p['posName'].'</b> (vote up to '.$p['numOfPositions'].')</div>
      <div class="card-body">';

    $cands = mysqli_query($con, "SELECT * FROM candidates WHERE posID=$posID AND candStat='active'");
    while($c = mysqli_fetch_assoc($cands)){
        echo '<div class="form-check">
          <input class="form-check-input" type="checkbox" name="cand['.$posID.'][]" value="'.$c['candID'].'">
          <label class="form-check-label">'.$c['candFName'].' '.$c['candMName'].' '.$c['candLName'].'</label>
        </div>';
    }

    echo '</div></div>';
}
?>
  <button type="submit" class="btn btn-primary my-3" name="submit"
  onclick="return confirm('Submit your vote? You cannot vote again.')">Submit Vote</button>
</form>

<?php include 'footer.php'; ?>