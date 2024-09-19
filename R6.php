

<?php
//資料庫連接
try {
    $pdo=new PDO("mysql:host=localhost;dbname=ru;","root","");
} catch (PDOException $err) {
    die("資料庫無法連接");
}
//----------------------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!--基本設定-->
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增店家</title>
    <!----------------------------------------------------------------------------------------------------------------------------->
</head>

<body>
<form method="POST" action="R6.php">
<label>新增店家</label><br>
店家名稱<input id="NAME" name="SHOPNAME"><br>
店家代號<input id="SHOPNAME" name="SHOPNUM"><br>
地區代號<input id="AREACODE" name="AREACODE"><br>
店家地址<input id="ADDRESS" name="ADDRESS"><br>
聯絡人<input id="CONTACT" name="CONTACT"><br>
聯絡電話<input id="PHONE" name="PHONE"><br>
其他資訊<input id="INFOR" name="INFOR"><br>
<button type="submit" class="btn btn-primary" id="subR6" name="subR6"></button>
</form>
<form method="POST" action="rindex.php">
<button type="submit" class="btn btn-primary" id="subR6" name="subR6">返回</button>
</form>
<form method="POST" action="R7.php">
<button type="submit" class="btn btn-primary" id="subR6" name="subR6">更改店家</button>
</form>
<?php
//新增店家

if(isset($_POST["subR6"]))
{
    $stmt=$pdo->prepare('select * from customer where SHOPNAME=? and SHOPNUM=?');
    $stmt->execute(array($_POST["SHOPNAME"],$_POST["SHOPNUM"]));
    $rows=$stmt->fetchAll();
    if(count($rows)<=0)
    {
        if(isset($_POST["subR6"]) && $_POST["SHOPNAME"]!="")
        {
        $stmt=$pdo->prepare('select * from customer');
        $stmt=$pdo->prepare('insert into customer(SHOPNAME,SHOPNUM,AREACODE,ADDRESS,CONTACT,PHONE,INFORMATION) values(?,?,?,?,?,?,?)');
        $stmt->execute(array($_POST["SHOPNAME"],$_POST["SHOPNUM"],$_POST["AREACODE"],$_POST["ADDRESS"],$_POST["CONTACT"],$_POST["PHONE"],$_POST["INFOR"]));
    }
    }
    else
    {
        echo "店家已新增";
    }
}
//-------------------------
?>
</body>