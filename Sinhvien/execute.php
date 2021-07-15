<?php
    $conn = new mysqli('localhost','root','','qldaotao');
    if (isset($_GET['delete'])){
        $id = $_GET['delete'];
        $result = $conn->query("DELETE FROM dangkyhoc WHERE id=$id") or die($result->error());
        header('location: thongtindk.php');
    }
?>