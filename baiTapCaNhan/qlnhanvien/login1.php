
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Login</title>
</head>

<body>
    <?php
    if(isset($_POST['login']))
    {
        if($_POST['username']==null)
        {
            echo("nhap lai user");
        }
        else{
            $u=$_POST['username'];
        }
        if($_POST['password']==null)
        {
            echo("nhap lai pass");
        }
        else{
            $p=$_POST['password'];
        }
        if($u && $p)
        {
            require("connect.php");
            $strSQL = "SELECT * FROM nguoidung where user='".$u."' and password='".$p."'";
            $result = mysqli_query($dbc,$strSQL);
            if(mysqli_num_rows($result)==0)
            {
                echo "please try again";
            }
            else{
                header('Location: http://localhost/BaiTapPHP/qlnhanvien/hienthi.php');
                die();
            }
        }
    }
    ?>
     <div class="form_dang_nhap">
     <h2>Đăng Nhập</h2>
     <form action="cookie1.php" method="post">
         <div class="o_nhap">
             <input type="text" name="username" required="">
             <label>Tên Đăng Nhập</label>
         </div>
         <div class="o_nhap">
             <input type="password" name="password" required="">
             <label>Mật Khẩu</label>
         </div>
         <input type="submit" name="login" value="Đăng Nhập">
     </form>
 </div>
</body>
</html>