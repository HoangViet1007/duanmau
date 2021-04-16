<?php
    /*
    thực chất file loai.php này dùng để định nghĩa các thao tác cho bảng loại hàng và sau khi sang 
    file admin /loai_hang/ thì chúng ta gọi ra dùng 
    đầu tiên chúng ta phải nhung file pdo.php vào đã
    */ 

    require_once "pdo.php" ; 

    // hàm thêm , sủa  , xóa loại hàng 

    function loai_insert($ten_loai){
        $sql = "INSERT INTO loai_hang(ten_loai) VALUES('$ten_loai')" ; 
        return  insert_update_delete($sql); 
    }

    function loai_update($id, $ten_loai){
        $sql = "UPDATE loai_hang SET ten_loai='$ten_loai' WHERE id='$id'" ; 
        return  insert_update_delete($sql); 
    }

    function loai_delete($id){
        $sql = "DELETE from loai_hang WHERE id='$id'" ; 
        return  insert_update_delete($sql); 
    }

    // xem tất cả loại hàng 
    function loai_select_all(){
        $sql = "SELECT * from loai_hang" ; 
        return select_all($sql) ;
    }
    

    // xem 1 loại hàng
    function loai_select_one($id){
        $sql = "SELECT * from loai_hang WHERE id='$id'" ; 
         select_one($sql) ; 
   }

//    function loai_select_name_and_id($name,$id){
//     $sql = "SELECT * from loai_hang WHERE ten_loai_hang LIKE'$$name' or id LIKE $id" ; 
//     return select_all($sql) ; 
// }



?>