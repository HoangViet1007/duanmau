<?php 
    require_once "../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 

    // lấy id cần đổi mật khẩu 
    $id = isset($_GET['id']) ? $_GET['id'] : "" ; 

    $sql = "SELECT * FROM khach_hang where id = '$id'" ; 
    $mk = select_one($sql) ; 
    if(!$mk){
        header("location:".BASE_URL."?msg=User không tồn tại !") ; 
        die ; 
    }
    $mkc = $mk['mat_khau'] ; 
     


    // lấ dữ liệu tư from 
    $old_password = $_POST['old_password'] ; 
    $old_passwordErr = "" ; 

    $password = $_POST['password'] ; 
    $passwordErr = "" ; 

    $cf_password = $_POST['cf_password'] ; 
    $cf_passwordErr = "" ; 

    // validate 
    
    // ít nhất 6 ký tự
    // không chứa dấu cách
    if(strlen($old_password) == 0){
        $old_passwordErr = "Hãy nhập mật khẩu mới !";
    }

    if(strlen($password) == 0){
      $passwordErr = "Hãy nhập mật khẩu mới !";
    }
  
    $removeWhiteSpacePassword = str_replace(" ", "", $password);
    if(strlen($password < 6) || (strlen($removeWhiteSpacePassword) != strlen($password))){
        $passwordErr = "Mật khẩu mới không thỏa mãn đk (ít nhất 6 ký tự và không chứa khoảng trắng)";
    }
  
    if(strlen($cf_password) ==0){
      $cf_passwordErr = "Hãy nhập xác nhận mật khẩu !"; 
    }
 
 
  
    $hash_new_pass = password_hash($password, PASSWORD_DEFAULT);

   if(!password_verify($cf_password,  $hash_new_pass)){
      $cf_passwordErr = "Xác nhận mật khẩu mới không hợp lệ !" ; 
    }


   if($old_passwordErr.$passwordErr.$cf_passwordErr != ""){
      header('location:'.BASE_URL."tai_khoan/edit_password.php?old_passworderr=$old_passwordErr&passworderr=$passwordErr&cf_passworderr=$cf_passwordErr");
      die ;
    }
    



  // echo '<hr>'. password_hash(  $password, PASSWORD_DEFAULT) . '<hr>';
  //   var_dump(password_verify(  password_hash(  $password, PASSWORD_DEFAULT), $cf_password));
  //   if(!password_verify(  password_hash(  $password, PASSWORD_DEFAULT), $cf_password)){
  //     $cf_passwordErr = "Xác nhận mật khẩu mới không hợp lệ !" ; 
  //   }
  //   // kiểm tra xem nhập mk cũ đúng ko 
   
  //   if(!password_verify($old_password, $mkc)){
  //      $old_passwordErr = "Mật khẩu cũ không đúng !" ; 
  //   }
  

// die("$old_passwordErr.$passwordErr.$cf_passwordErr");


    // if($old_passwordErr.$passwordErr.$cf_passwordErr != ""){
    //   header('location:'.BASE_URL."tai_khoan/edit_password.php?old_passworderr=$old_passwordErr&passworderr=$passwordErr&cf_passworderr=$cf_passwordErr&msg=Mật khẩu cũ không đúng !");
    //   die ;
    // }



    $sql = "UPDATE khach_hang set
                                    mat_khau = '$password'
                                    where id = '$id' " ; 
    insert_update_delete($sql) ; 
    header("location:".BASE_URL."tai_khoan/edit_password.php?msg=Đổi mật khẩu thành công !") ; 

?>