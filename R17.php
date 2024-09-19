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
  <title>修改廠商出貨</title>
</head>
<body>
<form method="POST" action="R17.php">
  <?php

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
    成本<input ID='COST' name='COST'></input>
    <button type="submit" id="send" name="send">送出</button>
    <button type="submit" id="up" name="up">更新</button>
    <button type="submit" id="deta" name="deta">上傳訂單</button>
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
    <button type="submit" id="back" name="back">返回</button>
    <?php

      //印出廠商資訊------------------------------------------
      if(isset($_POST["back"]))
      {
        header("location:http://localhost/rindex.php");
      }
      //------------------------------------------

      //印出廠商資訊------------------------------------------
      $OD=$_SESSION['OD'];
      $stmt = $pdo->prepare('SELECT * FROM `purchase` WHERE OD = ?');
      $stmt->execute(array($OD));
      $rows = $stmt->fetchAll();
      foreach ($rows as $r)
      {
      echo "<br>訂單編號:".$OD."<br>"."廠商代號:".$r["MANUFACTNUM"]."<br>"."廠商地址:".$r["ADDRESS"]."<br>"."訂單日期:".$r["DATE"]."<br>"."連絡電話:".$r["PHONE"]."<br>";
      //------------------------------------------

      //搜尋廠商資訊------------------------------------------
      $stmt = $pdo->prepare('SELECT * FROM `manufacturer` WHERE `MANUFACTNUM`=?');
      $stmt->execute(array($r["MANUFACTNUM"]));           
      $rows = $stmt->fetchAll();
      }
      foreach($rows as $r)
      //------------------------------------------
      
      //更新訂單資訊-----------------------------------------
      if(isset($_POST["up"]))
      {
        $stmt = $pdo->prepare('SELECT * FROM `purchase-com` WHERE `ORDERNUM`=?');
        $stmt->execute(array($OD));
        $rows = $stmt->fetchAll();
        foreach($rows as $u)
        {
          $stmt = $pdo->prepare('SELECT * FROM `commodity` WHERE `ITEMNUMBER`=?');
          $stmt->execute(array($_POST["NUMBER".$u["CODE"]]));
          $rows = $stmt->fetchAll();
          foreach ($rows as $r);
          {
            $AMOUNT=$_POST["QUANTITY".$u['CODE']]*$r["COST"];
            $stmtt = $pdo->prepare('update `purchase-com` set NUMBER=?, NAME=? , QUANTITY=? , UNIT=? , COST=? , AMOUNT=? , INFORMATION=?  where ORDERNUM=? AND CODE=? ');
            $stmtt->execute(array($_POST["NUMBER".$u["CODE"]],$r["TITLE"],$_POST["QUANTITY".$u['CODE']],$r["UNIT"],$r["COST"],$AMOUNT,$_POST["INFORMATION".$u['CODE']],$OD,$u['CODE']));
          }
        }
      }
      //-----------------------------------------

      //刪除訂單內容-----------------------------------
      $stmt = $pdo->prepare('SELECT * FROM `purchase-com` WHERE `ORDERNUM`=?');
      $stmt->execute(array($OD));
      $rows = $stmt->fetchAll();
      foreach($rows as $Y)
      {
       if(isset($_POST["send".$Y['CODE']]))
       {
       $stmts = $pdo->prepare("DELETE FROM `purchase-com` WHERE `CODE`=? AND `ORDERNUM`=?");
       $stmts->execute(array($Y['CODE'],$OD));
       }
      } 
       //-----------------------------------


      //按下按鈕的動作------------------------------------------
      if(isset($_POST["send"]) && $_POST["NUM"] && $_POST["QUA"] && $_POST["COST"])
      {
        $stmts = $pdo->prepare('SELECT * FROM `commodity` WHERE `ITEMNUMBER`=?');
        $stmts->execute(array($_POST["NUM"]));
        $rows = $stmts->fetchAll();
        if(count($rows)>0)
        {
        //定義訂單商品編碼--------------------
        $code=1;
        $stmts = $pdo->prepare('SELECT * FROM `purchase-com` WHERE `ORDERNUM`=?');
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
        $mon=$_POST["QUA"]*$r["COST"];
        $ins = $pdo->prepare("INSERT INTO `purchase-com` (NUMBER, NAME, QUANTITY , UNIT, COST , AMOUNT, INFORMATION, ORDERNUM,CODE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $ins->execute(array($_POST["NUM"],$r["TITLE"],$_POST["QUA"],$r["UNIT"],$r["COST"],$mon,$_POST["sel"],$OD,$code));
        //---------------------------------------------------------
        }
        else
        {
          echo "查無此商品";
        }
      }
      
      //按下上傳訂單-----------------------------------
      if(isset($_POST["deta"]))
      {
        //變更訂單狀態(有無上傳訂單)-------------------------------------------------------
        $stmt = $pdo->prepare('SELECT * FROM `purchase` WHERE `OD`=?');
        $stmt->execute(array($OD));
        $rows = $stmt->fetchAll();
        foreach ($rows as $s)
        if($s["CONFIRM"]==0)
        {
          $stmt = $pdo->prepare('update `purchase` set CONFIRM=? where OD=?');
          $stmt->execute(array(1,$OD));
        }
        //--------------------------------------------------------

        //整合訂單資訊-------------------------------------------
        $com=null;
        $money=0;
        $qua=0;
        $stmt = $pdo->prepare('SELECT * FROM `purchase-com` WHERE `ORDERNUM`=?');
        $stmt->execute(array($OD));
        $rows = $stmt->fetchAll();
        foreach ($rows as $s)
        {
          $com=$com.$s["NUMBER"]." ".$s["NAME"]." ".$s["QUANTITY"]." ".$s["UNIT"]." ".$s["COST"]." ".$s["AMOUNT"]." ".$s["INFORMATION"]." "."+"." ";
          $money=$money+$s["AMOUNT"];
          $qua=$qua+$s["QUANTITY"];
        }
        //---------------------------------------------------------
      
        //上傳整合訂單資訊-----------------------------------------
        $stmt = $pdo->prepare('update `purchase` set COMMODITY=? ,PRICE=?,QUANTITY=? where OD=?');
        $stmt->execute(array($com,$money,$qua,$OD));
        //------------------------------------------ 

        //更改庫存-----------------------------------------
        $stmt = $pdo->prepare('SELECT * FROM `purchase-com` WHERE `ORDERNUM`=?');
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
        //------------------------------------------ 
          
      //新增至紀錄-----------------------------------
        $stmts = $pdo->prepare("DELETE FROM `history` WHERE `TYPE`=?");
        $stmts->execute(array($OD));
        $stmt = $pdo->prepare('SELECT * FROM `purchase-com` WHERE `ORDERNUM`=?');
        $stmt->execute(array($OD));
        $rows = $stmt->fetchAll();
        foreach ($rows as $s)
        {
          $explode=explode("-",$s["NUMBER"]);
          $stmt = $pdo->prepare('SELECT * FROM `history` WHERE `NUMBER`=? AND `STYLE`=? AND `TYPE`=?');
          $stmt->execute(array($explode[0],$explode[1],$OD));
          $row = $stmt->fetchAll();
          echo $explode[0],$explode[1];
           for($N=4;$N<=18;$N+=2)
           {
             if($explode[2] == $N)
             {
               $stmt = $pdo->prepare("INSERT INTO history (NUMBER, STYLE, `$N` , TIME, TYPE) VALUES (?, ?, ?, ?, ?)");
               $stmt->execute(array($explode[0],$explode[1], $s["QUANTITY"] ,$time,$OD));
             }
           }
            //$stmt = $pdo->prepare("update history set `$explode[2]`=? where `NUMBER`=? AND `STYLE`=? AND `TYPE`=? ");
            //$stmt->execute(array($s["QUANTITY"],$explode[0],$explode[1],$OD));
          }
        
        //-----------------------------------
        //header("Location:http://localhost/rindex.php");
        }

      //顯示訂單內容-----------------------------------
      echo "<br>"."貨號"." "."品名"." "."數量"." "."單位"." "."單價"." "."折扣"." "."金額"." "."備註"." ";
      $stmt = $pdo->prepare('SELECT * FROM `purchase-com` WHERE `ORDERNUM`=?');
      $stmt->execute(array($OD));
      $rows = $stmt->fetchAll();
      foreach($rows as $Y)
      {
      echo "<br>"."<input type='text' class='form-control' size='15' id='x' name='NUMBER".$Y['CODE']."' value='".$Y['NUMBER']."'></input>".
      " ".$Y["NAME"]." "."<input type='text' class='form-control' size='15' id='x' name='QUANTITY".$Y['CODE']."' value='".$Y['QUANTITY']."'></input>".
      " ".$Y["UNIT"]." "."<input type='text' class='form-control' size='15' id='x' name='COST".$Y['CODE']."' value='".$Y['COST']."'></input>".
      " ".$Y["AMOUNT"]." "."<input type='text' class='form-control' size='15' id='x' name='INFORMATION".$Y['CODE']."' value='".$Y['INFORMATION']."'></input>".
      " "."<button type='submit' id='send' name='send".$Y['CODE']."'>刪除</button>";
      //-----------------------------------
      }
    ?>
</form>
</body>