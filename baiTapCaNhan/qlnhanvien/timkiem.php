<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Tim kiem nhân viên</title>
<?php require("header.php"); ?>
<br>
</head>
<body>
<form action="" method="get">
<table bgcolor="#eeeeee" align="center" width="100%" border="1" 
	   cellpadding="5" cellspacing="5" style="border-collapse: collapse;">
<tr>
	<td align="center"><font color="blue"><h3>TÌM KIẾM THÔNG TIN NHÂN VIÊN</h3></font></td>
</tr>
<tr>
	<td align="center">Tên nhân viên: <input type="text" name="tennv" size="30" 
				value="<?php if(isset($_GET['tennv'])) echo $_GET['tennv'];?>">
			<input type="submit" name="tim" value="Tìm kiếm"></td>
</tr>
</table>
</form>
<?php 

if($_SERVER['REQUEST_METHOD']=='GET')
{
	if(empty($_GET['tennv'])) echo "<p align='center'>Vui lòng nhập tên sản phẩm</p>";
	else
	{
		$tennv=$_GET['tennv'];	
		require('connect.php');
		$query="SELECT nhanvien.*, Ten,TenPhong
		      from nhanvien,phongban 
		      WHERE nhanvien.MaPhong=phongban.MaPhong
					AND Ten like '%$tennv%'";
		$result=mysqli_query($dbc,$query);		
		if(mysqli_num_rows($result)<>0)
		{	$rows=mysqli_num_rows($result);
			echo "<div align='center'><b>Có $rows sản phẩm được tìm thấy.</b></div>";
			while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				echo '<table border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">
					<tr bgcolor="#eeeeee"><td colspan="2" align="center"><h3>'.
						$row['Ten'].' - '.$row['TenPhong'].'</h3></td></tr>';
				echo '<tr><td width="200" align="center"><img src="Hinh_nv/'.$row['Anh'].'"/></td>';
				echo '<td><i><b>Ngày sinh:</i></b><br />'.$row['NgaySinh'].'<br />';
				echo '<i><b>Địa chỉ:</b></i>'.$row['DiaChi'].'<br />';
				echo '<i><b>Giới tính: </b></i>'.$row['GioiTinh'];
						echo '</td></tr></table>';
			}
		}
		else echo "<div><b>Không tìm thấy sản phẩm này.</b></div>";
	}
}
?>
</body>
</html>
