<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thêm mới</title>
</head>
<body>
<?php 
require('connect.php');
require("header.php");
?>
<form action="" method="post" enctype="multipart/form-data">
<table bgcolor="#eeeeee" align="center" width="100%" border="0">
<tr bgcolor="#eeee10">
	<td colspan="2" align="center"><font color="blue"><h2>THÊM NHÂN VIÊN</h2></font></td>
</tr>
<tr>
	<td>Mã nhân viên: </td>
	<td><input type="text" name="manv" size="20" value="<?php if(isset($_POST['manv'])) echo $_POST['manv'];?>" /></td>
</tr>
<tr>
	<td>Họ nhân viên: </td>
	<td><input type="text" name="ho" size="50" value="<?php if(isset($_POST['ho'])) echo $_POST['ho'];?>" /></td>
</tr>
<tr>
	<td>Tên nhân viên: </td>
	<td><input type="text" name="ten" size="50" value="<?php if(isset($_POST['ten'])) echo $_POST['ten'];?>" /></td>
</tr>

<tr>
	<td>Ngày sinh: </td>
	<td><input type="date" name="ngay_sinh" size="20" value="<?php if(isset($_POST['ngay_sinh'])) echo $_POST['ngay_sinh'];?>" /></td>
</tr>
<tr>
	<td>Giới tính </td>
	<td> Nam <input id="gioiTinh" name="gioi_tinh" type="radio" value="1" <?php if(isset($_POST['gioi_tinh'])&&($_POST['gioi_tinh'])=="1") echo 'checked'?> /> &nbsp;
        Nữ <input id="gioiTinh" name="gioi_tinh" type="radio" value="0" <?php if(isset($_POST['gioi_tinh'])&&($_POST['gioi_tinh'])=="0") echo 'checked'?> /></td>
</tr>
<tr>
	<td>Địa chỉ </td>
	<td><textarea name="dia_chi" rows="3" cols="50"> <?php if(isset($_POST['dia_chi'])) echo $_POST['dia_chi'];?> </textarea></td>
</tr>

<tr>
	<td>Hình ảnh: </td>
	<td><input type="FILE" name ="anh" size="80" value="<?php if(isset($_POST['anh'])) echo $_POST['anh'];?>" /></td>
</tr>

<tr>
	<td>Phòng ban:</td>
	<td><select name="phong_ban">
			<?php 
				$query="select * from phongban";	//Hiển thị tên các hãng sữa
				$result=mysqli_query($dbc,$query);
				if(mysqli_num_rows($result)<>0){
					while($row=mysqli_fetch_array($result)){
						$maPhong=$row['MaPhong'];
						$tenPhong=$row['TenPhong'];
						echo "<option value='$maPhong' "; 
								if(isset($_REQUEST['phongban']) && ($_REQUEST['phongban']==$maPhong)) echo "selected='selected'";
						echo ">$tenPhong</option>";
					}
				}
				mysqli_free_result($result);
			?>								
		</select>
	</td>
</tr>
<tr>
	<td>Loại nhân viên </td>
	<td><select name="loai_nv">
			<?php 
				$query="select * from loainv";	//Hiển thị tên các loại sữa
				$result=mysqli_query($dbc,$query);
				if(mysqli_num_rows($result)<>0){
					while($row=mysqli_fetch_array($result)){
						$maLoaiNv=$row['MaLoaiNV'];
						$tenLoaiNv=$row['TenLoaiNV'];
						echo "<option value='".$maLoaiNv."' "; 
							if(isset($_REQUEST['loai_nv']) && ($_REQUEST['loai_nv']==$maLoaiNv)) echo "selected='selected'";
						echo ">".$tenLoaiNv."</option>";
					}
				}
				mysqli_free_result($result);
			?>								
		</select>
	</td>
	<tr>
	<td colspan="2" align="center"><input type="submit" name ="them" size="10" value="Thêm mới" /></td>
</tr>
</tr>
</table>
</form>
<?php 
if($_SERVER['REQUEST_METHOD']=="POST"){
	$errors=array(); //khởi tạo 1 mảng chứa lỗi
	//kiem tra ma sua
	if(empty($_POST['manv'])){
		$errors[]="Bạn chưa nhập mã nhân viên";
	}
	else{
		$manv=trim($_POST['manv']);
	}
	//kiểm tra tên sản phẩm
	if(empty($_POST['ho'])){
		$errors[]="Bạn chưa nhập Họ nhân viên";
	}
	else{
		$ho_nv=trim($_POST['ho']);
	}
	if(empty($_POST['ten'])){
		$errors[]="Bạn chưa nhập tên nhân viên";
	}
	else{
		$ten_nv=trim($_POST['ten']);
	}
	//cap nhat ma hang sua va ma loai sua
	
	//kiem tra trong luong
	if(empty($_POST['ngay_sinh'])){
		$errors[]="Bạn chưa nhập ngày sinh";
	}
	else{
		$ngay_sinh=trim($_POST['ngay_sinh']);
	}
	//kiem tra don gia
	$gioi_tinh=$_POST['gioi_tinh'];
	//cap nhat thanh phan dinh duong va loi ich
	$dia_chi=$_POST['dia_chi'];

	//kiểm tra hình sản phẩm và thực hiện upload file
	if($_FILES['anh']['name']!=""){
		$hinh=$_FILES['anh'];
		$ten_hinh=$hinh	['name'];
		$type=$hinh['type'];
		$size=$hinh['size'];
		$tmp=$hinh['tmp_name'];
		if(($type=='image/jpeg' || ($type=='image/bmp') || ($type=='image/gif') && $size<8000))
		{
			move_uploaded_file($tmp,"Hinh_nv/".$ten_hinh);
		}
	}
	$maPhong=$_POST['phong_ban'];
	$maLoaiNv=$_POST['loai_nv'];
	if(empty($errors))//neu khong co loi xay ra
	{ 
		$query="INSERT INTO nhanvien VALUES ('$manv','$ho_nv','$ten_nv','$ngay_sinh','$gioi_tinh','$dia_chi','$ten_hinh',
		'$maLoaiNv','$maPhong')";
		$result=mysqli_query($dbc,$query);
		if(mysqli_affected_rows($dbc)==1){//neu them thanh cong
			echo "<div align='center'>Thêm mới thành công!</div>";			
			$query="Select nhanvien.*, TenPhong from nhanvien,phongban WHERE nhanvien.MaPhong=phongban.MaPhong
					AND MaNV ='". $manv. "'";
			$result=mysqli_query($dbc,$query);
			if(mysqli_num_rows($result)==1)
			{	$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				echo '<table align="center" border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">
						<tr bgcolor="#eeeeee"><td colspan="2" align="center"><h3>'.$row['Ten'].' - '.$row['TenPhong'].'</h3></td></tr>';
					echo '<tr><td><img src="Hinh_nv/'.$row['Anh'].'"/></td>';
								echo '<td><i><b>Ngày sinh:</i></b><br />'.$row['NgaySinh'].'<br />';
								echo '<i><b>Giới tính:</b></i>'.$row['GioiTinh'].'<br />';
								echo '<i><b>Địa chỉ: </b></i>'.$row['DiaChi'];
										echo '</td></tr></table>';				
			}
		}
		else //neu khong them duoc
		{
			echo "<p>Có lỗi, không thể thêm được</p>";
			echo "<p>".mysqli_error($dbc)."<br/><br />Query: ".$query."</p>";	
		}
	}
	else
	{//neu co loi
		echo "<h2>Lá»—i</h2><p>Có lỗi xảy ra:<br/>";
		foreach($errors as $msg)
		{
			echo "- $msg<br /><\n>";
		}
		echo "</p><p>Hãy thử lại.</p>";
	}
}
mysqli_close($dbc);
?>
</body>
</html>

