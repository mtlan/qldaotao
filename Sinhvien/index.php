<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['masv'])) {
	 header('Location: login.php');
}
?>
<html>
<head>
	<title>Trang chủ</title>
	<meta charset="utf-8">
</head>
<body>
	<div>
		Chào mừng mã sinh viên <?php echo $_SESSION['masv'];  ?> đã vào thành công !
	</div>
</body>
</html>