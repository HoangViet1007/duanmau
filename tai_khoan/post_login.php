<?php
     require_once "../config.php";
     require_once "../dao/pdo.php" ; 

     // lấy dữ liệu tù from 
     $id = $_POST['id'] ; 

     $mat_khau = $_POST['mat_khau'] ; 

     // login khách hàng
     $check_khach_hang = "SELECT * FROM khach_hang WHERE id = '$id' AND mat_khau = '$mat_khau' AND vai_tro='0'";
     $conn = connect();
     $stmt = $conn->prepare($check_khach_hang);
     $stmt->execute();
     $count_khach_hang =$stmt->fetch() ; 

    //  login admin
    $check_admin = "SELECT * FROM khach_hang WHERE id = '$id' AND mat_khau = '$mat_khau' AND vai_tro='1'";
    $conn = connect();
    $stmt = $conn->prepare($check_admin);
    $stmt->execute();
    $count_admin=$stmt->fetch() ; 
    
    // kiểm tra 
    if ($count_admin) {
        $_SESSION['admin'] = [
            'id' => $count_admin['id'],
            'mat_khau' => $count_admin['mat_khau'],
            'ho_ten' => $count_admin['ho_ten'],
            'hinh' => $count_admin['hinh']
        ];

        header("location:".BASE_URL."admin/trang_chinh/index.php?msgs=Đăng nhập thành công !") ; 

    } elseif ($count_khach_hang) {
        $_SESSION['user'] = [
            'id' => $count_khach_hang['id'],
            'mat_khau' => $count_khach_hang['mat_khau'],
            'ho_ten' => $count_khach_hang['ho_ten'],
            'hinh' => $count_khach_hang['hinh']
        ];
        header("location:".BASE_URL."index.php?msgs=Đăng nhập thành công !") ; 
    } else {
        header("location:".BASE_URL."tai_khoan/login.php?msgs=Tài khoản hoặc mật khẩu không chính xác !") ; 
    }


?>