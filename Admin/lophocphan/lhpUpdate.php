<!doctype html>
<html lang="en">
<head>
  <title>Cập nhật lớp học phần</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
  <div class="container mt-1">
    <div><h2 style="text-align:center;">CẬP NHẬT LỚP HỌC PHẦN</h2></div>
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
    $conn = new mysqli('localhost', 'root','','qldaotao');
    mysqli_set_charset($conn, 'UTF8');

    if ($conn->connect_error) {
        die("Failed to connect: " . $conn->connect_error);
    }
    $id = $_GET['updateid'];
    $sql = "SELECT * FROM lophocphan where id=$id";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($dl = $result->fetch_assoc()) {
        $tenlop = $dl['tenlop'];
        $soluong = $dl['soluong'];
        $namhoc = $dl['namhoc'];
        $hocky = $dl['hocky'];
      }
    }
    else {
        echo "Null";
    }
    if (isset($_POST['update'])){
        $tenlop = $_POST['tenlop'];
        $soluong = $_POST['soluong'];
        $namhoc = $_POST['namhoc'];
        $hocky = $_POST['hocky'];
        $update = 'update lophocphan set tenlop="'.$tenlop.'",soluong="'.$soluong.'",namhoc="'.$namhoc.'",hocky="'.$hocky.'" where id="'.$id.'"';
        $result = $conn->query($update);
        if($result){
          // echo 'thành công';
          header('location: lhpShow.php');
        }else{die(mysqli_error($conn));}
    }
    ?>
    <form action="" method="POST">
      <div class="form-group">
          <label>Tên lớp</label>
          <input type="text" name="tenlop" class="form-control" value="<?php echo $tenlop; ?>">
      </div>
      <div class="form-group">
          <label>Số lượng</label>
          <input type="number" name="soluong" class="form-control" value="<?php echo $soluong; ?>">
      </div>
      <div class="form-group">
          <label>Năm học</label>
          <select name="namhoc" style="width: 100%; height: 40px; border-radius: 4px">
            <option><?php echo $namhoc; ?></option>
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
            <option><?php echo $hocky; ?></option>
            <option value="I">I</option>
            <option value="II">II</option>
          </select>
      </div>
      <input type="submit" name="update" class="btn btn-outline-primary form-control" value="Cập nhật">
    </form>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
</body>
</html>