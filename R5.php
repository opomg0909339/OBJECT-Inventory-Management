

<?php
//資料庫連接
try {
    $pdo=new PDO("mysql:host=localhost;dbname=ru;","root","");
} catch (PDOException $err) {
    die("資料庫無法連接");
}
//----------------------------------------------------------------------
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="R5.css">
</head>
<body>
<div class="grid-container">

  <div class="grid-top-left">
    <?php
      echo("客戶代號"."<br>"."客戶名稱"."<br>"."地址");
    ?>
    </div>

    <div class="grid-top-mid">
    <?php
      echo("<br>"."日期");
    ?>
    </div>

    <div class="grid-top-right">
    <?php
      echo("單號"."<br>"."電話");
    ?>
    </div>
</div>

<div class="grid-mid">
    <div class="grid-mid-I">
    <?php
    echo("<br>");
    for($i=1;$i<=10;$i++)
    {
      echo($i."<br>");
    }
    ?>
    </div>

    <div class="grid-mid-II">
    <?php
    echo("<br>");
    echo("M411053-82");
    ?>
    </div>

    <div class="grid-mid-III">
    <?php
    echo("<br>");
      echo("品名");
    ?>
    </div>

    <div class="grid-mid-IV">
    <?php
    echo("<br>");
      echo("2");
    ?>
    </div>

    <div class="grid-mid-V">
    <?php
    echo("<br>");
      echo("件");
    ?>
    </div>

    <div class="grid-mid-VI">
    <?php
    echo("<br>");
      echo("1980");
    ?>
    </div>

    <div class="grid-mid-VII">
    <?php
    echo("<br>");
      echo("35.0");
    ?>
    </div>

    <div class="grid-mid-VIII">
    <?php
    echo("<br>");
      echo("1386");
    ?>
    </div>

    <div class="grid-mid-IX">
    <?php
    echo("<br>");
      echo("切貨");
    ?>
    </div>

</div>
<div class="grid-mid-down">

  <div class="grid-mid-down-I">
  </div>

  <div class="grid-mid-down-II">
  </div>

  <div class="grid-mid-down-III">
  <?php
    echo"1000"."<br>"."1000";
    ?>
  </div>

  <div class="grid-mid-down-IV">
  </div>

  <div class="grid-mid-down-V">
  </div>

  <div class="grid-mid-down-VI">
  <?php
   echo"1000"."<br>"."1000";
    ?>
  </div>

  <div class="grid-mid-down-VII">
  </div>
  

</div>

<div class="grid-container">

  <div class="grid-top-left">
    <?php
      echo("客戶代號"."<br>"."客戶名稱"."<br>"."地址");
    ?>
    </div>

    <div class="grid-top-mid">
    <?php
      echo("<br>"."日期");
    ?>
    </div>

    <div class="grid-top-right">
    <?php
      echo("單號"."<br>"."電話");
    ?>
    </div>
</div>

<div class="grid-mid">
    <div class="grid-mid-I">
    <?php
    echo("<br>");
    for($i=1;$i<=10;$i++)
    {
      echo($i."<br>");
    }
    ?>
    </div>

    <div class="grid-mid-II">
    <?php
    echo("<br>");
    echo("M411053-82");
    ?>
    </div>

    <div class="grid-mid-III">
    <?php
    echo("<br>");
      echo("品名");
    ?>
    </div>

    <div class="grid-mid-IV">
    <?php
    echo("<br>");
      echo("2");
    ?>
    </div>

    <div class="grid-mid-V">
    <?php
    echo("<br>");
      echo("件");
    ?>
    </div>

    <div class="grid-mid-VI">
    <?php
    echo("<br>");
      echo("1980");
    ?>
    </div>

    <div class="grid-mid-VII">
    <?php
    echo("<br>");
      echo("35.0");
    ?>
    </div>

    <div class="grid-mid-VIII">
    <?php
    echo("<br>");
      echo("1386");
    ?>
    </div>

    <div class="grid-mid-IX">
    <?php
    echo("<br>");
      echo("切貨");
    ?>
    </div>

</div>
<div class="grid-mid-down">

  <div class="grid-mid-down-I">
  </div>

  <div class="grid-mid-down-II">
  </div>

  <div class="grid-mid-down-III">
  <?php
    echo"1000"."<br>"."1000";
    ?>
  </div>

  <div class="grid-mid-down-IV">
  </div>

  <div class="grid-mid-down-V">
  </div>

  <div class="grid-mid-down-VI">
  <?php
   echo"1000"."<br>"."1000";
    ?>
  </div>

  <div class="grid-mid-down-VII">
  </div>
  

</div>

</body>