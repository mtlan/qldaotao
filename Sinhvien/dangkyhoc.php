<!doctype html>
<html lang="en">
    <head>
    <title>Đăng ký học phần</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    </head>
    <style type="text/css">
        body {
            text-align: center;
            background: url('http://www.seekgif.com/download/simple-powerpoint-background-designs-images-pictures-becuo-7802');
            background-size: 100%;
        }
    </style>
    <body>
        <div class="container mt-1">
            <div style="text-align: center;"><h1>ĐĂNG KÝ HỌC PHẦN</h1></div>
            <form action="" method="POST">
                <input type="submit" name="dangxuat" class="btn btn-warning" value="Đăng xuất">
                <input type="submit" name="xemdiem" class="btn btn-info" value="Xem điểm">
                <a href="thongtindk.php" class="btn btn-primary">Thông tin</a>
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
                if (isset($_POST['xemdiem'])) {
                    session_start();
                    header('Location: bangdiem.php');
                }
            ?>
            <?php
                session_start();
                //tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
                //nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
                if (!isset($_SESSION['masv'])) {
                    header('Location: login.php');
                }
                echo 'Mã sinh viên đang giữ đăng nhập : ';
                echo $_SESSION['masv'];
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <form action="" method="POST">
                            <th scope="col">ID</th>
                            <th scope="col">Tên Lớp</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col"></th>
                        </form>
                    </tr>
                </thead>
            <?php
                $conn = new mysqli('localhost', 'root','','qldaotao');
                mysqli_set_charset($conn, 'UTF8');

                if ($conn->connect_error) {
                    die("Failed to connect: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM lophocphan";

                $result = $conn->query($sql);

                if ($result -> num_rows > 0) {
                    while($row = $result -> fetch_assoc()) {
                        $id = $row['id'];
                        $tenlop = $row['tenlop'];
                        $soluong = $row['soluong'];
                        echo 
                            '<tbody>
                                <tr>
                                    <td>'.$id.'</td>
                                    <td>'.$tenlop.'</td>
                                    <td>'.$soluong.'</td>
                                    <form action="" method="POST">
                                        <input class="d-none form-control" name="lophocphan_id" value="'.$row['id'].'">
                                        <input class="d-none form-control" name="hocky" value="'.$row['hocky'].'">
                                        <input class="d-none form-control" name="namhoc" value="'.$row['namhoc'].'">
                                        <td><input type="submit" name="dangkyhoc" class="btn btn-info" value="Đăng Ký"></td>
                                    </form>
                                </tr>
                            </tbody>';
                    }
                } 
                else {
                    echo "Null";
                }

                //đăng ký
                if(isset($_POST['dangkyhoc'])){

                    //khởi tạo biến
                    // $lophocphan_id = "";
                    // $hocky = "";
                    // $namhoc = "";
                    $lophocphan_id = $_POST['lophocphan_id'];
                    $hocky = $_POST['hocky'];
                    $namhoc = $_POST['namhoc'];
                    //get giá trị của value từ input vào biến
                    // if(isset($_POST)){
                    //     if(isset($_POST["lophocphan_id"])) { $lophocphan_id = $_POST['lophocphan_id']; }
                    //     if(isset($_POST["hocky"])) { $hocky = $_POST['hocky']; }
                    //     if(isset($_POST["namhoc"])) { $namhoc = $_POST['namhoc']; }
                    //     // $lophocphan_id = $_POST['lophocphan_id'];
                    //     // $hocky = $_POST['hocky'];
                    //     // $namhoc = $_POST['namhoc'];
                    // }

                    $datatime = date('Y-m-d H:i:s');
                    $masvv = $_SESSION['masv'];
                    $insert_to_dkh = "INSERT INTO dangkyhoc (lophocphan_id, hocky, namhoc, masv, thoigian)
                                    VALUES ('".$lophocphan_id."', '".$hocky."', '".$namhoc."', '".$masvv."', '".$datatime."')";
                    if ($conn->query($insert_to_dkh) === TRUE) {
                        // echo "";
                        header('Location: thongtindk.php');
                    } else {
                        echo "Lỗi: " . $insert_to_dkh . "<br>" . $conn->error;
                    }
                    // $conn->close();  
                }
                
            ?>
            </table>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
    </body>
</html>