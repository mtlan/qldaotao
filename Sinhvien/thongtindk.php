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
        <h1 style="text-align: center;">DANH SÁCH ĐĂNG KÝ HỌC PHẦN</h1>
            <form action="" method="POST">
                <input type="submit" name="dangxuat" class="btn btn-warning" value="Đăng xuất">
                <input type="submit" name="xemdiem" class="btn btn-info" value="Xem điểm">
                <a href="dangkyhoc.php" class="btn btn-primary">Quay lại</a>
            </form>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên lớp</th>
                        <th scope="col">Mã sinh viên</th>
                        <th scope="col">Học kỳ</th>
                        <th scope="col">Năm học</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Hoạt động</th>
                    </tr>
                </thead>
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
            <?php $i=0 ?>
            <?php

                session_start();
                //tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
                //nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
                if (!isset($_SESSION['masv'])) {
                     header('Location: login.php');
                }
                echo 'Mã sinh viên đang giữ đăng nhập : ';
                echo $_SESSION['masv'];

                $conn = new mysqli('localhost', 'root','','qldaotao');
                mysqli_set_charset($conn, 'UTF8');

                if ($conn->connect_error) {
                    die("Failed to connect: " . $conn->connect_error);
                }

                // $show = 'SELECT * FROM dangkyhoc INNER JOIN lophocphan ON dangkyhoc.lophocphan_id = lophocphan.id WHERE masv = "'.$_SESSION['masv'].'"';
                $show = 'SELECT * FROM lophocphan INNER JOIN dangkyhoc ON lophocphan.id = dangkyhoc.lophocphan_id WHERE masv = "'.$_SESSION['masv'].'"';

                $result = $conn->query($show);

                if ($result -> num_rows > 0) {
                    while($row = $result -> fetch_assoc()) {
                        $i++;
                        echo 
                            '<tbody>
                                <tr>
                                    <form action="" method="POST">
                                        <td>'.$i.'</td>
                                        <td>'.$row['tenlop'].'</td>
                                        <td>'.$row['masv'].'</td>
                                        <td>'.$row['hocky'].'</td>
                                        <td>'.$row['namhoc'].'</td>
                                        <td>'.$row['thoigian'].'</td>
                                    </form>
                                    <td><button class="btn btn-danger"><a class="text-light" href="execute.php?delete='.$row['id'].'">Delete</a></button></td>
                                </tr>
                            </tbody>';
                    }

                    }
                    else {
                        echo "";
                    }

                //Thực thi xóa
                // if(isset($_POST["xoa"]))
                // {
                //     $lh_id = "";
                //     if(isset($_POST["lh_id"])) { $lh_id = $_POST['lh_id']; }

                //     $query ="DELETE FROM dangkyhoc WHERE lophocphan_id = '".$lh_id."'";
                //     if ($conn->query($query) === TRUE) {
                //         echo "Xóa thành công !";
                //     } else {
                //         echo "Lỗi: " . $query . "<br>" . $conn->error;
                //     }
                // }
                
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