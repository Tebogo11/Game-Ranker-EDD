<?php

function connect()
{
  //Deveplment connection details
  #$host = "localhost:8111";
  #$db = "video_games_sales";
  #$user = "root";
  #$pass =  "root";

  //Remote Connection details
  $host = "sql7.freemysqlhosting.net";
  $db = "sql7387156";
  $user = "sql7387156";
  $pass =  "hntqaxadQx";


   $connection = new PDO("mysql:host=$host;dbname=$db", "$user", "$pass");
    return $connection;
}

function Top3()
{
    //use query search safty

$conn = connect();
$result =$conn->query("SELECT * FROM gamesales where Platform LIKE '%' AND Year LIKE '%' ORDER BY 'Global_Sales' DESC LIMIT 4");
$count = 0;
while($row = $result->fetch())
{
    $count++;
    echo "
    <div class='col-sm-6'>
      <div class='card'>
        <div class='card-body'>
        <h1>Rank".$count."</h1>
          <h5 class='card-title'>Name : ".$row["Name"]."</h5>
          <p>Platform : ".$row["Platform"]." | Publisher : ".$row["Publisher"]. "</p> 
          <p>Genre : ".$row["Genre"] ." | Year of Release : ".$row["Year"]." </p>
          <p>Global Sales: $".$row["Global_Sales"]."M</p>
          <a href='GameInfo.php?GameID=".$row["Rank"]."' class='btn btn-primary'>Comments</a>
        </div>
      </div>
    </div>";

}
}

function ranker($region, $platform, $year,$genre,$publisher){
$conn = connect();

$result =$conn->prepare("SELECT * FROM gamesales WHERE Platform LIKE ? AND Year LIKE ? AND Genre LIKE ? AND Publisher LIKE ? ORDER BY ? DESC LIMIT 100");
$result->execute([$platform, $year,$genre,$publisher,$region]);
$count = 0;
while($row = $result->fetch())
{
    $count++;
    echo "
    <div class='col-sm-6'>
      <div class='card'>
        <div class='card-body'>
        <h1>Rank".$count."</h1>
          <h5 class='card-title'>Name : ".$row["Name"]."</h5>
          <p>Platform : ".$row["Platform"]." | Publisher : ".$row["Publisher"]. "</p> 
          <p>Genre : ".$row["Genre"] ." | Year of Release : ".$row["Year"]." </p>
          <p>Global Sales: $".$row["Global_Sales"]."M</p>
          <a href='GameInfo.php?GameID=".$row["Rank"]."'  class='btn btn-primary'>Comments</a>
        </div>
      </div>
    </div>";

}

}

function search($search){
    $conn = connect();
    $search = $search."%";
    $result =$conn->prepare("SELECT * FROM gamesales WHERE Platform LIKE ? OR Name LIKE ? OR Year LIKE ? OR Genre LIKE ? OR Publisher OR ? ORDER BY 'Global_Sales' DESC LIMIT 100");
    $result->execute([$search, $search,$search,$search,$search]);
    $count = 0;
    while($row = $result->fetch())
    {
        $count++;
        echo "<div class='card text-center'>
        <div class='card-header'>
          ".$row["Genre"]."
        </div>
        <div class='card-body'>
          <h5 class='card-title'>".$row["Name"]."</h5>
          <p class='card-text'>".$row["Platform"]."</p>
          <p class='card-text'>".$row["Publisher"]."</p>
          <a href='GameInfo.php?GameID=".$row["Rank"]."' class='btn btn-primary'>Comments</a>
        </div>
        <div class='card-footer text-muted'>
          ".$row["Year"]."
        </div>
      </div>";
    
    }
    
    }

function searchByID($ID){
    $conn = connect();
    $result =$conn->prepare("SELECT * FROM gamesales WHERE Rank = ? ");
    $result->execute([$ID]);
     $count = 0;
     while($row = $result->fetch())
    {
        $count++;
        echo "<div class='card text-center'>
         <div class='card-header'>
          ".$row["Genre"]."
         </div>
        <div class='card-body'>
            <h5 class='card-title'>".$row["Name"]."</h5>
            <p class='card-text'>".$row["Platform"]."</p>
            <p class='card-text'>".$row["Publisher"]."</p>
        </div>
        <div class='card-footer text-muted'>
            ".$row["Year"]."
         </div>
        </div>";
        
    }
 }

  

function searchComments($gameID){
    $conn = connect();
    $result =$conn->prepare("SELECT * FROM comments WHERE GameID = ? ");
    $result->execute([$gameID]);
     while($row = $result->fetch())
    {
     
        echo "<div class='card'>
        <div class='card-header'>
        ".$row["username"]."
        </div>
        <div class='card-body'>
        <blockquote class='blockquote mb-0'>
        <p>".$row["Comment"]."</p>
        <footer class='blockquote-footer'>@".$row["DateEntry"]."<cite title='Source Title'> | ".$Gname."</cite></footer>
        ";
        if(isset($_SESSION["gatekeeper"]) && $_SESSION["gatekeeper"] == $row["username"]){
        echo " <a class='btn btn-danger' href='delete.php?Gid=".$gameID."&Cid=".$row["commentID"]."' role='button'>Delete</a>";
        }
        echo "
        </blockquote>
        </div>
        </div>";
        
        
    }
}

function addComment($GameID,$comment,$name){
  
  $conn = connect();
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $result = $conn->prepare("INSERT INTO comments (GameID,username,Comment) VALUES (?,?,?)");
  $result->execute([$GameID,$name,$comment]);


}

?>

