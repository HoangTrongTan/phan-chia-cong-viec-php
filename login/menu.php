<?php
include_once('../dbcontext/db.php');
$db = new Database();
if (!isset($_SESSION)) {
	session_start();
}
if (isset($_POST['dangnhapbtn'])) {
	
	$taikhoan = isset($_POST['taikhoan']) ? $_POST['taikhoan'] : '';
	$matkhau = isset($_POST['matkhau']) ? $_POST['matkhau'] : '';
	// echo $matkhau = password_hash($_POST['matkhau'],PASSWORD_DEFAULT);

	$check = $db->thucthi("SELECT * FROM `teachers` WHERE account = '$taikhoan' and `password` = '$matkhau' ");
	$row = mysqli_fetch_array($check);
	if (!$row) {
		$check = $db->thucthi("SELECT * FROM `student` WHERE account = '$taikhoan' and `password` = '$matkhau' ");
		$row = mysqli_fetch_array($check);
		if ($row) {
			$_SESSION['name_user'] = $row['fullname'];
			$_SESSION['ten'] = $row['account'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['hocsinh'] = true;
			echo "<script>alert('đăng nhập thành công')</script>";
			echo "<script>window.location.href='../student/index.php'</script>";
		} else {
			echo "<script>alert('tài khoản mật khẩu không hợp lệ')</script>";
		}
	} else {
		$_SESSION['name_user'] = $row['fullname'];
		$_SESSION['ten'] = $row['account'];
		$_SESSION['id'] = $row['id'];
		echo "<script>alert('đăng nhập thành công')</script>";
		echo "<script>window.location.href='../teacher/index.php'</script>";
	}
}

if (isset($_POST['dangkybtn'])) {

	$tendangnhap = isset($_POST['fullname']) ? $_POST['fullname'] : '';
	$taikhoan = isset($_POST['taikhoan']) ? $_POST['taikhoan'] : '';
	$matkhau = isset($_POST['matkhau']) ? $_POST['matkhau'] : '';
	$matkhau_repart = isset($_POST['matkhau_repart']) ? $_POST['matkhau_repart'] : '';
	$chucvu = isset($_POST['chucvu']) ? $_POST['chucvu'] : '';
	$gv = isset($_POST['gv']) ? $_POST['gv'] : '';


	// echo kiemTraSo($taikhoan);
	if (strlen($taikhoan) < 8 ) {
		echo "<script>alert('tài khoản phải đủ 8 kí tự  ')</script>";
	} else if (strlen($matkhau) < 8 ) {
		echo "<script>alert('mật khẩu phải đủ 8 kí tự') </script>";
	} else if (strlen($tendangnhap) < 8) {
		echo "<script> alert('nhập đủ 8 kí tự cho tên người dùng nhé :>')</script>";
	}else if($matkhau != $matkhau_repart){
		echo "<script> alert('mật khẩu không khớp ')</script>";
	} else {
		if ($chucvu == "") {
			$check = $db->thucthi("INSERT INTO `teachers`(`account`, `password`, `fullname`) VALUES ('$taikhoan','$matkhau','$tendangnhap')");
			if($check){
				echo "<script>alert('đăng ký thành công') </script>";
				echo "<script>location.href = location.href;</script>";

			}
		}
		else{
			$check = $db->thucthi("INSERT INTO `student`(`account`, `password`, `fullname`,`idgiaovien`) VALUES ('$taikhoan','$matkhau','$tendangnhap','$gv')");
			if($check){
				echo "<script>alert('đăng ký thành công') </script>";
				echo "<script>location.href = location.href;</script>";
			}
		}
		
	}
}
$lops = $db->thucthi("SELECT * FROM `teachers`");

?>
<link rel="stylesheet" href="menu.css">
<div id="bg">
	<div class="module">

		<form class="formdangnhap" method="post">
			<input type="text" placeholder="Tài khoản" class="textbox" name="taikhoan" />
			<input type="password" placeholder="Mật khẩu" class="textbox" name="matkhau" />
			<input type="submit" value="Đăng nhập" class="button" name="dangnhapbtn" />
		</form>

		<form class="form hide" method="post">
			<input type="text" placeholder="Tài khoản" class="textbox" name="taikhoan" />
			<input type="password" placeholder="Mật khẩu" class="textbox" name="matkhau" />
			<input type="password" placeholder="Mật khẩu" class="textbox" name="matkhau_repart" />
			<input type="text" placeholder="full name" class="textbox" name="fullname" />
			<div>
				<select name="chucvu" id="chucvu">
					<option value="ok" selected>học sinh</option>
					<option value="">giáo viên</option>
				</select>
				<div class="class-section">
					<span>Giáo viên</span>
					<select name="gv" id="chucvu">
						<?php while ($row1 = mysqli_fetch_assoc($lops)) { ?>
							<option value="<?php echo $row1['id'] ?>"><?php echo $row1['fullname'] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<input type="submit" value="Đăng ký" class="button" name="dangkybtn" />
		</form>

		<div class="dangky">
			<button class="buttondk">Chưa có tài khoản</button>
		</div>
	</div>
</div>
<script>
	const $ = document.querySelector.bind(document);
	$('.buttondk').onclick = () => {
		$('.form').classList.toggle('active');
		$('.formdangnhap').classList.toggle('hide');

		$('.buttondk').classList.toggle('id');
		if ($('.buttondk').classList.contains("id")) {
			$('.buttondk').innerHTML = "trờ về đăng nhập"
		} else {

			$('.buttondk').innerHTML = "Chưa có tài khoản"
		}
	}
	$('#chucvu').onchange = (e) => {
		if(e.target.value == ""){
			$('.class-section').classList.add('none');
		}else{
			$('.class-section').classList.remove('none');
		}
	}
</script>