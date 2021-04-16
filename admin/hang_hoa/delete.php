<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ;

    $id = isset($_GET['id']) ? $_GET['id'] : "" ; 

    // kiểm tra id này có tồn tại trong dâtbase hay ko 
            
    $check = "SELECT * FROM hang_hoa where id = '$id' " ;
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        // naaus toonf taij thif cho xoas
        insert_update_delete("DELETE FROM hang_hoa WHERE id = '$id'");
        header("Location:" . BASE_URL . "admin/hang_hoa/list.php?msg=Xóa sản phẩm thành công !");
    } else {
        try {
        header("Location:" . BASE_URL . "admin/hang_hoa/list.php?msg=Sản phẩm này không tồn tại !");
    } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>