<?php
    if (isset($_GET['MaNV']) && $_GET['MaNV'] != "") {
        // Lấy mã, kiểm tra có nhân viên này trong db không, tại nhiều lúc ngta nhập trên URL mã tầm bậy
        $maNV = $_GET['MaNV'];
        // Kết nối db để thực hiện truy vấn
        include "connect.php";
        // Viết truy vấn tìm xem có nhân viên trong db không
        $qr = "SELECT nv.*, lnv.TenLoaiNV, pb.TenPhong FROM nhanvien nv, phongban pb, loainv lnv WHERE nv.MaNV = '$maNV' AND nv.MaLoaiNV = lnv.MaLoaiNV AND nv.MaPhong = pb.MaPhong";
        // Thực thi câu truy vấn
        $result = mysqli_query($dbc, $qr);

        $qr1 = "SELECT * FROM loainv";
        $result1 = mysqli_query($dbc, $qr1);
        $arr = [];
        while($row1 = mysqli_fetch_array($result1)) {
            array_push($arr, $row1);
        }

        
        $qr2 = "SELECT * FROM phongban";
        $result2 = mysqli_query($dbc, $qr2);
        $arr2 = [];
        while($row2 = mysqli_fetch_array($result2)) {
            array_push($arr2, $row2);
        }
   

        if (mysqli_num_rows($result) != 0) {
            // Chắc chắn chỉ ra 1 bản bên gán vầy luôn
            $row = mysqli_fetch_array($result);
        } else {
            echo "Không tìm thấy";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    
            // Mã nhân viên bây giờ lấy từ POST ra
            $maNV = $_POST['MaNV'];
            $ho = $_POST['ho'];
            $ten = $_POST['ten'];
            $ngaySinh = $_POST['ngaySinh'];
            $gioiTinh = $_POST['gioiTinh'];
            $diaChi = $_POST['diaChi'];
            $loaiNV = $_POST['loaiNV'];
            $phongban = $_POST['phongban'];
            //if isset file anh thì
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
                $query = "UPDATE nhanvien SET Ho = '$ho', Ten = '$ten', NgaySinh = '$ngaySinh', GioiTinh = '$gioiTinh', DiaChi = '$diaChi', Anh = '$ten_hinh', MaLoaiNV = '$loaiNV' WHERE MaNV = '$maNV'";
            }
            else{
                $query = "UPDATE nhanvien SET Ho = '$ho', Ten = '$ten', NgaySinh = '$ngaySinh', GioiTinh = '$gioiTinh', DiaChi = '$diaChi', MaLoaiNV = '$loaiNV' WHERE MaNV = '$maNV'";
            }
            
            //else
//kiểu v ảnh lấy trong $_FILE chứ
            // Kết nối db rồi
            // Viết query xóa
            
            // Thực thi câu truy vấn
            $result = mysqli_query($dbc, $query);   
            // Kiểm tra xóa thành công hay chưa
            if (mysqli_affected_rows($dbc) == 1 || mysqli_affected_rows($dbc) == 0) {
                
                header('Location: hienthi.php');
            } else {
                echo "Có lỗi";
            }
        }
    }
    ?>
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h2 class="text-center">CẬP NHẬT THÔNG TIN NHÂN VIÊN</h2>
		</div>
		<div class="panel-body">
		<form action="" method="post" enctype="multipart/form-data">
		<table bgcolor="#eeeeee" align="center" width="100%" border="0">
	<tr bgcolor="#eeee10">
	<td colspan="2" align="center"><font color="blue"><h2>SỬA NHÂN VIÊN</h2></font></td>
</tr>
<tr>
	<td>Mã nhân viên: </td>
	<td><input required="true" type="text" class="form-control" id="MaNV" name="MaNV" disabled value="<?php echo $row[0]; ?>">
	<input type="hidden" name="MaNV" value="<?php echo $row[0]; ?>"></td>
</tr>
<tr>
	<td>Họ nhân viên: </td>
	<td><input required="true" type="text" class="form-control" id="ho" name="ho" value="<?php echo $row[1];  ?>"></td>
</tr>
<tr>
	<td>Tên nhân viên: </td>
	<td><input required="true" type="text" class="form-control" id="ten" name="ten" value="<?php echo $row[2];  ?>"></td>
</tr>

<tr>
	<td>Ngày sinh: </td>
	<td><input type="date" class="form-control" name="ngaySinh" value="<?php echo $row[3]; ?>"></td>
</tr>
<tr>
	<td>Giới tính </td>
	<td>  Nam <input id="gioiTinh" name="gioiTinh" type="radio" value="1" <?php echo $row[4] == 1 ? 'checked' : '' ?> /> &nbsp;
          Nữ <input id="gioiTinh" name="gioiTinh" type="radio" value="0" <?php echo $row[4] == 0 ? 'checked' : '' ?> /></td>
</tr>
<tr>
	<td>Địa chỉ </td>
	<td><input required="true" type="text" class="form-control" id="diaChi" name="diaChi" value="<?php echo $row[5] ?>"></td>
</tr>

<tr>
	<td>Hình ảnh: </td>
	<td><input type="FILE" id="anh" name="anh" ></td>
</tr>

<tr>
	<td>Phòng ban:</td>
	<td><select name="phongban" class="form-control">
						<!-- <option value="<?php echo $row['MaPhong'] ?>" class="form-control"> -->
						<?php
						echo $row['TenPhong'];
						?></option>
						<?php
						foreach ($arr2 as $phongban) {
							if ($row['MaPhong'] == $phongban['MaPhong']) {
								$s = "selected";
							} else {
								$s = "";
							}
							echo '<option ' . $s . ' value="' . $phongban['MaPhong'] . '" class = "form-control">' . $phongban['TenPhong'] . '</option>';
						}
						?>
					</select>
	</td>
</tr>
<tr>
	<td>Loại nhân viên </td>
	<td><select name="loaiNV" class="form-control">
						<!-- <option value="<?php echo $row['MaLoaiNV'] ?>" class="form-control"> -->
						<?php
						echo $row['TenLoaiNV'];

						?></option>
						<?php
						foreach ($arr as $loaiNV) {
							if ($row['MaLoaiNV'] == $loaiNV['MaLoaiNV']) {
								$s = "selected";
							} else {
								$s = "";
							}
							echo '<option ' . $s . ' value="' . $loaiNV['MaLoaiNV'] . '" class = "form-control">' . $loaiNV['TenLoaiNV'] . '</option>';
						}
						?>
					</select>
	</td>
	<tr>
	<td colspan="2" align="center"> 
        <input type="submit" value="Lưu"></td>
</tr>
</tr>
</table>
</form>
		</div>
	</div>
</div>


