<?php
	session_start();
	$conn = new mysqli('localhost', 'root','','qldaotao');
	if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $_SESSION['message'] = "xóa thành công!";
    $_SESSION['msg_type'] = "danger";
    $result=$conn->query("DELETE FROM hocphan WHERE id=$id") or die($result->error());
    header('Location: hocPhanShow.php');
    }
?>