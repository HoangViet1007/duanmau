<?php
   require_once "../config.php" ; 
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


    $hinh = $_FILES['hinh']; 
    $hinhErr = "" ;  

    $email = $_POST['email'];  
    $emailErr = "" ; 


    // validate from 
    // id
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
    if(strlen($cf_mat_khau) == 0){
        $cf_mat_khauErr = "Hãy nhập xác nhận mật khẩu" ; 
    }
    if($cf_mat_khau != $mat_khau){
        $cf_mat_khauErr = "Mật khẩu và xác nhận mật khẩu không khớp";
    }
    // ho và tên 

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

    // // updateload anh
    // if($_FILES['hinh']['size'] <= 0  ){
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
    //         elseif(!in_array($kieu, $typeanh)){
    //         $hinhErr = "Chỉ được upload các định dạng JPG, PNG, JPEG";
    //     } else{
    //         $hinhErr = "";  
    //     }
    // }

     // check ảnh 
    // updateload anh
    $dir = "../../public/image/khach_hang/";
    $target_file = $dir . basename($hinh['name']);
    $filename = "";
    $path = "";
    $sizeanh = 1500000;
    $check = getimagesize($_FILES['hinh']['tmp_name']);
    $typeanh =  array('jpg', 'png', 'jpeg','bmp');;
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

    if($idErr.$mat_khauErr.$cf_mat_khauErr.$ho_tenErr.$emailErr.$hinhErr){
        header("location:".BASE_URL."tai_khoan/new.php?iderr=$idErr&mat_khauerr=$mat_khauErr&cf_mat_khauerr=$cf_mat_khauErr&ho_tenerr=$ho_tenErr&emailerr=$emailErr&hinherr=$hinhErr") ;  
        die ; 
    }

    // // up anh leen dataabasse 
    // if($hinh['size'] > 0){
    //     // đặt tên cho ảnh khi up lên 
    //     $filename = uniqid() ."-".$hinh['name'] ; 
    //     move_uploaded_file($hinh['tmp_name'], APP_PATH.'/public/image/khach_hang/' . $filename) ; 
    //     $path = 'public/image/khach_hang/' . $filename ; 
    // } 

    // kiểm tra xem có trùng mã khách hàng ko ... nếu có zồi thì ko cho ínert  
    $check = "SELECT * FROM khach_hang WHERE id = '$id'";
    $cout = connect()->prepare($check);
    $cout->execute();
    if ($cout->rowCount() > 0) {
        header("location:".BASE_URL."tai_khoan/new.php?msg=Username này đã tồn tại !") ; 
        die;  
    } else {
        try {
            $sql = "INSERT INTO khach_hang(id,mat_khau,ho_ten,kich_hoat,hinh,email,vai_tro,birth_date)
            VALUES 
                  ('$id','$mat_khau','$ho_ten',0,'$path','$email',0,'2020-07-23')" ;       
        
            insert_update_delete($sql) ; 
            header("location:".BASE_URL."tai_khoan/login.php?msgs=Đăng kí thành công bạn có muốn đăng nhập không !") ; 
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



?>