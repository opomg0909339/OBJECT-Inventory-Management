<!DOCTYPE html>
<html lang="en">
<head>
    <!--基本設定-->
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>如晟公司小系統</title>
    <link rel="stylesheet" type="text/css" href="rindex.css">
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"    
    rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"-->
    
    <!----------------------------------------------------------------------------------------------------------------------------->
</head>

<body>   
<div class="grid-top" >
<label for="exampleFormControlInput1" class="form-label" style="padding-top:15px" >如晟有限公司小系統</label>  
</div>
<div class="grid-down">
<form  method="POST" action="rcommodity.php" style="padding-top: 30px;">
  <button type="submit" class="btn btn-primary" style="font-size:30pt" ; id="add">商品管理</button>
</form>
  <form  method="POST" action="R6.php" style="padding-top: 30px;">
  <button type="submit" class="btn btn-primary" style="font-size:30pt" id="his">新增店家</button>
  </form>
  <form  method="POST" action="R2.php" style="padding-top: 30px;">
  <button type="submit" class="btn btn-primary" style="font-size:30pt" id="his">新增廠商</button>
  </form>
  <form  method="POST" action="R8.php" style="padding-top: 30px;">
  <button type="submit" class="btn btn-primary" style="font-size:30pt" id="his">店家出貨</button>
  </form>
  <form  method="POST" action="R10.php" style="padding-top: 30px;"> 
  <button type="submit" class="btn btn-primary" style="font-size:30pt" id="his">修改訂單</button>
  </form>
  </div>

</body>
</html>