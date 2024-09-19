<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新增廠商</title>
  <?php
//資料庫連接
try {
    $pdo=new PDO("mysql:host=localhost;dbname=ru;","root","");
} catch (PDOException $err) {
    die("資料庫無法連接");
}
//----------------------------------------------------------------------
?>
</head>
<body>
<body>
<form method="POST" action="R2.php">
<label>新增廠商</label><br>
廠商名稱<input id="FANAME" name="FACNAME"><br>
廠商代號<input id="FACNAME" name="FACNUM"><br>
廠商地址<input id="ADDRESS" name="ADDRESS"><br>
聯絡人<input id="CONTACT" name="CONTACT"><br>
聯絡電話<input id="PHONE" name="PHONE"><br>
其他資訊<input id="INFOR" name="INFOR"><br>
<button type="submit" class="btn btn-primary" id="subR2" name="subR2">送出</button>
</form>
<form method="POST" action="rindex.php">
<button type="submit" class="btn btn-primary" id="subR6" name="subR6">返回</button>
</form>
<form method="POST" action="R13.php">
<button type="submit" class="btn btn-primary" id="subR7" name="subR7">更改廠商</button>
</form>
<?php
//新增廠商
if(isset($_POST["subR2"])&&$_POST["FACNAME"]!="")
{
  $stmt=$pdo->prepare('select * from manufacturer where MANUFACTNAME=? and MANUFACTNUM	=?');
  $stmt->execute(array($_POST["FACNAME"],$_POST["FACNUM"]));
  $rows=$stmt->fetchAll();
  if(count($rows)<=0)
  {
    $stmt=$pdo->prepare('insert into manufacturer(MANUFACTNAME,MANUFACTNUM,ADDRESS,CONTACT,PHONE,INFORMATION) values(?,?,?,?,?,?)');
    $stmt->execute(array($_POST["FACNAME"],$_POST["FACNUM"],$_POST["ADDRESS"],$_POST["CONTACT"],$_POST["PHONE"],$_POST["INFOR"]));
  }
  else
  {
    echo"廠商已新增";
  }
}
//-------------------------
?>
</body>
</body>
</html>