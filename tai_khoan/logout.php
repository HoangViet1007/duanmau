<?php
   require_once "../config.php";

    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
        header("location:".BASE_URL."tai_khoan/login.php?msg=Đăng xuất thành công !") ; 
    } elseif (isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
        header("location:".BASE_URL."tai_khoan/login.php?msg=Đăng xuất thành công !") ; 
    }


?>