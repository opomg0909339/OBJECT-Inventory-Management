<!DOCTYPE html>
<html lang="en">
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ru;", "root", "");
} catch (PDOException $err) {
    die("Database connection failed");
}
session_start();
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>修改訂單</title>
</head>
<body>
<form method="POST" action="R10.php" >
    訂單編號<input ID='NUM' name='NUM' ></input>
    <button type="submit" id="send" name="send">送出</button>
</form>
<form method="POST" action="rindex.php" >
    <button type="back" id="back" name="send">返回</button>
</form>       
    <form method="POST" action="R11.php" >
    <?php
    if(isset($_POST["send"]))
      {
        $stmt = $pdo->prepare('SELECT * FROM `order` WHERE OD = ?');
        $stmt->execute(array($_POST["NUM"]));
        $rows = $stmt->fetchAll();
        if (count($rows) > 0) 
        {
          $_SESSION['OD']=$_POST["NUM"];
          header("Location:http://localhost/R11.php");
        }
        else
          {
            echo "查無此訂單";
          }
      } 
    ?>
    </form>
</body>