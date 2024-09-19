
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

<html>
<head>
    <!--基本設定-->
    <meta charset='utf-8'>
    <link rel="stylesheet" type="text/css" href="R2.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"    
    rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!----------------------------------------------------------------------------------------------------------------------------->
</head>


<body>

    <!--輸入設定-->
    <div class="grid-top">
    <div class="grid-top-left">
    <form  method="POST" action="R2.php" id="R2">
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
    <form  method="POST" action="R4.php">
    <button type="submit" class="btn btn-primary" id="back" name="back" style="margin-top: 0px; font-size:20pt" >更改內衣</button>
    </form>
</div>
    
    </div>
</div>
    <!---------------------------->
    <form  method="POST" action="R2.php">
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
    $N=$r["NUMBER"];
    $T=$r["TITLE"];
    $M=$r["MATERIAL"];
    echo "貨號:". $r["NUMBER"]."<br>"."品項:".$r["TITLE"]."<br>"."材質:".$r["MATERIAL"]."<br>"."貨號:".$r["STYLE"];
    }
  }
      ?>
    </div>

    <div class="grid-container-right">
    <!--表格設定-->
    <div class="grid-right1">
    <table class="table align-middle">
    <!--表頭設定-->
  <thead>
    <tr>
      <th scope="col">A</th>
      <th scope="col">數量</th>
      <th scope="col">最後更改日期</th>
      <th scope="col">操作</th>
    </tr>
  </thead>
    <!--------------------------------------------->
    <!--表格內容設定-->
  <tbody>
    
    <?php
  $QUA_values = array(); // 初始化存儲值的數組
    //選擇貨號
    if(isset($_SESSION["N"])&&$_SESSION["N"]!=null)
    {
    $stmt=$pdo->prepare('select * from commodity where NUMBER=? and STYLE=? ORDER BY `commodity`.`SIZE` ASC');
    $stmt->execute(array($_SESSION["N"],"A"));
    $rows=$stmt->fetchAll();
    //-------------------------
     //顯示表格
    echo "<button type='submit' class='btn btn-primary' id='SUBA' name='SUBA' font-size:20pt' >送出</button>";
    if(isset($_SESSION["N"])&&$_SESSION["N"]!=null)
    {
    foreach($rows as $r)
    {
    echo"<tr><td>".$r["SIZE"]."<td>"."<input type='text' size='5' class='form-control' id='".$r["ID"]."' name='QUA_".$r["ID"]."' value=".$r['QUANTITY']." >"."<td>".$r["REMARK"]."<td>".$r["ID"]. 
   "</tr>";
    //-------------------------
    date_default_timezone_set('Asia/Taipei');
    $time=date("Y-m-d",time());
    //查詢修改
    if(isset($_POST['SUBA']))
    {
    $UPID=$r["ID"];
    $QUA=$_POST["QUA_".$r["ID"]].",";
    $stmt = $pdo->prepare('update commodity set QUANTITY=? , REMARK=? where ID=?');
    $stmt->execute(array($QUA,$time, $UPID));
    $input_name = 'QUA_' . $r["ID"]; // 將 input 元素的值存入數組中，使用 $r["ID"] 作為索引
    array_push($QUA_values,$_POST[$input_name]-$r['QUANTITY']);
    }
   }

    $stmt=$pdo->prepare('select * from commodity where NUMBER=? and STYLE=?');
    $stmt->execute(array($_SESSION["N"],"A"));
    $rows=$stmt->fetchAll();
    foreach($rows as $r)
    {
    
   if(isset($_POST['SUBA']) and $r["SIZE"]==16)
    {
    $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`, TIME) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($_SESSION["N"], 'A', $QUA_values[0], $QUA_values[1], $QUA_values[2], $QUA_values[3], $QUA_values[4], $QUA_values[5], $QUA_values[6], $time));
    print_r($QUA_values);
    unset($_SESSION["N"]);
    header("Location:http://localhost/R2.php");
    }
    
  if(isset($_POST['SUBA']) and $r["SIZE"]==18)
    {
    $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`,`18`, TIME) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($_SESSION["N"], 'A', $QUA_values[0], $QUA_values[1], $QUA_values[2], $QUA_values[3], $QUA_values[4], $QUA_values[5], $QUA_values[6],$QUA_values[7], $time));
    print_r($QUA_values);
    unset($_SESSION["N"]);
    header("Location:http://localhost/R2.php");
    }
   }
   //-------------------------
   }
   }
    ?>



  </tbody>
</table>
</div>
    <!--------------------------------------------->

    <!--表格設定-->
    <div class="grid-right1">
    <table class="table">
    <!--表頭設定-->
  <thead>
    <tr>
      <th scope="col">B</th>
      <th scope="col">數量</th>
      <th scope="col">最後更改日期</th>
    </tr>
  </thead>
    <!--------------------------------------------->
    <!--表格內容設定-->
  <tbody>
  <?php
  $QUA_values = array(); // 初始化存儲值的數組
    //選擇貨號
    if(isset($_SESSION["N"]))
    {
    $stmt=$pdo->prepare('select * from commodity where NUMBER=? and STYLE=? ORDER BY `commodity`.`SIZE` ASC');
    $stmt->execute(array($_SESSION["N"],"B"));
    $rows=$stmt->fetchAll();
    //-------------------------
     //顯示表格
     
    foreach($rows as $r)
    {
    echo"<tr><td>".$r["SIZE"]."<td>"."<input type='text' size='5' class='form-control' id='".$r["ID"]."' name='QUA_".$r["ID"]."' value=".$r['QUANTITY']." >"."<td>".$r["REMARK"]."<td>".$r["ID"]. 
   "</tr>";
    //-------------------------
    date_default_timezone_set('Asia/Taipei');
    $time=date("Y-m-d",time());
    //查詢修改
    if(isset($_POST['SUBB']))
    {
    $UPID=$r["ID"];
    $QUA=$_POST["QUA_".$r["ID"]].",";
    $stmt = $pdo->prepare('update commodity set QUANTITY=? , REMARK=? where ID=?');
    $stmt->execute(array($QUA,$time, $UPID));
    $input_name = 'QUA_' . $r["ID"]; // 將 input 元素的值存入數組中，使用 $r["ID"] 作為索引
    array_push($QUA_values,$_POST[$input_name]-$r['QUANTITY']);
    
    }
   }

   if(isset($_POST['SUBB']) and $r["SIZE"]==16)
    {
    $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`, TIME) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($_SESSION["N"], 'B', $QUA_values[0], $QUA_values[1], $QUA_values[2], $QUA_values[3], $QUA_values[4], $QUA_values[5], $QUA_values[6], $time));
    print_r($QUA_values);
    unset($_SESSION["N"]);
    header("Location:http://localhost/R2.php");
    }
    
  if(isset($_POST['SUBB']) and $r["SIZE"]==18)
    {
    $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`,`18`, TIME) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($_SESSION["N"], 'B', $QUA_values[0], $QUA_values[1], $QUA_values[2], $QUA_values[3], $QUA_values[4], $QUA_values[5], $QUA_values[6],$QUA_values[7], $time));
    print_r($QUA_values);
    unset($_SESSION["N"]);
    header("Location:http://localhost/R2.php");
    }
   
   //-------------------------

  echo "<button type='submit' class='btn btn-primary' id='SUBB' name='SUBB' font-size:20pt' >送出</button>";
   }

    ?>
  </tbody>
</table>
</div>
    <!--------------------------------------------->

<!--表格設定-->
<div class="grid-right1">
    <table class="table">
    <!--表頭設定-->
  <thead>
    <tr>
      <th scope="col">C</th>
      <th scope="col">數量</th>
      <th scope="col">最後更改日期</th>
    </tr>
  </thead>
    <!--------------------------------------------->
    <!--表格內容設定-->
  <tbody>
  <?php
  $QUA_values = array(); // 初始化存儲值的數組
    //選擇貨號
    if(isset($_SESSION["N"]))
    {
    $stmt=$pdo->prepare('select * from commodity where NUMBER=? and STYLE=? ORDER BY `commodity`.`SIZE` ASC');
    $stmt->execute(array($_SESSION["N"],"C"));
    $rows=$stmt->fetchAll();
    //-------------------------
     //顯示表格
     
    foreach($rows as $r)
    {
    echo"<tr><td>".$r["SIZE"]."<td>"."<input type='text' size='5' class='form-control' id='".$r["ID"]."' name='QUA_".$r["ID"]."' value=".$r['QUANTITY']." >"."<td>".$r["REMARK"]."<td>".$r["ID"]. 
   "</tr>";
    //-------------------------
    date_default_timezone_set('Asia/Taipei');
    $time=date("Y-m-d",time());
    //查詢修改
    if(isset($_POST['SUBC']))
    {
    $UPID=$r["ID"];
    $QUA=$_POST["QUA_".$r["ID"]].",";
    $stmt = $pdo->prepare('update commodity set QUANTITY=? , REMARK=? where ID=?');
    $stmt->execute(array($QUA,$time, $UPID));
    $input_name = 'QUA_' . $r["ID"]; // 將 input 元素的值存入數組中，使用 $r["ID"] 作為索引
    array_push($QUA_values,$_POST[$input_name]-$r['QUANTITY']);
    
    }
   }

   if(isset($_POST['SUBC']) and $r["SIZE"]==16)
    {
    $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`, TIME) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($_SESSION["N"], 'C', $QUA_values[0], $QUA_values[1], $QUA_values[2], $QUA_values[3], $QUA_values[4], $QUA_values[5], $QUA_values[6], $time));
    print_r($QUA_values);
    unset($_SESSION["N"]);
    }
    
  if(isset($_POST['SUBC']) and $r["SIZE"]==18)
    {
    $stmt = $pdo->prepare('INSERT INTO history (NUMBER, STYLE,`4`,`6`,`8`,`10`,`12`,`14`,`16`,`18`, TIME) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($_SESSION["N"], 'C', $QUA_values[0], $QUA_values[1], $QUA_values[2], $QUA_values[3], $QUA_values[4], $QUA_values[5], $QUA_values[6],$QUA_values[7], $time));
    print_r($QUA_values);
    unset($_SESSION["N"]);
    }
   
   //-------------------------

  echo "<button type='submit' class='btn btn-primary' id='SUBC' name='SUBC' font-size:20pt' >送出</button>";
   }
    ?>
  </tbody>
</table>
</div>
    <!--------------------------------------------->

    <!--表格設定-->
    <div class="grid-right1">
    <table class="table">
    <!--表頭設定-->
  <thead>
    <tr>
      <th scope="col">D</th>
      <th scope="col">數量</th>
      <th scope="col">最後更改日期</th>
    </tr>
  </thead>
    <!--------------------------------------------->
    <!--表格內容設定-->
  <tbody>
    <?php
  //選擇貨號
  if(isset($_SESSION["N"]))
    {
    $stmt=$pdo->prepare('select * from commodity where NUMBER=? and STYLE=? ORDER BY `commodity`.`SIZE` ASC');
    $stmt->execute(array($_SESSION["N"],"D"));
    $rows=$stmt->fetchAll();
    //-------------------------
     //顯示表格
    foreach($rows as $r)
    {
    echo"<tr><td>".$r["SIZE"]."<td>"."<input type='text' size='5' class='form-control' id='".$r["ID"]."' name='QUA_".$r["ID"]."' value=".$r['QUANTITY']." >"."<td>".$r["REMARK"]."<td>".$r["ID"]. 
   "</tr>";
    //-------------------------
    //查詢修改
    if(isset($_POST['SUB'])){
    $UPID=$r["ID"];
    $QUA=$_POST["QUA_".$r["ID"]];
    $stmt = $pdo->prepare('update commodity set QUANTITY=? where ID=?');
    $stmt->execute(array($QUA, $UPID));
    //-------------------------
  }
    }
  echo "<button type='submit' class='btn btn-primary' id='SUB' name='SUB' font-size:20pt' >送出</button>";
   }
    ?>
  </tbody>
</table>
</div>
    <!--------------------------------------------->

    <!--表格設定-->
    <div class="grid-right1">
    <table class="table">
    <!--表頭設定-->
  <thead>
    <tr>
      <th scope="col">E</th>
      <th scope="col">數量</th>
      <th scope="col">最後更改日期</th>
    </tr>
  </thead>
    <!--------------------------------------------->
    <!--表格內容設定-->
  <tbody>
  <?php
  //選擇貨號
  if(isset($_SESSION["N"]))
    {
    $stmt=$pdo->prepare('select * from commodity where NUMBER=? and STYLE=? ORDER BY `commodity`.`SIZE` ASC');
    $stmt->execute(array($_SESSION["N"],"E"));
    $rows=$stmt->fetchAll();
    //-------------------------
     //顯示表格
    foreach($rows as $r)
    {
    echo"<tr><td>".$r["SIZE"]."<td>"."<input type='text' size='5' class='form-control' id='".$r["ID"]."' name='QUA_".$r["ID"]."' value=".$r['QUANTITY']." >"."<td>".$r["REMARK"]."<td>".$r["ID"]. 
   "</tr>";
    //-------------------------
    //查詢修改
    if(isset($_POST['SUB'])){
    $UPID=$r["ID"];
    $QUA=$_POST["QUA_".$r["ID"]];
    $stmt = $pdo->prepare('update commodity set QUANTITY=? where ID=?');
    $stmt->execute(array($QUA, $UPID));
    //-------------------------
  }
    }
  echo "<button type='submit' class='btn btn-primary' id='SUB' name='SUB' font-size:20pt' >送出</button>";
   }
    ?>
  </tbody>
</table>
</div>
    <!--------------------------------------------->

    <!--表格設定-->
    <div class="grid-right1">
    <table class="table">
    <!--表頭設定-->
  <thead>
    <tr>
      <th scope="col">F</th>
      <th scope="col">數量</th>
      <th scope="col">最後更改日期</th>
    </tr>
  </thead>
    <!--------------------------------------------->
    <!--表格內容設定-->
  <tbody>
  <?php
  //選擇貨號
  if(isset($_SESSION["N"]))
    {
    $stmt=$pdo->prepare('select * from commodity where NUMBER=? and STYLE=? ORDER BY `commodity`.`SIZE` ASC');
    $stmt->execute(array($_SESSION["N"],"F"));
    $rows=$stmt->fetchAll();
    //-------------------------
     //顯示表格
    foreach($rows as $r)
    {
    echo"<tr><td>".$r["SIZE"]."<td>"."<input type='text' size='5' class='form-control' id='".$r["ID"]."' name='QUA_".$r["ID"]."' value=".$r['QUANTITY']." >"."<td>".$r["REMARK"]."<td>".$r["ID"]. 
   "</tr>";
    //-------------------------
    //查詢修改
    if(isset($_POST['SUB'])){
    $UPID=$r["ID"];
    $QUA=$_POST["QUA_".$r["ID"]];
    $stmt = $pdo->prepare('update commodity set QUANTITY=? where ID=?');
    $stmt->execute(array($QUA, $UPID));
    //-------------------------
  }
    }
  echo "<button type='submit' class='btn btn-primary' id='SUB' name='SUB' font-size:20pt' >送出</button>";
   }
    ?>
  </tbody>
</table>
</div>
    <!--------------------------------------------->

    <!--------------------------------------------->
    </div>
</div>
<!--------------------------------------------->
<?php

//顯示時間
date_default_timezone_set('Asia/Taipei');
$time=date("Y-m-d H:i",time());
//-------------------------






//貨號索引直最大值
$stmt=$pdo->prepare('select ID from commodity');
$stmt->execute(array());
$rows=$stmt->fetchAll();
foreach($rows as $r)
$r["ID"]; 
$max = max($r);
//-------------------------

//更改數量
//$update="UPDATE `commodity` SET QUANTITY=? WHERE ID=?";
//$stmt=$pdo->prepare($update);
//$stmt->execute(array());
//$rows=$stmt->fetchAll();
//foreach($rows as $r)
//-------------------------


?>
</form>

</body>