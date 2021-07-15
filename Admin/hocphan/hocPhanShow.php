<!doctype html>
<html lang="en">
  <head>
    <title>Danh sách học phần</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
            <div style="text-align: center;"><h1>DANH SÁCH CÁC HỌC PHẦN</h1></div>
            <form style="text-align: center;" action="" method="POST">
                <input type="submit" name="dangxuat" class="btn btn-warning" value="Đăng xuất">
                <input type="submit" name="lophocphan" class="btn btn-info" value="Lớp học phần">
            </form>
            <?php
              // đăng xuất
              if(isset($_POST['dangxuat'])) {
                session_unset();
                session_destroy();
                header('Location: ../login_admin.php');
              }
            ?>
            <?php
              if(isset($_POST['lophocphan'])) {
                session_start();
                header('Location: ../lophocphan/lhpInsert.php');
              }
            ?>
            <?php
              session_start();
              //tiến hành kiểm tra là người dùng đã đăng nhập hay chưa
              //nếu chưa, chuyển hướng người dùng ra lại trang đăng nhập
              if (!isset($_SESSION['ma_admin'])) {
                   header('Location: ../login_admin.php');
              }
              echo '<span style="text-align: center;">Tài khoản đang giữ đăng nhập : </span>';
              echo $_SESSION['ma_admin'];
            ?>
            <?php
                $i=0;
            ?>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên học phần</th>
                    <th scope="col">Số tín chỉ </th>
                    <th colspan="2">Hoạt động</th>
                    </tr>
                </thead>
                    <?php
                        $conn = new mysqli('localhost','root','','qldaotao');
                        mysqli_set_charset($conn, 'UTF8');

                        if($conn->connect_error) {
                            die("Failed to connect: ".$conn->connect_error);
                        }
                        $sql = "SELECT * FROM hocphan";
                        $result = $conn->query($sql);

                        // pre_r($result);
                        // pre_r($result->fetch_assoc());

                        function pre_r($array){
                            echo '<pre>';
                            print_r($array);
                            echo '</pre>';
                        }
                        if($result->num_rows>0) {
                            // echo '<div class="alert alert-success">thành công</div>';
                            while($row=$result->fetch_assoc()) {
                                $i++;
                                $tenhp = $row['tenhp'];
                                $sotc = $row['sotc'];
                                echo '
                                <tbody>
                                    <td>'.$i.'</td>
                                    <td>'.$tenhp.'</td>
                                    <td>'.$sotc.'</td>
                                    <td>
                                        <button class="btn btn-info"><a class="text-light" href="hocPhanUpdate.php?updateid='.$row['id'].'">Update</a></button>
                                        <button class="btn btn-danger"><a class="text-light" href="execute.php?delete='.$row['id'].'">Delete</a></button>
                                    </td>
                                </tbody>';
                            }
                        }
                    ?>
            </table>
            <button class="btn btn-primary"><a href="hocPhanInsert.php" class="text-light">Thêm học phần</a></button>  
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
  </body>
</html>