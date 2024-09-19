
<?php
//資料庫連接
try {
    $pdo=new PDO("mysql:host=localhost;dbname=ru;","root","");
} catch (PDOException $err) {
    die("資料庫無法連接");
}
//----------------------------------------------------------------------
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!--基本設定-->
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>查詢修改</title>
    <link rel="stylesheet" type="text/css" href="R4.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"    
    rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!----------------------------------------------------------------------------------------------------------------------------->
</head>

<body>

    <!--輸入設定-->
    <div class="grid-top">
    <div class="grid-top-left">
    <form  method="POST" action="R4.php" id="R2">
    <label for="exampleFormControlInput1" class="form-label" style="padding-top:15px;"  >查詢修改</label>
    <?php
        echo"<input type='text' class='form-control' id='NUM' name='NUM' placeholder='例:418'>";
    ?>
    </select>
    </div>
    <div class="grid-top-mid">
    </div>
    <div class="grid-top-right">
    <button type="submit" class="btn btn-primary" id="sub" name="sub" style="margin-top: 20px; font-size:20pt" >送出</button>
    </form>
    <form  method="POST" action="rindex.php">
    <button type="submit" class="btn btn-primary" id="back" name="back" style="margin-top: 20px; font-size:20pt" >返回</button>
    </form>
</div>
    
    </div>
</div>
    <!---------------------------->
    <form  method="POST" action="R4.php">
    <div class="grid-container">
    <div class="grid-left">
      <?php

    //紀錄貨號
    if(isset($_POST["sub"])&&$_POST["NUM"]!="")
    {
      $num = explode("-",$_POST["NUM"]);
      $_SESSION["N"]=$num[0];
    //-------------------------

    //搜尋資料
    $stmt=$pdo->prepare('select * from commodity where NUMBER=?');
    $stmt->execute(array($_POST["NUM"]));
    $rows=$stmt->fetchAll();

    //-------------------------

    //判斷是否重複
    if (count($rows)==0) 
    {
      $err= "查無此商品";
      echo $err;
    } 
    //-------------------------
    else
    {
    $stmt=$pdo->prepare('select * from commodity where NUMBER=?');
    $stmt->execute(array($_SESSION["N"]));
    $rows=$stmt->fetchAll();
    foreach($rows as $r);
    echo "貨號:". $r["NUMBER"]."<br>".
         "品項:"."<input type='text' size='5' class='form-control' id='".$r["NUMBER"]."'name='TITLE' value=".$r["TITLE"]." >".
         "材質:"."<input type='text' size='5' class='form-control' id='".$r["NUMBER"]."'name='MATERIAL' value=".$r["MATERIAL"]." >".
         "單位:"."<input type='text' size='5' class='form-control' id='".$r["UNIT"]."'name='UNIT' value=".$r["UNIT"]." >";
    }
  }
      ?>
    </div>

    <div class="grid-container-right">
    <!--表格設定-->

    
    <?php
    //顯示時間
    date_default_timezone_set('Asia/Taipei');
    $time=date("Y-m-d",time());
    //-------------------------
    ?>
        
    <?php
    $QUAA = array();
    $QUAB = array();
    $QUAC = array();
    $QUAD = array();
    $QUAE = array();
    $QUAF = array();
    $r["STYLE"] = array();
    $size=array();
    //<!--抓取花板-->---------------------------
    if(isset($_SESSION["N"]))
    {
       $stmt=$pdo->prepare('select DISTINCT STYLE from commodity where NUMBER=? ORDER BY `commodity`.`STYLE` ASC ');
       $stmt->execute(array($_SESSION["N"]));
       $rows=$stmt->fetchAll();
    //----------------------------------
       foreach($rows as $r)
       {
    //<!--表格設定-->
      echo"<div class='grid-right'>";
      echo"<table class='table align-middle'>";
      //<!--表頭設定-->
      echo"<thead>";
      echo"<tr>";
      echo"<th scope='col'>$r[STYLE]</th>";
      echo"<th scope='col'>數量</th> ";
      echo"<th scope='col'>最後更改日期</th> ";
      echo"<th scope='col'>操作</th> ";
      echo"</tr> ";
      echo"</thead>";
      echo"<tbody>";
      //----------------------------------
    //----------------------------------
        //<!--抓取表格資訊-->
        
        echo "<button type='submit' class='btn btn-primary' id='".$r['STYLE']."' value='".$r['STYLE']."' name='SUBB' font-size:20pt' >送出</button>";
        if(isset($_SESSION["N"]))
        {
        $stmt=$pdo->prepare('select * from commodity where NUMBER=? and STYLE=? ORDER BY `commodity`.`SIZE` ASC');
        $stmt->execute(array($_SESSION["N"],$r['STYLE']));
        $row=$stmt->fetchAll();
          foreach($row as $r)
          {
            if(isset($_SESSION["N"]))
            {
            echo"<tr><td>".$r["SIZE"]."<td>"."<input type='text' size='5' class='form-control' id='".$r["ID"]."'   
            name='QUA_".$r["ID"]."' value=".$r['QUANTITY']." >"."<td>".$r["REMARK"]."<td>".$r["STYLE"]. "</tr>";
            }
            //----------------------------------

            //<!--查詢修改-->
            if(isset($_POST['SUBB']))
            {
            $UPID=$r["ID"];
            $QUA=$_POST["QUA_".$r["ID"]].",";
            $stmt = $pdo->prepare('update commodity set QUANTITY=? , REMARK=? where ID=?');
            $stmt->execute(array($QUA,$time, $UPID));
            $stmt = $pdo->prepare('update commodity set TITLE=? , MATERIAL=?  , UNIT=? where NUMBER=?');
            $stmt->execute(array($_POST["TITLE"],$_POST["MATERIAL"],$_POST["UNIT"],$_SESSION["N"]));
            $input_name = 'QUA_' . $r["ID"]; // 將 input 元素的值存入數組中，使用 $r["ID"] 作為索引
                        
         if($r["STYLE"]=="A")
         {
         array_push($QUAA,$_POST[$input_name]-$r['QUANTITY'],);
           if($r["SIZE"]==16)
           {
             $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)');
             $stmt->execute(array($_SESSION["N"], "A", $QUAA[0], $QUAA[1], $QUAA[2], $QUAA[3], $QUAA[4], $QUAA[5], $QUAA[6], $time, "手動更新"));
           }
           if($r["SIZE"]==18)
           {
             $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`,`18`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
             $stmt->execute(array($_SESSION["N"], "A", $QUAA[0], $QUAA[1], $QUAA[2], $QUAA[3], $QUAA[4], $QUAA[5], $QUAA[6], $QUAA[7], $time, "手動更新"));
           }
         }

          if($r["STYLE"]=="B")
          {
          array_push($QUAB,$_POST[$input_name]-$r['QUANTITY'],);
            if($r["SIZE"]==16)
            {
              $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
              $stmt->execute(array($_SESSION["N"], "B", $QUAB[0], $QUAB[1], $QUAB[2], $QUAB[3], $QUAB[4], $QUAB[5], $QUAB[6], $time, "手動更新"));
            }
            if($r["SIZE"]==18)
            {
              $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`,`18`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
              $stmt->execute(array($_SESSION["N"],"B", $QUAB[0], $QUAB[1], $QUAB[2], $QUAB[3], $QUAB[4], $QUAB[5], $QUAB[6], $QUAB[7], $time, "手動更新"));
            }
          }

          if($r["STYLE"]=="C")
          {
          array_push($QUAC,$_POST[$input_name]-$r['QUANTITY'],);
            if($r["SIZE"]==16)
            {
              $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
              $stmt->execute(array($_SESSION["N"], "C", $QUAC[0], $QUAC[1], $QUAC[2], $QUAC[3], $QUAC[4], $QUAC[5], $QUAC[6], $time, "手動更新"));
            }
            if($r["SIZE"]==18)
            {
              $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`,`18`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
              $stmt->execute(array($_SESSION["N"],"C", $QUAC[0], $QUAC[1], $QUAC[2], $QUAC[3], $QUAC[4], $QUAC[5], $QUAC[6], $QUAC[7], $time, "手動更新"));
            }
          }

          if($r["STYLE"]=="D")
          {
          array_push($QUAD,$_POST[$input_name]-$r['QUANTITY'],);
            if($r["SIZE"]==16)
            {
              $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
              $stmt->execute(array($_SESSION["N"], "D", $QUAD[0], $QUAD[1], $QUAD[2], $QUAD[3], $QUAD[4], $QUAD[5], $QUAD[6], $time, "手動更新"));
            }
            if($r["SIZE"]==18)
            {
              $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`,`18`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
              $stmt->execute(array($_SESSION["N"],"D", $QUAD[0], $QUAD[1], $QUAD[2], $QUAD[3], $QUAD[4], $QUAD[5],$QUAD[6], $QUAD[7], $time, "手動更新"));
            }
          }

          if($r["STYLE"]=="E")
          {
          array_push($QUAD,$_POST[$input_name]-$r['QUANTITY'],);
            if($r["SIZE"]==16)
            {
              $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
              $stmt->execute(array($_SESSION["N"], "E", $QUAE[0], $QUAE[1], $QUAE[2], $QUAE[3], $QUAE[4], $QUAE[5], $QUAE[6], $time, "手動更新"));
            }
            if($r["SIZE"]==18)
            {
              $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`,`18`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
              $stmt->execute(array($_SESSION["N"],"E", $QUAE[0], $QUAE[1], $QUAE[2], $QUAE[3],$QUAE[4], $QUAE[5],$QUAE[6], $QUAE[7], $time, "手動更新"));
            }
          }

          if($r["STYLE"]=="F")
          {
          array_push($QUAD,$_POST[$input_name]-$r['QUANTITY'],);
            if($r["SIZE"]==16)
            {
              $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
              $stmt->execute(array($_SESSION["N"], "F", $QUAF[0], $QUAF[1], $QUAF[2], $QUAF[3], $QUAF[4], $QUAF[5], $QUAF[6], $time, "手動更新"));
            }
            if($r["SIZE"]==18)
            {
              $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`,`18`, TIME, TYPE) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)');
              $stmt->execute(array($_SESSION["N"],"F", $QUAF[0], $QUAF[1], $QUAF[2], $QUAF[3],$QUAF[4], $QUAF[5],$QUAF[6], $QUAF[7], $time, "手動更新"));
            }
          }
           header("Location:http://localhost/R4.php");
           //unset($_SESSION["N"]);
           //print_r($QUAA);
            //----------------------------------
            }
              
          }

      }
   echo"</tbody>";
   echo"</table>";
   echo "</div>";    
 } 
}
 ?>

</form>

</body>