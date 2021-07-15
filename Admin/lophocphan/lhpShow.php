<!doctype html>
<html lang="en">
  <head>
    <title>Danh sách lớp học phần</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
  </head>
  <body>
      <div class="container mt-1">
            <div style="text-align: center;"><h1>DANH SÁCH LỚP HỌC PHẦN</h1></div>
            <form style="text-align: center;" action="" method="POST">
                <input type="submit" name="dangxuat" class="btn btn-warning" value="Đăng xuất">
                <input type="submit" name="lophocphan" class="btn btn-info" value="Học phần">
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
                header('Location: ../hocphan/hocPhanInsert.php');
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
                        <th scope="col">Tên Lớp</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Năm học</th>
                        <th scope="col">Học kỳ</th>
                        <th scope="col">Học phần ID</th>
                        <th scope="col">Hoạt động</th>
                    </tr>
                </thead>
            <?php
                $conn = new mysqli('localhost', 'root','','qldaotao');
                mysqli_set_charset($conn, 'UTF8');

                if ($conn->connect_error) {
                    die("Failed to connect: " . $conn->connect_error);
                }

                $sql = "SELECT *, tenhp FROM hocphan INNER JOIN lophocphan ON hocphan.id = lophocphan.hocphan_id";

                $result = $conn->query($sql);

                if ($result -> num_rows > 0) {
                    while($row = $result -> fetch_assoc()) {
                        $i++;
                        echo 
                            '<tbody>  
                                <td>'.$i.'</td>
                                <td>'.$row['tenlop'].'</td>
                                <td>'.$row['soluong'].'</td>
                                <td>'.$row['namhoc'].'</td>
                                <td>'.$row['hocky'].'</td>
                                <td>'.$row['tenhp'].'</td>
                                <td>
                                    <button class="btn btn-info"><a class="text-light" href="lhpUpdate.php?updateid='.$row['id'].'">Update</a></button>
                                    <button class="btn btn-danger"><a class="text-light" href="execute.php?delete='.$row['id'].'">Delete</a></button>
                                </td>
                            </tbody>';
                    }
                } 
                else {
                    echo "Null";
                }
            ?>
            </table>
            <button class="btn btn-primary mb-5"><a class="text-light" href="lhpInsert.php">Thêm lớp</a></button>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
  </body>
</html>