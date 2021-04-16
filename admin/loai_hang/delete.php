<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ;
   require_once APP_PATH."/dao/loai.php" ; 
  
 
    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    // kiểm tra id này có tồn tại trong dâtbase hay ko 
            
    $check = "SELECT * FROM loai_hang where id = '$id' " ;
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // naaus toonf taij thif cho xoas
        loai_delete($id) ; 
        header('location: ' . BASE_URL . "admin/loai_hang/list.php?msg=Xóa loại hàng thành công !");
    } else {
        try {
            header('location: ' . BASE_URL . "admin/loai_hang/list.php?msg=Loại hàng này không tồn tại !");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

?>