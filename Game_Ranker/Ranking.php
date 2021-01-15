<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">GameRanker</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Ranking.php">Ranking</a>
        </li>
        <?php
        error_reporting(0);
        session_start();
        if(!isset($_SESSION["gatekeeper"])){
          echo '<li class="nav-item">
          <a class="nav-link" href="Account/Login.php">Login</a>
        </li>';
        echo '<li class="nav-item">
          <a class="nav-link" href="Account/Signup.php">Sign up</a>
        </li>';
        }else{
          echo '<li class="nav-item">
          <a class="nav-link" href="Account/Logout.php">Log out</a>
        </li>';
        }
        ?>
      </ul>
      <form class="d-flex" method="get" action="Search.php">
        <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<?php
include("functions.php");

connect();
$platform = $_GET["platform"];
$genre = $_GET["Genre"];
$year = $_GET["year"];
$publisher = $_GET["publisher"];

if($publisher == NULL){
  $publisher = '%';
} else{
  $publisher = $publisher."%";
}

if($year == NULL){
  $year= '%';
}else{
  $year = $year."%";
}

if($platform == NULL){
  $platform = '%';
}else{
  $platform = $platform."%";
}

if($genre == NULL){
  $genre = '%';
}else{
  $genre = $genre."%";
}
?>
    
</body>
<h1 style="text-align: center;">Welcome to the Ranking page</h1>
<p style="text-align: center;">Select region of sales</p>


  <form class="row g-3" method="get" action="Ranking.php">
  <div class="col-auto">
    <label for="Platform" class="visually-hidden">Platform</label>
    <input type="text" class="form-control" id="Platform"  name="platform" placeholder="Platform">
  </div>
  <div class="col-auto">
    <label for="inputgenre" class="visually-hidden">Genre</label>
    <input type="text" class="form-control" id="inputgenre"  name="Genre" placeholder="Genre">
  </div>
  <div class="col-auto">
    <label for="inputyear" class="visually-hidden">Year</label>
    <input type="number" class="form-control" id="inputyear" name="year" placeholder="Year">
  </div>
  <div class="col-auto">
    <label for="inputPublish" class="visually-hidden">Publisher</label>
    <input type="text" class="form-control" id="inputPublish" name="publisher" placeholder="Publisher">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Submit</button>
  </div>
</form>';

 <div class="row">
    <?php
    ranker("Global_Sales", $platform, $year,$genre,$publisher)
    ?>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</html>


