<?php
session_start();
if(!isset($_SESSION["user"])){
    header("location:login1.php");
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php require("header.php"); ?>
<body>
<h1 style='color: red;' align='center' font-size:100%>QUẢN LÝ NHÂN VIÊN</h1>
<img class="img-fluid" src="Hinh_nv/banlamviec.jpg" width="750px" alt="">
<?php require("footer.php"); ?>
</body>
</html>