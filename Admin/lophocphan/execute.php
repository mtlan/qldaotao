<?php
    $conn = new mysqli('localhost','root','','qldaotao');
    if (isset($_GET['delete'])){
        $id = $_GET['delete'];
        $result = $conn->query("DELETE FROM lophocphan WHERE id=$id") or die($result->error());
        header('location: lhpShow.php');
    }
?>