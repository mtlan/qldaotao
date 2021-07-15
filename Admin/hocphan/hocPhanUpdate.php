<!doctype html>
<html lang="en">
  <head>
    <title>Cập nhật học phần</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
        <?php 
            $conn = new mysqli('localhost', 'root','','qldaotao');
            mysqli_set_charset($conn, 'UTF8');

            if ($conn->connect_error) {
                die("Failed to connect: " . $conn->connect_error);
            }
            $id = $_GET['updateid'];
            $sql = "SELECT * FROM hocphan WHERE id=$id";

            $result = $conn->query($sql);
            // $row = mysqli_fetch_assoc($result);
            if ($result->num_rows > 0) {
                while ($dl = $result->fetch_assoc()) {
                    $tenhp=$dl['tenhp'];
                    $sotc=$dl['sotc'];
                }
            }
            else {
                echo "Null";
            }
        
            if (isset($_POST['submit'])){
                //$id = $_POST['id'];
                $tenhp = $_POST['tenhp'];
                $sotc = $_POST['sotc'];
                
                //câu lệnh update
                $update = "update hocphan set tenhp='$tenhp',sotc='$sotc' where id='$id'";
                $result = $conn->query($update);
                if($result){
                    // echo "Cập nhật thành công";
                    header('Location: hocPhanShow.php');
                }
                else{die(mysqli_error($conn));}
            }
        ?>
        <div><h1 style="text-align: center;">Cập nhật học phần</h1></div>
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
                <input type="text" name="tenhp" class="form-control" value="<?php echo $tenhp;?>">
            </div>
            
            <div class="form-group">
                <label>Số tín chỉ</label>
                <input type="number" name="sotc" class="form-control" value="<?php echo $sotc;?>">
            </div>
            <input type="submit" name="submit" class="btn btn-outline-primary form-control" value="Update">
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"></script>
  </body>
</html>