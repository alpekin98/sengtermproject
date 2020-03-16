<?php

session_start();
error_reporting(E_ERROR | E_PARSE);

$serverName = 'localhost';
$userName = 'root';
$passCode = '1234qweR...';
$dbName = 'sengproje';
$conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $passCode);

if (isset($_SESSION['user_Username'])) {
    $sUsername = $_SESSION['user_Username'];
    $userid = $_SESSION['user_UserID'];
} else {
    $sUsername = null;
}
?>

<!doctype html>
<html lang="en-US">
<head>
    <title>AI Customer Support</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Fonts-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

    <!-- Style Sheet-->
    <script src="/js/jquery.min.js"></script>
    <link rel='stylesheet' id='responsive-css-css' href='/css/res.css' type='text/css' media='all' />
    <link rel='stylesheet' id='main-css-css' href='/css/site.css' type='text/css' media='all' />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/js/site.js"></script>
</head>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-inverse navbar-custom" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="/SENGPROJECT/index.php">My Startup Ideas</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php if ($sUsername == null): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/SENGPROJECT/register.php" role="button" aria-expanded="false" aria-controls="collapseExample">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/SENGPROJECT/login.php" role="button" aria-expanded="false" aria-controls="collapseExample">Login</a>
                    </li>
                <?php endif;?>
                <?php if ($sUsername !== null): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/SENGPROJECT/profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/SENGPROJECT/addidea.php">Add Idea</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/SENGPROJECT/logout.php">Logout</a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>
