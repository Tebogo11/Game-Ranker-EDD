<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>

<?php
include("functions.php");
$ID = $_GET["GameID"];
connect();
searchByID($ID);
?>
<?php
if(isset($_SESSION["gatekeeper"])){
echo '
<form method="post" action="GameInfo.php?GameID='.$ID.'">
<div class="mb-3">
  <label for="commentSection" class="form-label">Comment</label>
  <textarea class="form-control" id="commentsection" name="comment" rows="3"></textarea>
</div>
<button type="submit" class="btn btn-primary">Comment</button>
</form>';}else
{
  echo '<div class="alert alert-warning" role="alert">
  You have to be <a href="Account/Login.php" class="alert-link">logged in</a> to leave a comment
</div>';
}
?>
<?php
$comment = $_POST["comment"];
$name = $_SESSION["gatekeeper"];
if($name == null){
  
}else{
  addComment($ID,$comment,$name);
}
?>
<?php

searchComments($ID);
?>
</body>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</html>

