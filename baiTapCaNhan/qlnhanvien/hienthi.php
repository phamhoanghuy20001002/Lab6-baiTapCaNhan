
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<!-- Latest compiled and minified CSS & JS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<title>Thong tin nhân viên</title>
</head>

<body>

<?php 
require("header.php");
// Ket noi CSDL
require("connect.php");

$rowsPerPage=2; //số mẩu tin trên mỗi trang, giả sử là 10
if (!isset($_GET['page']))
{ $_GET['page'] = 1;
}
//vị trí của mẩu tin đầu tiên trên mỗi trang
$offset =($_GET['page']-1)*$rowsPerPage;
$strSQL = "SELECT * FROM nhanvien LIMIT $offset , $rowsPerPage";
$result = mysqli_query($dbc,$strSQL);
// Xu ly du lieu tra ve
if(mysqli_num_rows($result) == 0)
{
	echo "Chưa có dữ liệu";
}
else
{	echo "<h1 style='color: blue;' align='center'>THÔNG TIN NHÂN VIÊN</h1>
		  <table align='center' width='800' border='1' cellpadding='2' cellspacing='2' 
				style='border-collapse: collapse;'>
		  	<tr style='background-color: #0084ab;' align='center'>
				<td><b>Mã nhân viên</b></td>
				<td><b>Họ nhân viên</b></td>
				<td><b>tên nhân viên</b></td>
				<td><b>Ngày sinh</b></td>
				<td><b>Giới tính</b></td>
                <td><b>Địa chỉ</b></td>
                <td><b>Ảnh</b></td>
			
				<td><b>Sữa</b></td>
				<td><b>Xóa</b></td>
                
		  	</tr>";
	$stt=1;
	while ($row = mysqli_fetch_array($result))
	{
		if($stt%2!=0)
		{	echo "<tr>";
			echo "<td>$row[0]</td>";
			echo "<td>$row[1]</td>";
			echo "<td>$row[2]</td>";
			echo "<td>$row[3]</td>";
			echo "<td>$row[4]</td>";
            echo "<td>$row[5]</td>";
			echo "<td>";?>
			<img src="Hinh_nv/<?php echo $row['Anh'];?>" width="60" height="60" style="border-radius:50px"/>
			<?php
			echo "</td>";
		
			echo "<td>";
			?>

			<button type="button" class="btn btn-outline-warning"onclick="window.open('sua.php?MaNV=<?php echo $row['MaNV'];?>')">Edit</button>

			</td>
			<td>
			<button type="button" class="btn btn-outline-warning"onclick="window.open('xoa.php?MaNV=<?php echo $row['MaNV'];?>')">delete</button>

			</td>
			<?php 
			echo "</tr>";
		}
		else
		{
			echo "<tr style='background-color: #ffb1007a;'>";
			echo "<td>$row[0]</td>";
			echo "<td>$row[1]</td>";
			echo "<td>$row[2]</td>";
			echo "<td>$row[3]</td>";
			echo "<td>$row[4]</td>";
            echo "<td>$row[5]</td>";
			echo "<td>";?>
			<img src="Hinh_nv/<?php echo $row['Anh'];?>" width="60" height="60" style="border-radius:50px" />
			<?php
			echo "</td>";
			
			echo "<td>";
			?>
			<button type="button" class="btn btn-outline-warning"onclick="window.open('sua.php?MaNV=<?php echo $row['MaNV'];?>')">Edit</button>

			</td>
			<td>
			<button type="button" class="btn btn-outline-warning"onclick="window.open('xoa.php?MaNV=<?php echo $row['MaNV'];?>')">delete</button>

			</td>
			<?php 

		
			echo "</tr>";
		}
			$stt+=1;
	}
	echo '</table>';
$re = mysqli_query($dbc, 'SELECT * from nhanvien');
//tổng số mẩu tin cần hiển thị
$numRows = mysqli_num_rows($re);
//tổng số trang
$maxPage = floor($numRows/$rowsPerPage) + 1;
$fpage=1;

if ($_GET['page'] > 1)
{echo "<a href=". $_SERVER['PHP_SELF']."?page="
    .($fpage)."> << </a>";
    echo "<a href=" .$_SERVER['PHP_SELF']."?page="
.($_GET['page']-1).">Back</a> ";
}


for ($i=1 ; $i<=$maxPage ; $i++)
{ 
	if ($i == $_GET['page'])
	{ 
		echo '<b>'.$i.'</b> '; //trang hiện tại sẽ được bôi đậm
	}
	else
		echo "<a href=" .$_SERVER['PHP_SELF']. "?page="
.$i.">".$i."</a> ";
}
//gắn thêm nút Next
if ($_GET['page'] < $maxPage)
{
    echo "<a href=". $_SERVER['PHP_SELF']."?page="
.($_GET['page']+1).">Next </a>";
echo "<a href=". $_SERVER['PHP_SELF']."?page="
.($maxPage)."> >></a>";
}
}
//Dong ket noi
mysqli_close($dbc);

?>
</body>
<?php require("footer.php"); ?>
</html>
