<?php # Script 10.2 - delete_user.php
// This page is for deleting a user record.
// This page is accessed through view_users.php.

$page_title = 'xóa Nhân Viên';
include ('header.php');
include("connect.php");
echo '<h1>Bạn có chắc muốn Xóa Nhân Viên</h1>';

if (isset($_GET['MaNV']) && $_GET['MaNV'] != "") {
	// Lấy mã, kiểm tra có nhân viên này trong db không, tại nhiều lúc ngta nhập trên URL mã tầm bậy
	$maNV = $_GET['MaNV'];
	// Kết nối db để thực hiện truy vấn
	// Viết truy vấn tìm xem có nhân viên trong db không
}
else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('footer.html'); 
	exit();
}
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['submit'] ) { // Delete the record.

		// Make the query:
		$q = "DELETE FROM nhanvien WHERE MaNV='$maNV' LIMIT 1";		
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

			// Print a message:
            echo "
            <script language='javascript'>
                alert('Xóa thành công');
                window.open('hienthi.php','_self', 1);
            </script>
        ";

		}  else { // If the query did not run OK.
			echo '<p class="error">The user could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}
	
	} else { // No confirmation of deletion.
		echo '<p>Nhân viên không được xóa.</p>';	
	}

} else { // Show the form.

	// Retrieve the user's information:
	$q = "SELECT CONCAT(Ho, ' ', Ten) FROM nhanvien WHERE MaNV='$maNV'";
	$r = @mysqli_query ($dbc, $q);

	if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
		// Get the user's information:
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		
		// Display the record being deleted:
		echo "<h3>Tên NV: $row[0]</h3>
		Bạn có chắc chắn xóa nhân viên này?";
		
		// Create the form:
		echo ''?>
    <form action="xoa.php?MaNV=<?php echo $maNV?>" method="post">
	
	<input type="submit" name="submit" value="Xóa" />
	<input type="hidden" name="maNV" value="<?php echo $maNV ?>" />
	</form>
    <?php
    echo '';
	
	} else { // Not a valid user ID.
		echo '<p class="error">This page has been accessed in error.</p>';
	}

} // End of the main submission conditional.

mysqli_close($dbc);
		
include ('footer.php');
?>