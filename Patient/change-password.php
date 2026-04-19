<?php
session_start();
include('includes/dbconnection.php');

// Session check
if (empty($_SESSION['damsid'])) {
    header('location:logout.php');
    exit;
}

// Form submit
if(isset($_POST['submit']))
{
    $eid = $_SESSION['damsid'];
    $currentpassword = $_POST['currentpassword'];
    $newpassword = $_POST['newpassword'];

    // Fetch password
    $sql = "SELECT Password FROM tbluser WHERE ID=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':eid', $eid, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if($result && password_verify($currentpassword, $result->Password)) {

        $newhashed = password_hash($newpassword, PASSWORD_DEFAULT);

        $con = "UPDATE tbluser SET Password=:newpassword WHERE ID=:eid";
        $chngpwd1 = $dbh->prepare($con);
        $chngpwd1->bindParam(':eid', $eid, PDO::PARAM_INT);
        $chngpwd1->bindParam(':newpassword', $newhashed, PDO::PARAM_STR);
        $chngpwd1->execute();

        $_SESSION['success'] = "Password changed successfully";
        header("Location: index.php");
        exit;

    } else {
        echo '<script>alert("Your current password is wrong")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Change Password</title>

    <!-- ONLY REQUIRED CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
    function checkpass(){
        if(document.changepassword.newpassword.value != document.changepassword.confirmpassword.value){
            alert('Passwords do not match');
            return false;
        }
        return true;
    }
    </script>
</head>

<body>

<?php include_once('includes/header.php'); ?>

<div class="container" style="margin-top:100px; max-width:600px;">
    <h3 class="text-center">Change Password</h3>
    <hr>

    <form name="changepassword" method="post" onsubmit="return checkpass();">

        <div class="form-group">
            <label>Current Password</label>
            <input type="password" name="currentpassword" class="form-control" required>
        </div>

        <div class="form-group">
            <label>New Password</label>
            <input type="password" name="newpassword" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="confirmpassword" class="form-control" required>
        </div>

        <div class="text-center">
            <button type="submit" name="submit" class="btn btn-success">Change Password</button>
        </div>

    </form>
</div>
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>