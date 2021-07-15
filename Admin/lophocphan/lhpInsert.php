<!doctype html>
<html lang="en">
  <head>
    <title>Thêm lớp học phần</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">    
  </head>
  <body>   
      <div class="container">
          <div style="text-align: center;"><h1>THÊM LỚP HỌC PHẦN</h1></div><br>
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
            <form action="" method="POST">
                <div class="form-group">
                    <label>Tên lớp</label>
                    <input type="text" name="tenlop" class="form-control" placeholder="Nhập tên lớp" required>
                </div>
                <div class="form-group">
                    <label>Số lượng</label>
                    <input type="number" name="soluong" class="form-control" placeholder="Nhập số lượng sinh viên" required>
                </div>
                <div class="form-group">
                    <label>Năm học</label>
                    <select id="selectList" name="namhoc" style="width: 100%; height: 40px; border-radius: 4px">
                      <option value="2017-2018">2017-2018</option>
                      <option value="2018-2019">2018-2019</option>
                      <option value="2019-2020">2019-2020</option>
                      <option value="2020-2021">2020-2021</option>
                      <option value="2021-2022">2021-2022</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Học kỳ</label>
                    <select name="hocky" style="width: 100%; height: 40px; border-radius: 4px">
                      <option value="I">I</option>
                      <option value="II">II</option>
                    </select>
                </div>
                <div class="form-group">
                  <label>Tên học phần</label>
                  <select class="form-control" name="hocphan_id">
                  <?php 
                    $conn = new mysqli('localhost', 'root', '', 'qldaotao');
                    mysqli_set_charset($conn,"utf8");
                    // Kiểm tra kết nối
                    if ($conn->connect_error) {
                        die("Kết nối thất bại: " . $conn->connect_error);
                    }
                    $select = "SELECT * FROM hocphan";
                    //Khai báo giá trị ban đầu, nếu không có thì khi chưa submit câu lệnh insert sẽ báo lỗi
                    $result = $conn->query($select);
                    //form chọn tên lớp học
                    echo '';
                    while($row = $result->fetch_assoc()){
                      echo '<option value="'.$row['id'].'">'.$row['tenhp'].'</option>';}
                    ?>
                  </select>
                  </div>
                <input type="submit" name="insert" class="btn btn-outline-secondary" value="Thêm">
            </form>
            <?php
              echo '<br><form action="lhpShow.php" method="POST">
                      <input type="submit" name="hienthi" class="btn btn-outline-primary form-control" value="Hiển Thị Danh Sách">
                  </form>';
              //Lấy giá trị POST từ form vừa submit
              if(isset($_POST['insert'])) {
                $tenlop = $_POST['tenlop'];
                $soluong = $_POST['soluong'];
                $namhoc = $_POST['namhoc'];
                $hocky = $_POST['hocky'];
                $hocphan_id = $_POST['hocphan_id'];
              // if(isset($_POST["tenlop"])) { $tenlop = $_POST['tenlop']; }
              // if(isset($_POST["soluong"])) { $soluong = $_POST['soluong']; }
              // if(isset($_POST["namhoc"])) { $namhoc = $_POST['namhoc']; }
              // if(isset($_POST["hocky"])) { $hocky = $_POST['hocky']; }
              // if(isset($_POST["hocphan_id"])) { $hocphan_id = $_POST['hocphan_id']; }

              // Câu SQL Insert
                  $sql = "INSERT INTO lophocphan 
                      VALUES ('', '$tenlop', '$soluong', '$namhoc', '$hocky', '$hocphan_id')";
              //kiểm tra lỗi cú pháp rồi in  ra
              //var_dump($sql);
              // Thực hiện thêm record
                  if ($conn->query($sql) === TRUE) {
                      echo "Đã thêm thành công!";
                  } else {
                      echo "Lỗi: " . $sql . "<br>" . $conn->error;
                  }
               
                  // Ngắt kết nối
                  $conn->close();
                  echo 
                        '<table class="table">
                          <thead>
                              <tr>

                                <th scope="col">Tên lớp</th>
                                <th scope="col">Số lượng sinh viên</th>
                                <th scope="col">Năm học</th>
                                <th scope="col">Học kỳ</th>
                                <th scope="col"Lớp học ID</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                <td>'.$_POST['tenlop'].'</td>
                                <td>'.$_POST['soluong'].'</td>
                                <td>'.$_POST['namhoc'].'</td>
                                <td>'.$_POST['hocky'].'</td>
                                <td>'.$_POST['hocphan_id'].'</td>
                              </tr>
                          </tbody>
                        </table>';
              }
            ?>
      </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
  </body>
</html>