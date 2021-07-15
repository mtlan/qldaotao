<?php
session_start();
//tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
//nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
if (!isset($_SESSION['ma_admin'])) {
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
		<?php header('Location: ../login_admin.php');?>
	</div>
</body>
</html>