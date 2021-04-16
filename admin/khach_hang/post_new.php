<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ;

    // lấy dữu liệu tù from 
    $id = $_POST['id'] ; 
    $idErr = "" ; 

    $mat_khau = $_POST['mat_khau'] ; 
    $mat_khauErr = "" ; 

    $cf_mat_khau = $_POST['cf_mat_khau'] ; 
    $cf_mat_khauErr = "" ; 

    $ho_ten = $_POST['ho_ten'] ; 
    $ho_tenErr = "" ; 

    $kich_hoat = $_POST['kich_hoat'] ; 
    $kich_hoatErr = "";  

    $hinh = $_FILES['hinh']; 
    $hinhErr =  "" ;  

    $email = $_POST['email'];  
    $emailErr = "" ; 

    $vai_tro = $_POST['vai_tro'] ; 
    $vai_troErr = "" ; 

    // $nguoi_gioi_thieu = $_POST['nguoi_gioi_thieu'] ; 
    // $nguoi_gioi_thieuErr = "" ; 
    
    // echo $kich_hoat ; 
    // echo $vai_tro  ;

    // validate from 
    // kiem tra ho ten
    $id_hop_le = '/^[a-zA-Z0-9_]{3,30}$/' ;
    if(strlen($id) == 0){
        $idErr = "Hãy nhập mã khách hàng " ; 
    }
    else if(strlen($id) < 3 || strlen($id) > 30){
        $idErr = "Mã khách hàng không hợp lệ !" ; 
    }
    else if(!preg_match($id_hop_le , $id)){
        $idErr = "Mã khách hàng không hợp lệ !" ; 

    }else{
        $idErr = "" ; 
    }

    // mat khau 
    
    $removeWhiteSpacePassword = str_replace(" ", "", $mat_khau);
   
    if(strlen($mat_khau) < 6 || (strlen($removeWhiteSpacePassword) != strlen($mat_khau))){
        $mat_khauErr = "Mật khẩu không thỏa mãn đk (ít nhất 6 ký tự và không chứa khoảng trắng)";
    }
  
    // giống với xác nhận mk
        // giống với xác nhận mk
    if(strlen($cf_mat_khau) == 0){
        $cf_mat_khauErr = "Hãy nhập xác nhận mật khẩu" ; 
    }
    if($cf_mat_khau != $mat_khau){
        $cf_mat_khauErr = "Mật khẩu và xác nhận mật khẩu không khớp";
    }

    if(strlen($ho_ten) == 0 ){
        $ho_tenErr = "Hãy nhập họ và tên !" ; 
    }
    if (!preg_match("/^[a-zA-Z-'(àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD) ]*$/", $ho_ten)) {
        $ho_tenErr = "Họ và tên không hợp lệ";
    }

   // kiểm tra email
   $email_hop_le = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/" ; 
   if(empty($email)){
    $emailErr = "Hãy nhập email !" ;  
    }
    elseif(!preg_match($email_hop_le , $email)){
        $emailErr = "Email không hợp lệ !" ;  
    }else{
        $emailErr = "" ; 
    }
    
    // check ảnh 
    // updateload anh
    $dir = "../../public/image/khach_hang/";
    $target_file = $dir . basename($hinh['name']);
    $filename = "";
    $path = "";
    $sizeanh = 1500000;
    $check = getimagesize($_FILES['hinh']['tmp_name']);
    $typeanh =  array('jpg', 'png', 'jpeg','bmp');
    $kieu = pathinfo($target_file, PATHINFO_EXTENSION);
    if($_FILES['hinh']['size'] <= 0  ){
        $hinhErr = "Hãy nhập hình ảnh !";
    }  
    elseif(!($check !== false)) {
        $hinhErr = "Hãy nhập ảnh hợp lệ !";
    } 
    elseif ($hinh['size'] > $sizeanh) {
        $hinhErr = "File ảnh quá lớn. Vui lòng chọn ảnh khác !";
    }
    elseif(!in_array($kieu, $typeanh)){
        $hinhErr = "Chỉ được upload các định dạng JPG, PNG, JPEG , BMP!";
    } 
    elseif ($hinh['size'] > 0 && $hinh['size'] < $sizeanh) {
        $filename = uniqid() . "_" . $hinh['name'];
        move_uploaded_file($hinh['tmp_name'], "../../public/image/khach_hang/" . $filename);
        $path = "public/image/khach_hang/" . $filename;
    }
    else{
        $hinhErr = "";  
    }

    //  // updateload anh
    //  if($_FILES['hinh']['size'] <= 0  ){
    //     $hinhErr = "Xin mời bạn nhập ảnh";

    // }else{
    //     $dir = "../public/image/khach_hang/";
    //     $target_file = $dir . basename($hinh['name']);
    //     $filename = "";
    //     $path = "";
    //     $sizeanh = 1500000;
    //     $typeanh = ['jpg, png, bmp'];
    //     $kieu = pathinfo($target_file, PATHINFO_EXTENSION);

    //     if ($hinh['size'] > 0 && $hinh['size'] < $sizeanh) {
    //         $filename = uniqid() . "_" . $hinh['name'];
    //         move_uploaded_file($hinh['tmp_name'], "../public/image/khach_hang/" . $filename);
    //         $path = "public/image/khach_hang/" . $filename;
    //     } 
    //     elseif(!in_array($kieu, $typeanh)){
    //         $hinhErr = "Chỉ được upload các định dạng JPG, PNG, JPEG";
    //     } else{
    //         $hinhErr = "";  
    //     }
    // }
    

    if($idErr.$mat_khauErr.$cf_mat_khauErr.$ho_tenErr.$hinhErr.$emailErr){
        header("location:".BASE_URL."admin/khach_hang/new.php?iderr=$idErr&mat_khauerr=$mat_khauErr&cf_mat_khauerr=$cf_mat_khauErr&ho_tenerr=$ho_tenErr&hinherr=$hinhErr&emailerr=$emailErr") ;  
        die ; 
    }


    // kiểm tra xem có trùng mã khách hàng ko ... nếu có thì ko cho insert và nếu ko thì cho insêrt 
    $check = "SELECT * FROM khach_hang WHERE id = '$id'";
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        header("location:".BASE_URL."admin/khach_hang/list.php?msg=Khách hàng này đã tồn tại !") ; 
        die;  
    } else {
        try {
            $sql = "INSERT INTO khach_hang(id,mat_khau,ho_ten,kich_hoat,hinh,email,vai_tro)
            VALUES 
                  ('$id','$mat_khau','$ho_ten',$kich_hoat,'$path','$email',$vai_tro)" ;       
        
            insert_update_delete($sql) ; 
            header("location:".BASE_URL."admin/khach_hang/list.php?msg=Thêm khách hàng thành công !") ; 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // $check = "SELECT * FROM khach_hang WHERE id = '$id'";
    // $cout = connect()->prepare($check);
    // $cout->execute();
    // if ($cout->rowCount() > 0) {
    //     header("location:".BASE_URL."admin/khach_hang/list.php?msg=Khách hàng này đã tồn tại !") ; 
    //     die;  
    // } else {
    //     try {
    //         $check = "SELECT * FROM khach_hang WHERE id = '$nguoi_gioi_thieu'";
    //         $cout = connect()->prepare($check);
    //         $cout->execute();
    //         if ($cout->rowCount() > 0) {
    //             $sql = "INSERT INTO khach_hang(id,mat_khau,ho_ten,kich_hoat,hinh,email,vai_tro,nguoi_gioi_thieu)
    //             VALUES 
    //                   ('$id','$mat_khau','$ho_ten',$kich_hoat,'$path','$email',$vai_tro,'$nguoi_gioi_thieu')" ;       
    //          insert_update_delete($sql) ; 
    //          header("location:".BASE_URL."admin/khach_hang/list.php?msg=Thêm khách hàng thành công !") ; 
    //         }else{
    //             header("location:".BASE_URL."admin/khach_hang/list.php?msg=Người giới thiệu này không tồn tại !") ; 
    //         }    
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }


?>