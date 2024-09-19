<?php
// 資料庫連接
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ru;", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // 設定 PDO 的錯誤模式為例外拋出
} catch (PDOException $err) {
    die("資料庫無法連接");
}
?>

<html>
<head>
</head>
<body>
    
<form method="POST" action="">
    <label>查詢廠商</label><br>
    廠商名稱<input id="NAME" name="NAME"><br>
    廠商代號<input id="NUM" name="NUM"><br>
    <button type="submit" class="btn btn-primary" id="subR6" name="subR6">搜尋</button>
</form>

<form method="POST" action="rindex.php">
    <button type="submit" class="btn btn-primary" id="back" name="back">返回</button>
</form>

<?php
// 查詢店家
if(isset($_POST["subR6"])) 
{
  if(isset($_POST["NAME"]) && $_POST["NAME"]!="") {
      $stmt = $pdo->prepare('SELECT * FROM manufacturer WHERE MANUFACTNAME like ? ');
      $stmt->execute(array($_POST["NAME"].'%'));
  } elseif(isset($_POST["NUM"]) && $_POST["NUM"]!="") {
      $stmt = $pdo->prepare('SELECT * FROM manufacturer WHERE MANUFACTNUM like ?');
      $stmt->execute(array($_POST["NUM"].'%'));
  }
  if(isset($stmt))
  {
    $rows = $stmt->fetchAll();
    foreach($rows as $r)
    echo 
    "<form method='POST' action=''>
        店家名稱<input id='MANUFACTNAME' name='MANUFACTNAME' value='".$r['MANUFACTNAME']."'><br>
        店家代號<input id='MANUFACTNUM' name='MANUFACTNUM' value='".$r['MANUFACTNUM']."'><br>
        店家地址<input id='ADDRESS' name='ADDRESS' value='".$r['ADDRESS']."'><br>
        聯絡人<input id='CONTACT' name='CONTACT' value='".$r['CONTACT']."'><br>
        聯絡電話<input id='PHONE' name='PHONE' value='".$r['PHONE']."'><br>
        其他資訊<input id='INFORMATION' name='INFORMATION' value='".$r['INFORMATION']."'><br>
        <input type='hidden' name='ID' value='".$r['ID']."'>
        <button type='submit' class='btn btn-primary' name='update'>更新</button>
    </form>";
  }
}
// 更新資料
if(isset($_POST["update"])) 
{
  $stmt = $pdo->prepare('update `manufacturer` set MANUFACTNAME=?,MANUFACTNUM=?,ADDRESS=?,PHONE=?,CONTACT=?,INFORMATION=? where ID=?');
  $stmt->execute(array($_POST["MANUFACTNAME"],$_POST["MANUFACTNUM"],$_POST["ADDRESS"],$_POST["PHONE"],$_POST["CONTACT"],$_POST["INFORMATION"],$_POST["ID"]));
}
?>
</body>
</html>
