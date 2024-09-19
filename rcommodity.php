<!DOCTYPE html>
<html lang="en">
<head>
    <!--基本設定-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品頁面</title>
    <link rel="stylesheet" type="text/css" href="rindex.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"    
    rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <!----------------------------------------------------------------------------------------------------------------------------->
</head>

<body>   
<div class="grid-top" >
<label for="exampleFormControlInput1" class="form-label" style="padding-top:15px" >如晟有限公司小系統</label>  
</div>
<div class="grid-down">
<form  method="POST" action="R1.php" style="padding-top:15px">
  <button type="submit" class="btn btn-primary" style="font-size:30pt" ; id="add">新增品項</button>
</form>
<form  method="POST" action="R4.php" style="padding-top:15px">
<button type="submit" class="btn btn-primary" style="font-size:30pt" id="serch">查詢修改</button>
</form>
<form  method="POST" action="R14.php" style="padding-top:15px">
<button type="submit" class="btn btn-primary" style="font-size:30pt" id="back">商品進貨</button>
</form>
<form  method="POST" action="R16.php" style="padding-top:15px">
<button type="submit" class="btn btn-primary" style="font-size:30pt" id="back">進貨修改</button>
</form>
<form  method="POST" action="R18.php" style="padding-top:15px">
<button type="submit" class="btn btn-primary" style="font-size:30pt" id="back">進貨退回</button>
</form>
<form  method="POST" action="R3.php" style="padding-top:15px">
  <button type="submit" class="btn btn-primary" style="font-size:30pt" id="his">進銷紀錄</button>
  </form>
<form  method="POST" action="rindex.php" style="padding-top:15px">
<button type="submit" class="btn btn-primary" style="font-size:30pt" id="back">返回</button>
</form>
  </div>

</body>
</html>