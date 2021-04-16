<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ;
   require_once APP_PATH."/dao/loai.php" ; 
  
   // nhận dữ liệu từ form
      
   $ten_loai_hang = trim($_POST['ten_loai_hang']) ; 
   $ten_loai_hangErr = "" ; 
 
   // validate
   if(strlen($ten_loai_hang) == 0){
    $ten_loai_hangErr = "Hãy nhập tên loại hàng !" ; 
  }
  if(strlen($ten_loai_hang) < 3 ){
    $ten_loai_hangErr = "Tên loại hàng không hợp lệ !" ; 
  }

  if($ten_loai_hangErr != ""){
    header('location: ' . BASE_URL . "admin/loai_hang/new.php?ten_loai_hangerr=$ten_loai_hangErr");
    die ; 
  }

  $check = "SELECT * FROM loai_hang WHERE ten_loai = '$ten_loai_hang'";
  $cout = connect()->prepare($check);
  $cout->execute();
  if ($cout->rowCount() > 0) {
      header("location:".BASE_URL."admin/loai_hang/list.php?msg=Loại hàng này đã tồn tại !") ; 
      die;  
  } else {
      try {
            loai_insert($ten_loai_hang) ; 
            header('location: ' . BASE_URL . "admin/loai_hang/list.php?msg=Thêm loại hàng thành công !");
      } catch (PDOException $e) {
          echo $e->getMessage();
      }
  }

?>