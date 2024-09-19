<?php
//資料庫連接
try {
    $pdo=new PDO("mysql:host=localhost;dbname=ru;","root","");
} catch (PDOException $err) {
    die("資料庫無法連接");
}


//----------------------------------------------------------------------

// 分頁設定
$limit = 15; // 每頁顯示的記錄數
$page = isset($_GET['page']) ? $_GET['page'] : 1; // 目前所在的頁數
$start = ($page - 1) * $limit; // 查詢的起始位置

// 查詢資料總數
$total_stmt = $pdo->prepare('SELECT COUNT(*) as total FROM commodity');
$total_stmt->execute();
$total_rows = $total_stmt->fetch(PDO::FETCH_ASSOC)['total'];

// 總頁數
$total_pages = ceil($total_rows / $limit);

// 查詢需要顯示的資料
$stmt=$pdo->prepare('SELECT * FROM commodity ORDER BY ID DESC LIMIT :start, :limit');
$stmt->bindParam(':start', $start, PDO::PARAM_INT);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$rows=$stmt->fetchAll();
?>

<html>
<head>
    <!--基本設定-->
    <meta charset='utf-8'>
    <link rel="stylesheet" type="text/css" href="R12.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"    
    rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!----------------------------------------------------------------------------------------------------------------------------->
</head>

<body>
    <div class="grid-container">
      
    <!--輸入設定-->
    <div class="grid-left">
    <form  method="POST" action="R12.php">
    <label for="exampleFormControlInput1" class="form-label">選擇商品種類</label>  
    <select class="form-select form-select-lg mb-3" style="padding-top:15px" aria-label=".form-select-lg example" name="sel" id="sel">
    <option value="AL">亞蘭夢藤</option>
    <option value="BATIS">巴帝斯</option>
    <option value="BENNY">貝妮</option>
    <option value="BR">貝柔</option>
    <option value="MYDNA">仁惠</option>
    <option value="KING">金安德森</option>
    <option value="BIGKING">金安德森-大</option>
    <option value="SMALLKINK">金安德森-小</option>
    <option value="MG">瑪格麗特</option>
    <option value="BOBOLI">波波利</option>
    <option value="KUMA">熊本熊</option>
    <option value="POLI">波利</option>
    <option value="BEBABY">比貝比</option>
    </select>

  <?php
    if(isset($_POST["sel"]))
    {
      $sel=$_POST["sel"];
      echo $sel;
    }
  ?>
  
    <label for="exampleFormControlInput1" class="form-label" style="padding-top:15px" >新增商品</label>
    <input type="text" class="form-control" id="NUM" name="NUM"   placeholder="例:貨號-花板-最大尺寸">
    <label for="exampleFormControlInput1" class="form-label" style="padding-top:15px" >標題</label>
    <input type="text" class="form-control" id="tit" name="tit" placeholder="例:新幹線純棉四角內褲">
    <label for="exampleFormControlInput1" class="form-label" style="padding-top:15px" >材質</label>
    <input type="text" class="form-control" id="mat" name="mat" >
    <label for="exampleFormControlInput1" class="form-label" style="padding-top:15px" >價格</label>
    <input type="text" class="form-control" id="pri" name="pri" >
    <label for="exampleFormControlInput1" class="form-label" style="padding-top:15px" >成本</label>
    <input type="text" class="form-control" id="COS" name="COS" >
    <label for="exampleFormControlInput1" class="form-label" style="padding-top:15px" >數量</label>
    <input type="text" class="form-control" id="q" name="q" >
    <button type="submit" class="btn btn-primary" id="sub" name="sub" style="margin-top: 20px; font-size:20pt" >送出</button>
    </form>
    <form  method="POST" action="rindex.php">
    <button type="submit" class="btn btn-primary" id="back" name="back" style=" font-size:20pt" >返回</button>
    </form>
    </div>
    </form>
    



    <!--輸入設定-->

    <!--表格設定-->
    <div class="grid-right">
    <table class="table">
    <!--表頭設定-->
  <thead>
    <tr>
      <th scope="col">貨號</th>
      <th scope="col">花板</th>
      <th scope="col">尺寸</th>
      <th scope="col">數量</th>
      <th scope="col">最後更改日期</th>
    </tr>
  </thead>
    <!--------------------------------------------->

    <!--表格內容設定-->
  <tbody>
  <?php
                foreach($rows as $r) {
                    echo "<tr>";
                    echo "<td>{$r['NUMBER']}</td>";
                    echo "<td>{$r['STYLE']}</td>";
                    echo "<td>{$r['SIZE']}</td>";
                    echo "<td>{$r['QUANTITY']}</td>";
                    echo "<td>{$r['REMARK']}</td>";
                    echo "</tr>";
                }
                ?>
  </tbody>
</table>
 <!-- 分頁控制按鈕 -->
 <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">上一頁</span>
                    </a>
                </li>
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo $page == $i ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php echo $page >= $total_pages ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">下一頁</span>
                    </a>
                </li>
            </ul>
        </nav>
</div>
    <!--------------------------------------------->


</div>

</div>
<!--------------------------------------------->

<?php

//顯示時間
date_default_timezone_set('Asia/Taipei');
$time=date("Y-m-d",time());
//-------------------------

//貨號字串分割
if(isset($_POST["sub"])&&$_POST["NUM"]!="")
{
$num = explode("-",$_POST["NUM"]);
//-------------------------

//搜尋資料
if(isset($_POST["sel"]))
{

$stmt=$pdo->prepare('select * from commodity where NUMBER=? and STYLE=? and SIZE=?');
$stmt->execute(array($num[0],$num[1],$num[2]));
$rows=$stmt->fetchAll();

//-------------------------

//判斷是否重複
if (count($rows)>0) 
      {
        $err= "帳號重複";
        echo $err;
      } 
//-------------------------
else
{
//新增貨號
if($num[2]==18)
{
  for($I=4;$I<=18;$I+=2)
  {
  $stmt=$pdo->prepare('insert into commodity(ITEMNUMBER,NUMBER,STYLE,SIZE,QUANTITY,REMARK,TITLE,MATERIAL,PRICE,COST,BRAND) values(?,?,?,?,?,?,?,?,?,?,?)');
  $stmt->execute(array($num[0]."-".$num[1]."-".$I,$num[0],$num[1],$I,$_POST["q"],$time,$_POST["tit"],$_POST["mat"],$_POST["pri"],$_POST["COS"],$_POST["sel"]));
  }
}
if($num[2]==16)
{
  for($I=4;$I<=16;$I+=2)
  {
  $stmt=$pdo->prepare('insert into commodity(ITEMNUMBER,NUMBER,STYLE,SIZE,QUANTITY,REMARK,TITLE,MATERIAL,PRICE,COST,BRAND) values(?,?,?,?,?,?,?,?,?,?,?)');
  $stmt->execute(array($num[0]."-".$num[1]."-".$I,$num[0],$num[1],$I,$_POST["q"],$time,$_POST["tit"],$_POST["mat"],$_POST["pri"],$_POST["COS"],$_POST["sel"]));
  }
}
if($num[2]==14)
{
  for($I=4;$I<=14;$I+=2)
  {
  $stmt=$pdo->prepare('insert into commodity(ITEMNUMBER,NUMBER,STYLE,SIZE,QUANTITY,REMARK,TITLE,MATERIAL,PRICE,COST,BRAND) values(?,?,?,?,?,?,?,?,?,?,?)');
  $stmt->execute(array($num[0]."-".$num[1]."-".$I,$num[0],$num[1],$I,$_POST["q"],$time,$_POST["tit"],$_POST["mat"],$_POST["pri"],$_POST["COS"],$_POST["sel"]));
  }
}
if($num[2]==12)
{
  for($I=4;$I<=12;$I+=2)
  {
  $stmt=$pdo->prepare('insert into commodity(ITEMNUMBER,NUMBER,STYLE,SIZE,QUANTITY,REMARK,TITLE,MATERIAL,PRICE,COST,BRAND) values(?,?,?,?,?,?,?,?,?,?,?)');
  $stmt->execute(array($num[0]."-".$num[1]."-".$I,$num[0],$num[1],$I,$_POST["q"],$time,$_POST["tit"],$_POST["mat"],$_POST["pri"],$_POST["COS"],$_POST["sel"]));
  }
}
//-------------------------
}
}
}


?>


</body>