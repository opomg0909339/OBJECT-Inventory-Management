<!DOCTYPE html>
<html lang="en">
<?php
// Database connection
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
    <title>廠商退貨</title>
    </head>
    <body>
    <form method="POST" action="R18.php">
    <label>廠商退貨</label><br>
    廠商名稱<input id="NAME" name="NAME"><br>
    廠商代號<input id="NUM" name="NUM"><br>
    <button type="submit" class="btn btn-primary" id="subR8" name="subR8">建立</button>
    </form>
    <form method="POST" action="rindex.php">
    <button type="submit" class="btn btn-primary" id="back" name="back">返回</button>
    </form>
    <form method="POST" action="R19.php" action="R20.php" action="R21.php">
    <?php
    date_default_timezone_set('Asia/Taipei');
    $time = date("Ymd", time());
    $orderID ="3". $time . "001";
    //echo "Current Order ID: " . $orderID . "<br>";

    if (isset($_POST["subR8"])) 
    {
        if(isset($_POST["NAME"]) && $_POST["NAME"]!="") 
        {
            $stmt = $pdo->prepare('SELECT * FROM manufacturer WHERE MANUFACTNAME like ? ');
            $stmt->execute(array($_POST["NAME"].'%'));
        } 
        elseif(isset($_POST["NUM"]) && $_POST["NUM"]!="") 
        {
            $stmt = $pdo->prepare('SELECT * FROM manufacturer WHERE MANUFACTNUM like ?');
            $stmt->execute(array($_POST["NUM"].'%'));
        }
        $row = $stmt->fetchAll();
        foreach($row as $r)
        {
            $stmt = $pdo->prepare('SELECT * FROM `purchase` WHERE OD = ?');
            $stmt->execute(array($orderID));
            $rows = $stmt->fetchAll();
            if (count($rows) <= 0) {
                $stmt = $pdo->prepare('INSERT INTO `purchase` (OD,MANUFACTNUM,MANUFACTNAME,ADDRESS,PHONE,DATE) VALUES (?,?,?,?,?,?)');
                $stmt->execute(array($orderID,$r['MANUFACTNUM'],$r['MANUFACTNAME'],$r['ADDRESS'],$r['PHONE'],$time));
                $_SESSION['OD']=$orderID;
                echo "New order created with ID: " . $orderID;
            } else {
                $maxID = $pdo->query("SELECT MAX(OD) FROM `purchase`")->fetchColumn();
                $newOrderID = $maxID + 1;
                $stmt = $pdo->prepare('INSERT INTO `purchase` (OD,MANUFACTNUM,MANUFACTNAME,ADDRESS,PHONE,DATE) VALUES (?,?,?,?,?,?)');
                $stmt->execute(array($newOrderID,$r['MANUFACTNUM'],$r['MANUFACTNAME'],$r['ADDRESS'],$r['PHONE'],$time));
                $_SESSION['OD']=$newOrderID;
                echo "New order created with ID: " . $newOrderID;
            }
        }
        header("Location:http://localhost/R19.php");
    }
    ?>
    </form>
</body>
</html>