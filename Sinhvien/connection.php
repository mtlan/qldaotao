<?php
	$conn = new mysqli('localhost', 'root', '', 'qldaotao');

	// Kiểm tra kết nối
	if ($conn->connect_error) {
	  die("Kết nối thất bại: " . $conn->connect_error);
	}
?>