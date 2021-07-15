<!DOCTYPE html>
<html>
<head>
    <?php 
    error_reporting(1);
     ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bảng điểm</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/ext-core/3.1.0/ext-core.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <style type="text/css">
        body {
            background: url('http://i.imgur.com/1mkFvRl.jpg');
            background-size: 100%;
        }
    </style>
</head>
<body style="text-align: center;">
    <h1>BẢNG ĐIỂM</h1>
    <form action="" method="POST">
        <input type="submit" name="dangxuat" class="btn btn-warning" value="Đăng xuất">
        <input type="submit" name="dangkyhoc" class="btn btn-info" value="Đăng ký">
        <a href="thongtindk.php" class="btn btn-primary">Quay lại</a>
    </form>
    <?php
        //đăng xuất
        if(isset($_POST['dangxuat'])) {
            session_unset();
            session_destroy();
            header('Location: login.php');
        }
    ?>
    <?php 
        if (isset($_POST['dangkyhoc'])) {
            session_start();
            header('Location: dangkyhoc.php');
        }
     ?>
     <?php $i=0 ?>
    <?php 
        $conn = new mysqli('localhost', 'root','','qldaotao');
        mysqli_set_charset($conn, 'UTF8');
        
        if ($conn->connect_error) {
            die("Failed to connect: " . $conn->connect_error);
        }
        
        session_start();
        $masvv = $_SESSION['masv'];
        $sql = "SELECT dangkyhoc.id, lophocphan.tenlop, dangkyhoc.masv, dangkyhoc.namhoc, dangkyhoc.hocky, dangkyhoc.diem FROM dangkyhoc JOIN lophocphan ON dangkyhoc.lophocphan_id = lophocphan.id WHERE dangkyhoc.masv = '".$masvv."'";

        $result = $conn->query($sql);
        echo 'Điểm của sinh viên : ';
        echo $_SESSION['masv'];
        echo '<br>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Tên Lớp</th>
                    <th>Mã sinh viên</th>
                    <th>Năm học</th>
                    <th>Học kỳ</th>
                    <th>Chuyên cần</th>
                    <th>Giữa kỳ</th>
                    <th>Cuối kỳ</th>
                    <th>Điểm TB thang 10</th>
                    <th>Điểm TB thang 4</th>
                    <th>Điểm chữ</th>    
                </tr>';
        if ($result->num_rows > 0){
            while ($dl = $result->fetch_assoc()){
                $i++;
                $diem = $dl['diem'];
                $explode = explode(' ', $diem);
                //print_r(explode(' ', $diem , 3));
                $diemcc = $explode[0];
                $diemgk = $explode[1];
                $diemck = $explode[2];
                $diemtb = $diemcc*0.2 + $diemgk*0.3 + $diemck*0.5;
                $diemtb_thang4 = $diemtb * 0.4;
                
                if ($diem == "") {
                    $diemcc = "";
                    $diemgk = "";
                    $diemck = "";
                    $diemtb = "";
                    $diemtb_thang4 = "";
                    $diemchu = "";
                }
                else if ($diemtb<=10 && $diemtb >=8.0) {
                        $diemchu = "A";
                    }
                else if ($diemtb <= 7.9 && $diemtb >= 6.5) {
                    $diemchu = "B";
                }
                else if ($diemtb <= 6.4 && $diemtb >= 5.0) {
                    $diemchu = "C";
                }
                else if ($diemtb <= 4.9 && $diemtb >= 3.5) {
                    $diemchu = "D";
                }
                else if ($diemtb <= 3.4) {  
                    $diemchu = "F";
                }
                
                echo '
                    <tr>
                        <th>'.$i.'</th>
                        <th>'.$dl['tenlop'].'</th>
                        <th>'.$dl['masv'].'</th>
                        <th>'.$dl['namhoc'].'</th>
                        <th>'.$dl['hocky'].'</th>
                        <th>'.$diemcc.'</th>
                        <th>'.$diemgk.'</th>
                        <th>'.$diemck.'</th>
                        <th>'.$diemtb.'</th>
                        <th>'.$diemtb_thang4.'</th>
                        <th>'.$diemchu.'</th>
                    </tr>';    
                }
                echo '</table>';

        }
    ?>
</body>
</html>