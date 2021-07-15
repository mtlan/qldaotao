<!doctype html>
<html lang="en">
  <head>
    <title>Thêm học phần</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
  </head>
  <style type="text/css">
      .form1 {
        text-align: center;
      }
  </style>
  <body>  
      <div class="container">
            <div style="text-align: center;"><h1>THÊM HỌC PHẦN</h1></div>
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
            <form action="" method="POST">
              <div class="form-group">
                  <label>Tên học phần</label>
                  <input type="text" name="tenhp" class="form-control" placeholder="Nhập tên học phần" required>
              </div>
              <div class="form-group">
                  <label>Số tín chỉ</label>
                  <input type="number" name="sotc" class="form-control" placeholder="Nhập số tín chỉ" required>
              </div>
              
              <div style="text-align: center;"><input type="submit" name="add" class="btn btn-primary" value="Thêm học phần"></div>
            </form><br>
             <?php
              if(isset($_POST['add'])){
                // Tạo kết nối
              $conn = new mysqli('localhost', 'root', '', 'qldaotao');
               
              // Kiểm tra kết nối
              if ($conn->connect_error) {
                  die("Kết nối thất bại: " . $conn->connect_error);
              }

              //Khai báo giá trị ban đầu, nếu không có thì khi chưa submit câu lệnh insert sẽ báo lỗi
              //$id = "";
              // $tenhp = "";
              // $sotc = "";
              
              //Lấy giá trị POST từ form vừa submit
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
              //if(isset($_POST["id"])) { $id = $_POST['id']; }
              if(isset($_POST["tenhp"])) { $tenhp = $_POST['tenhp']; }
              if(isset($_POST["sotc"])) { $sotc = $_POST['sotc']; }


              // Câu SQL Insert
              $sql = "INSERT INTO hocphan
                      VALUES ('', '$tenhp', '$sotc')";
               
              // Thực hiện thêm record
              if ($conn->query($sql) === TRUE) {
                  echo "";
              } else {
                  echo "Lỗi: " . $sql . "<br>" . $conn->error;
              }
               
              // Ngắt kết nối
              $conn->close();

              echo 
                  '<table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Tên học phần</th>
                          <th scope="col">Số tín chỉ </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>'.$_POST['tenhp'].'</td>
                          <td>'.$_POST['sotc'].'</td>
                        </tr>
                      </tbody>
                  </table>';
              }
            }
            echo '<form action="hocPhanShow.php" method="POST">
                      <input type="submit" name="submit" class="btn btn-outline-success form-control" value="Hiển Thị Danh Sách">
                  </form>';
            ?>
            <!--?php include 'SQL_list.php';?-->
            
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
  </body>
</html>