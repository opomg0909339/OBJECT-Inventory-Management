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
<form method="POST" action="R11.php">
  <?php
  $OD=$_SESSION['OD'];
  //變更訂單狀態(有無上傳訂單)-------------------------------------------------------
  $stmt = $pdo->prepare('SELECT * FROM `order` WHERE `OD`=?');
  $stmt->execute(array($OD));
  $rows = $stmt->fetchAll();
  foreach ($rows as $s)
  if($s["CONFIRM"]==1)
  {
    $stmt = $pdo->prepare('update `order` set CONFIRM=? where OD=?');
    $stmt->execute(array(0,$OD));
    //重製庫存-------------------------------------------------------
    $stmt = $pdo->prepare('SELECT * FROM `order` WHERE `OD`=?');
    $stmt->execute(array($OD));
    $rows = $stmt->fetchAll();
    foreach ($rows as $s)
    if($s["CONFIRM"]==0)
    {
      $stmt = $pdo->prepare('SELECT * FROM `order-com` WHERE `ORDERNUM`=?');
      $stmt->execute(array($OD));
      $rows = $stmt->fetchAll();
      foreach ($rows as $s)
      {
        $stmt = $pdo->prepare('SELECT * FROM `commodity` WHERE `ITEMNUMBER`=?');
        $stmt->execute(array($s["NUMBER"]));
        $row = $stmt->fetchAll();
        foreach($row as $commodity);
        {
          $NEWQUANTITY=$commodity["QUANTITY"]+$s["QUANTITY"];
          $stmt = $pdo->prepare("update `commodity` set `QUANTITY`=? where `ITEMNUMBER`=?");
          $stmt->execute(array($NEWQUANTITY,$s["NUMBER"]));
        }
      }
    }
  //------------------------------------------
  }
  //------------------------------------------



  //新增時間------------------------------------------
  date_default_timezone_set('Asia/Taipei');
  $time = date("Y-m-d", time());            
  //------------------------------------------

  //建立下拉選單------------------------------------------
  $selected_option = isset($_POST['sel']) ? $_POST['sel'] : '';
  $inf = array("一般", "切貨", "正品", "降價", "出清");
  //------------------------------------------
  
  ?>
  <!--建立內容------------------------------------------>
    貨號<input ID='NUM' name='NUM'></input>
    數量<input ID='QUA' name='QUA'></input>
    折扣<input ID='DIS' name='DIS'></input>
    <button type="submit" id="send" name="send">送出</button>
    <button type="submit" id="up" name="up">更新</button>
    <button type="submit" id="deta" name="deta">上傳訂單</button>
    <button type="submit" id="back" name="back">返回</button>
    <select name="sel" id="sel">
  <!-------------------------------------------->

    <?php
    //固定下拉選單------------------------------------------
     foreach ($inf as $infor)
     {
      $selected = ($selected_option == $infor) ? 'selected' : '';
      echo "<option value='$infor' $selected>$infor</option>";
     }
    //------------------------------------------
    ?>
    </select>
    
    <?php
    if(isset($_POST["back"]))
    {
      header("Location:http://localhost/rindex.php");
    }
      //印出店家資訊------------------------------------------
      $stmt = $pdo->prepare('SELECT * FROM `order` WHERE OD = ?');
      $stmt->execute(array($OD));
      $rows = $stmt->fetchAll();
      foreach ($rows as $r)
      echo "<br>訂單編號:".$OD."<br>"."店家代號:".$r["SHOPNUM"]."<br>"."店家地址:".$r["ADDRESS"]."<br>"."訂單日期:".$r["DATE"]."<br>"."連絡電話:".$r["PHONE"]."<br>";
      //------------------------------------------

      //搜尋店家資訊------------------------------------------
      //$stmt = $pdo->prepare('SELECT * FROM `customer` WHERE `SHOPNUM`=?');
      //$stmt->execute(array($r["SHOPNUM"]));           
      //$rows = $stmt->fetchAll();
      //foreach($rows as $r)
      //------------------------------------------

      //印出店家折扣------------------------------------------
      //echo "亞蘭夢藤:".$r["AL-NOR"]."<br>"."貝妮衣服類:".$r["BENNY-NOR-E"]."<br>"."貝妮配件類".$r["BENNY-NOR-P"]."<br>"."貝妮切貨".$r["BENNY-CUT"]."<br>"."金安德森批價".$r["KING-P"].
      //"<br>"."大安一般".$r["BIGKIN-NOR"]."<br>"."小安一般".$r["SMALLKIN-NOR"]."<br>"."小安切貨".$r["SMALLKIN-CUT"]."<br>"."".$r["MG-NOR"]."<br>"."".$r["BATIS-NOR"]."<br>"."".$r["BATIS-RED"].
      //"<br>"."".$r["BATIS-CUT"]."<br>"."".$r["BR-NOR"]."<br>"."".$r["BR-CUT"]."<br>"."".$r["MYDNA-NOR"];

      //echo " <table width='500' height='120' border='1'>";
      //echo"<tr>"."<td>"."品牌"."</td>"."<td>"."正品"."</td>"."<td>"."降價"."</td>"."<td>"."缺"."</td>"."<tr>";
      //------------------------------------------
      
      //更新訂單資訊-----------------------------------------
      if(isset($_POST["up"]))
      {
        $stmt = $pdo->prepare('SELECT * FROM `order-com` WHERE `ORDERNUM`=?');
        $stmt->execute(array($OD));
        $rows = $stmt->fetchAll();
        foreach($rows as $u)
        {
          $stmt = $pdo->prepare('SELECT * FROM `commodity` WHERE `ITEMNUMBER`=?');
          $stmt->execute(array($_POST["NUMBER".$u["CODE"]]));
          $rows = $stmt->fetchAll();
          foreach ($rows as $r);
          {
            $AMOUNT=$_POST["QUANTITY".$u['CODE']]*$r["PRICE"]*$_POST["DISCOUNT".$u['CODE']];
            $stmtt = $pdo->prepare('update `order-com` set NUMBER=?, NAME=? , QUANTITY=? , UNIT=? , PRICE=? , DISCOUNT=? , AMOUNT=? , INFORMATION=?  where ORDERNUM=? AND CODE=? ');
            $stmtt->execute(array($_POST["NUMBER".$u["CODE"]],$r["TITLE"],$_POST["QUANTITY".$u['CODE']],$r["UNIT"],$r["PRICE"],$_POST["DISCOUNT".$u['CODE']],
            $AMOUNT,$_POST["INFORMATION".$u['CODE']],$OD,$u['CODE']));
          }
        }
      }
      //-----------------------------------------

      //刪除訂單內容-----------------------------------
      $stmt = $pdo->prepare('SELECT * FROM `order-com` WHERE `ORDERNUM`=?');
      $stmt->execute(array($OD));
      $rows = $stmt->fetchAll();
      foreach($rows as $Y)
      {
       if(isset($_POST["send".$Y['CODE']]))
       {
       $stmts = $pdo->prepare("DELETE FROM `order-com` WHERE `CODE`=? AND `ORDERNUM`=?");
       $stmts->execute(array($Y['CODE'],$OD));
       }
       //-----------------------------------
      } 

      //按下按鈕的動作------------------------------------------
      if(isset($_POST["send"]) && $_POST["NUM"] && $_POST["QUA"] && $_POST["DIS"])
      {
        //定義訂單商品編碼
        $code=1;
        $stmts = $pdo->prepare('SELECT * FROM `order-com` WHERE `ORDERNUM`=?');
        $stmts->execute(array($OD));
        $rows = $stmts->fetchAll();
        foreach ($rows as $odcom)
        if($odcom["CODE"]=$odcom["CODE"])
        $code= $odcom["CODE"]+1;
        //------------------------------------------

        //搜尋內褲基本資訊------------------------------------------
        $unm=explode("-",$_POST["NUM"]);
        $stmt = $pdo->prepare('SELECT * FROM `commodity` WHERE `NUMBER`=? AND `STYLE`=? AND `SIZE`=?');
        $stmt->execute(array($unm[0],$unm[1],$unm[2]));
        $rows = $stmt->fetchAll();
        foreach ($rows as $r)
        //------------------------------------------
        
        //計算價格編碼以及上傳訂單------------------------------------------
        $mon=$r["PRICE"]*$_POST["QUA"]*$_POST["DIS"];
        $ins = $pdo->prepare("INSERT INTO `order-com` (NUMBER, NAME, QUANTITY , UNIT, PRICE, DISCOUNT , AMOUNT, INFORMATION, ORDERNUM,CODE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $ins->execute(array($_POST["NUM"],$r["TITLE"],$_POST["QUA"],$r["UNIT"],$r["PRICE"],$_POST["DIS"],$mon,$_POST["sel"],$OD,$code));
        //---------------------------------------------------------
      }
      
      //按下上傳訂單-----------------------------------
      if(isset($_POST["deta"]))
      {
        //更改庫存-----------------------------------------
        $stmt = $pdo->prepare('SELECT * FROM `order` WHERE `OD`=?');
        $stmt->execute(array($OD));
        $rows = $stmt->fetchAll();
        foreach ($rows as $s)
        if($s["CONFIRM"]==0)
        {
          $stmt = $pdo->prepare('SELECT * FROM `order-com` WHERE `ORDERNUM`=?');
          $stmt->execute(array($OD));
          $rows = $stmt->fetchAll();
          foreach ($rows as $s)
          {
            $stmt = $pdo->prepare('SELECT * FROM `commodity` WHERE `ITEMNUMBER`=?');
            $stmt->execute(array($s["NUMBER"]));
            $row = $stmt->fetchAll();
            foreach($row as $commodity);
            {
              $NEWQUANTITY=$commodity["QUANTITY"]-$s["QUANTITY"];
              $stmt = $pdo->prepare("update `commodity` set `QUANTITY`=? where `ITEMNUMBER`=?");
              $stmt->execute(array($NEWQUANTITY,$s["NUMBER"]));
            }
          }
         //--------------------------------------------------------

         //變更訂單狀態(有無上傳訂單)-------------------------------------------------------
         $stmt = $pdo->prepare('update `order` set CONFIRM=? where OD=?');
         $stmt->execute(array(1,$OD));
         //--------------------------------------------------------
        }
        //--------------------------------------------------------

        //整合訂單資訊-------------------------------------------
        $com=null;
        $money=0;
        $qua=0;
        $stmt = $pdo->prepare('SELECT * FROM `order-com` WHERE `ORDERNUM`=?');
        $stmt->execute(array($OD));
        $rows = $stmt->fetchAll();
        foreach ($rows as $s)
        {
          $com=$com.$s["NUMBER"]." ".$s["NAME"]." ".$s["QUANTITY"]." ".$s["UNIT"]." ".$s["PRICE"]." ".$s["DISCOUNT"]." ".$s["AMOUNT"]." ".$s["INFORMATION"]." "."+"." ";
          $money=$money+$s["AMOUNT"];
          $qua=$qua+$s["QUANTITY"];
        }
        //---------------------------------------------------------
      
        //上傳整合訂單資訊-----------------------------------------
        $stmt = $pdo->prepare('update `order` set COMMODITY=? ,PRICE=?,QUANTITY=? where OD=?');
        $stmt->execute(array($com,$money,$qua,$OD));
        //------------------------------------------ 

      //新增至紀錄-----------------------------------
        $stmts = $pdo->prepare("DELETE FROM `history` WHERE `TYPE`=?");
        $stmts->execute(array($OD));
        $stmt = $pdo->prepare('SELECT * FROM `order-com` WHERE `ORDERNUM`=?');
        $stmt->execute(array($OD));
        $rows = $stmt->fetchAll();
        foreach ($rows as $s)
        {
          $explode=explode("-",$s["NUMBER"]);
          $stmt = $pdo->prepare('SELECT * FROM `history` WHERE `NUMBER`=? AND `STYLE`=? AND `TYPE`=?');
          $stmt->execute(array($explode[0],$explode[1],$OD));
          $row = $stmt->fetchAll();
            for($N=4;$N<=18;$N+=2)
            {
              if($explode[2] == $N)
              {
                $stmt = $pdo->prepare("INSERT INTO history (NUMBER, STYLE, `$N` , TIME, TYPE) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute(array($explode[0],$explode[1], -$s["QUANTITY"] ,$time,$OD));
              }
            }
            //$stmt = $pdo->prepare("update history set `$explode[2]`=? where `NUMBER`=? AND `STYLE`=? AND `TYPE`=? ");
            //$stmt->execute(array(-$s["QUANTITY"],$explode[0],$explode[1],$OD));
        }
        header("Location:http://localhost/rindex.php");
        exit;
      }
        //-----------------------------------


      //顯示訂單內容-----------------------------------
      echo "<br>"."貨號"." "."品名"." "."數量"." "."單位"." "."單價"." "."折扣"." "."金額"." "."備註"." ";
      $stmt = $pdo->prepare('SELECT * FROM `order-com` WHERE `ORDERNUM`=?');
      $stmt->execute(array($OD));
      $rows = $stmt->fetchAll();
      foreach($rows as $Y)
      {
      echo "<br>"."<input type='text' class='form-control' size='15' id='x' name='NUMBER".$Y['CODE']."' value='".$Y['NUMBER']."'></input>".
      " ".$Y["NAME"]." "."<input type='text' class='form-control' size='15' id='x' name='QUANTITY".$Y['CODE']."' value='".$Y['QUANTITY']."'></input>".
      " ".$Y["UNIT"]." "."<input type='text' class='form-control' size='15' id='x' name='PRICE".$Y['CODE']."' value='".$Y['PRICE']."'></input>".
      " "."<input type='text' class='form-control' size='15' id='x' name='DISCOUNT".$Y['CODE']."' value='".$Y['DISCOUNT']."'></input>".
      " ".$Y["AMOUNT"]." "."<input type='text' class='form-control' size='15' id='x' name='INFORMATION".$Y['CODE']."' value='".$Y['INFORMATION']."'></input>".
      " "."<button type='submit' id='send' name='send".$Y['CODE']."'>刪除</button>";
      //-----------------------------------
      }
    ?>
</form>
</body>