<html>
<head>
	<title>Đăng Nhập</title>
	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">

    <style type="text/css">
        body {
            background: url(http://thuthuatphanmem.vn/uploads/2018/04/24/hinh-nen-3d-dep_090319710.jpg);
            /*background-image: linear-gradient(#6A181D,#007bff70);*/
            }
             
            #box {  
            border: 1px solid rgb(200, 200, 200);   
            box-shadow: rgba(0, 0, 0, 0.1) 0px 5px 5px 2px; 
            background: rgba(200, 200, 200, 0.1);   
            border-radius: 4px; top:50px;
            }
             
            h2 {    
            text-align:center;  
            color:#fff;
            }
    </style>
</head>
<body>

    <div class="container-fluid"> 
        <div class="row-fluid"> 
            <div class="col-md-offset-4 col-md-4" id="box"> 
                <h2>ĐĂNG NHẬP</h2> 
                <hr> 
                <form class="form-horizontal" action="" method="POST"> 
                    <fieldset> 
                        <div class="form-group"> 
                            <div class="col-md-12"> 
                                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span> <input name="ma_admin" placeholder="Tài khoản" class="form-control" type="text"> 
                                </div> 
                            </div> 
                        </div> 
                        <div class="form-group"> 
                            <div class="col-md-12"> 
                                <div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> <input type="password" name="password_admin" placeholder="Mật khẩu" class="form-control" type="text"> 
                                </div> 
                            </div> 
                        </div> 
                        <div class="form-group" style="text-align: center;"> 
                            <div class="col-md-6"> 
                                <button type="submit" name="dangnhap" class="btn btn-md btn-warning">ĐĂNG NHẬP</button> 
                            </div>
                            <div class="col-md-6"> 
                                <button style="width: 95px;" type="submit" name="nhaplai" class="btn btn-md btn-warning">NHẬP LẠI</button>
                            </div>
                        </div> 
                    </fieldset>
                </form> 
            </div> 
        </div>
    </div>

    <?php
        //Gọi file connection.php
        //require_once("connection.php");
        $conn = new mysqli('localhost', 'root', '', 'qldaotao');

        // Kiểm tra kết nối
        if ($conn->connect_error) {
          die("Kết nối thất bại: " . $conn->connect_error);
        }
        // Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
        if (isset($_POST["dangnhap"])) {
            // lấy thông tin người dùng
            $ma_admin = $_POST["ma_admin"];
            $password_admin = $_POST["password_admin"];
            //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
            $ma_admin = strip_tags($ma_admin);
            $ma_admin = addslashes($ma_admin);
            $password_admin = strip_tags($password_admin);
            $password_admin = addslashes($password_admin);
            if ($ma_admin == "" || $password_admin == "") {
                //echo "Mã sinh viên hoặc password bạn không được để trống!";
                echo '<br><br><br>
                        <div class="container">
                            <div class="col-md-offset-4 col-md-4">
                                <h2>FBI WARNING : Tài khoản hoặc mật khẩu không được để trống!</h2>
                            </div>
                        </div>';
            }else{
                $sql = "SELECT ma_admin, password_admin FROM admin WHERE ma_admin = '$ma_admin' AND password_admin = '$password_admin'";
                //kiểm tra, in ra lỗi
                //var_dump($sql);
                $query = mysqli_query($conn,$sql);
                $num_rows = mysqli_num_rows($query);
                if ($num_rows == 0) {
                    echo '<br><br><br>
                        <div class="container">
                            <div class="col-md-offset-4 col-md-4">
                                <h2>FBI WARNING : Sai tài khoản hoặc mật khẩu!</h2>
                            </div>
                        </div>';
                    /*echo '<script language="javascript">';
                    echo 'alert("Sai thông tin rồi bạn nha :<")';
                    echo '</script>';*/
                }else{
                    //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
                    session_start();
                    $_SESSION['ma_admin'] = $ma_admin;
                    // Thực thi hành động sau khi lưu thông tin vào session
                    // tiến hành chuyển hướng trang web tới dangkyhoc.php
                    header('Location: hocphan/hocPhanInsert.php');
                }
            }
        }
    ?>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
</body>
</html>