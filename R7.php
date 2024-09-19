<?php
// 資料庫連接
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ru;", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // 設定 PDO 的錯誤模式為例外拋出
} catch (PDOException $err) {
    die("資料庫無法連接");
}

// 更新資料的函數
function updateData($pdo, $shopname, $shopnum, $areacode, $address, $contact, $phone, $infor, $id) 
{
    $stmt = $pdo->prepare('UPDATE customer SET SHOPNAME=?, SHOPNUM=?, AREACODE=?, ADDRESS=?, CONTACT=?, PHONE=?, INFORMATION=? WHERE ID=?');
    $stmt->execute(array($shopname, $shopnum, $areacode, $address, $contact, $phone, $infor, $id));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>廠商進貨</title>
</head>
<body>
    
<form method="POST" action="">
    <label>查詢店家</label><br>
    店家名稱<input id="NAME" name="NAME"><br>
    店家代號<input id="NUM" name="NUM"><br>
    <button type="submit" class="btn btn-primary" id="subR6" name="subR6">搜尋</button>
   <select name='selname' id='selname'>
   <?php
   //$stmt = $pdo->prepare('SELECT * FROM customer');
   //$stmt->execute();
   //$row = $stmt->fetchAll();
   //foreach($row as $r){
   //echo "<option value='".$r['SHOPNAME']."'>".$r['SHOPNAME']."</option>";
   //}
   //?>
   </select>
</form>

<form method="POST" action="rindex.php">
    <button type="submit" class="btn btn-primary" id="back" name="back">返回</button>
</form>

<?php
// 查詢店家
if(isset($_POST["subR6"])) {
    if(isset($_POST["NAME"]) && $_POST["NAME"]!="") {
        $stmt = $pdo->prepare('SELECT * FROM customer WHERE SHOPNAME like ? ');
        $stmt->execute(array($_POST["NAME"].'%'));
    } elseif(isset($_POST["NUM"]) && $_POST["NUM"]!="") {
        $stmt = $pdo->prepare('SELECT * FROM customer WHERE SHOPNUM like ?');
        $stmt->execute(array($_POST["NUM"].'%'));
    }
    if(isset($stmt))
    {
    $rows = $stmt->fetchAll();
    foreach($rows as $r) {
        echo 
        "<form method='POST' action=''>
            店家名稱<input id='SHOPNAME' name='SHOPNAME' value='".$r['SHOPNAME']."'><br>
            店家代號<input id='SHOPNUM' name='SHOPNUM' value='".$r['SHOPNUM']."'><br>
            地區代號<input id='AREACODE' name='AREACODE' value='".$r['AREACODE']."'><br>
            店家地址<input id='ADDRESS' name='ADDRESS' value='".$r['ADDRESS']."'><br>
            聯絡人<input id='CONTACT' name='CONTACT' value='".$r['CONTACT']."'><br>
            聯絡電話<input id='PHONE' name='PHONE' value='".$r['PHONE']."'><br>
            亞蘭夢藤-一般<input id='AL-NOR' name='AL-NOR' value='".$r['AL-NOR']."'><br>
            BENNY-一般-衣服<input id='BENNY-NOR-E' name='BENNY-NOR-E' value='".$r['BENNY-NOR-E']."'><br>
            BENNY-一般-配件<input id='BENNY-NOR-P' name='BENNY-NOR-P' value='".$r['BENNY-NOR-P']."'><br>
            BENNY-切貨<input id='BENNY-CUT' name='BENNY-CUT' value='".$r['BENNY-CUT']."'><br>
            金安德森-批價<input id='KING-P' name='KING-P' value='".$r['KING-P']."'><br>
            大安-一般<input id='BIGKIN-NOR' name='BIGKIN-NOR' value='".$r['BIGKIN-NOR']."'><br>
            小安-一般<input id='SMALLKIN-NOR' name='SMALLKIN-NOR' value='".$r['SMALLKIN-NOR']."'><br>
            小安-切貨<input id='SMALLKIN-CUT' name='SMALLKIN-CUT' value='".$r['SMALLKIN-CUT']."'><br>
            瑪格-切貨<input id='MG-NOR' name='MG-NOR' value='".$r['MG-NOR']."'><br>
            巴帝斯-一般<input id='BATIS-NOR' name='BATIS-NOR' value='".$r['BATIS-NOR']."'><br>
            巴帝斯-降價<input id='BATIS-RED' name='BATIS-RED' value='".$r['BATIS-RED']."'><br>
            巴帝斯-切貨<input id='BATIS-C' name='BATIS-C' value='".$r['BATIS-CUT']."'><br>
            貝柔-一般<input id='BR-NOR' name='BR-NOR' value='".$r['BR-NOR']."'><br>
            貝柔-切貨<input id='BR-CUT' name='BR-CUT' value='".$r['BR-CUT']."'><br>
            仁惠<input id='MYDNA' name='MYDNA' value='".$r['MYDNA-NOR']."'><br>
            其他資訊<input id='INFOR' name='INFOR' value='".$r['INFORMATION']."'><br>
            <input type='hidden' name='ID' value='".$r['ID']."'> <!-- 隱藏的欄位用於存儲 ID -->
            <button type='submit' class='btn btn-primary' name='update'>更新</button>
        </form>";
    }
}
}
// 更新資料
if(isset($_POST["update"])) {
    updateData($pdo, $_POST["SHOPNAME"], $_POST["SHOPNUM"], $_POST["AREACODE"], $_POST["ADDRESS"], $_POST["CONTACT"], $_POST["PHONE"], $_POST["INFOR"], $_POST["ID"]);
    echo "資料已更新";
}
?>
</body>
</html>
