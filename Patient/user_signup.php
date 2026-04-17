<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/dbconnection.php');

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if(isset($_SESSION['success'])) {
    echo "<script>alert('".$_SESSION['success']."');</script>";
    unset($_SESSION['success']);
}

if(isset($_SESSION['error'])) {
    echo "<script>alert('".$_SESSION['error']."');</script>";
    unset($_SESSION['error']);
}

if(isset($_POST['submit'])) {

        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['error'] = "CSRF attack detected";
        header("Location: user_signup.php");
        exit;
    }

    
    $fname = $_POST['fname'];
    $mobno = $_POST['mobno'];
    $email = $_POST['email'];
    

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $ret = "SELECT Email FROM tbluser WHERE Email=:email";
    $query = $dbh->prepare($ret);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    if($query->rowCount() == 0) {

        $sql = "INSERT INTO tbluser
                (FullName, Mobile, Email, Password)
                VALUES (:fname, :mobno, :email, :password)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobno', $mobno, PDO::PARAM_INT);
                $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        if($dbh->lastInsertId()) {
            $_SESSION['success'] = "You have signup successfully";
            header("Location: user_signup.php");
            exit;
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again";
            header("Location: user_signup.php");
            exit;
        }

    } else {
        $_SESSION['error'] = "Email already exists. Try again";
        header("Location: user_signup.php");
        exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>DAMS - Signup Page</title>

    <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/misc-pages.css">
</head>

<body class="simple-page">

<div id="back-to-home">
    <a href="../index.php" class="btn btn-outline btn-default">
        <i class="fa fa-home animated zoomIn"></i>
    </a>
</div>

<div class="simple-page-wrap">

    <div class="simple-page-logo animated swing">
        <span style="color: white"><i class="fa fa-gg"></i></span>
        <span style="color: white">DAMS</span>
    </div>

    <div class="simple-page-form animated flipInY" id="login-form">
        <h4 class="form-title text-center">Sign Up</h4>

        <form method="post">

            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <div class="form-group">
                <input type="text" class="form-control" name="fname" placeholder="Full Name" required>
            </div>

            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="mobno" placeholder="Mobile"
                       maxlength="10" pattern="[0-9]+" required>
            </div>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <input type="submit" class="btn btn-primary" name="submit" value="Register">

        </form>
    </div>

    <div class="simple-page-footer">
        <p>
            <small>Do you have an account?</small>
            <a href="user_login.php">SIGN IN</a>
        </p>
    </div>

</div>

</body>
</html>