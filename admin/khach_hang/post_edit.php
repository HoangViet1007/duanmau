<?php
   require_once "../../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ;

    $ids = $_POST['ids'] ; 
    // kiểm tra xem id này có trong database ko 
    $sql = "select * from khach_hang where id = '$ids'" ; 
    $khach_hang = select_one($sql) ; 

    if(!$khach_hang){
        header("location:".BASE_URL."admin/khach_hang/list.php?msg=Khách hàng không tồn tại !") ; 
        die ; 
    }
    
  
    $mat_khau = $_POST['mat_khau'] ; 
    $mat_khauErr = "" ; 

    $cf_mat_khau = $_POST['cf_mat_khau'] ; 
    $cf_mat_khauErr = "" ; 

    $ho_ten = $_POST['ho_ten'] ; 
    $ho_tenErr = "" ; 

    $kich_hoat = $_POST['kich_hoat'] ; 
    $kich_hoatErr = "";  

    $hinh = $_FILES['hinh'] ; 
    $hinhErr = "" ;  

    $email = $_POST['email'];  
    $emailErr = "" ; 

    $vai_tro = $_POST['vai_tro'] ; 
    $vai_troErr = "" ; 

    $dai_ly = $_POST['dai_ly'] ; 
    $dai_lyErr = "" ; 
    
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

    $removeWhiteSpacePassword = str_replace(" ", "", $mat_khau);
    if(strlen($mat_khau) < 6 || (strlen($removeWhiteSpacePassword) != strlen($mat_khau))){
        $mat_khauErr = "Mật khẩu không thỏa mãn đk (ít nhất 6 ký tự và không chứa khoảng trắng)";
    }
  
    // giống với xác nhận mk
    if($cf_mat_khau != $mat_khau){
        $cf_mat_khauErr = "Mật khẩu và xác nhận mật khẩu không khớp";
    }

    // ho va ten
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

    
     // update hinh
    //  check ảnh 
    // Nếu ko nhập ảnh hoặc ảnh = 0 thì cho ảnh bằng ảnh cũ 
    $check = getimagesize($_FILES['hinh']['tmp_name']);
    $path = $khach_hang['hinh'] ; 
    $sizeanh = 1500000;
    if($_FILES['hinh']['size'] <= 0  ){
        $path = $khach_hang['hinh']; 
    }    
    elseif ($_FILES['hinh']['size'] > $sizeanh) {
        $hinhErr = "File ảnh quá lớn. Vui lòng chọn ảnh khác !";
    }
    elseif(!($check !== false)) {
        $hinhErr = "Hãy nhập ảnh hợp lệ !";
    } 
    else{
        $dir = "../../public/image/khach_hang/";
        $target_file = $dir . basename($hinh['name']);
        $filename = "";
        $path = "";
        $typeanh =  array('jpg', 'png', 'jpeg','bmp');;
        $kieu = pathinfo($target_file, PATHINFO_EXTENSION);

        if (!in_array($kieu, $typeanh)) {
            $hinhErr = "Chỉ được upload các định dạng JPG, PNG, JPEG";
        }
        elseif ($hinh['size'] > 0 && $hinh['size'] < $sizeanh) {
            $filename = uniqid() . "_" . $hinh['name'];
            move_uploaded_file($hinh['tmp_name'], "../../public/image/khach_hang/" . $filename);
            $path = "public/image/khach_hang/" . $filename;
        } 
        else {
            $hinhErr = "";
        }
    }
    if(empty($dai_ly)){
        $dai_lyErr = "Hãy chọn đại lí / cá nhân !" ; 
    } 
  
    // in za các lỗi


    if($mat_khauErr.$cf_mat_khauErr.$ho_tenErr.$emailErr.$hinhErr.$dai_lyErr){
        header("location:".BASE_URL."admin/khach_hang/edit.php?id=$ids&mat_khauerr=$mat_khauErr&cf_mat_khauerr=$cf_mat_khauErr&ho_tenerr=$ho_tenErr&emailerr=$emailErr&hinherr=$hinhErr&dai_lyerr=$dai_lyErr") ;  
        die ; 
    }

    // up anh leen dataabasse 
    // $path = $khach_hang['hinh'] ; 
    // if($hinh['size'] > 0){
    //     // đặt tên cho ảnh khi up lên 
    //     $filename = uniqid() ."-".$hinh['name'] ; 
    //     move_uploaded_file($hinh['tmp_name'],'../../public/image/khach_hang/' . $filename) ; 
    //     $path = 'public/image/khach_hang/' . $filename ; 
    // } 

    // kiểm tra xem khi sửa nhập mã mới có trùng vs mã cũ ko 

    $sql = "UPDATE khach_hang set 
    mat_khau = '$mat_khau',
    ho_ten = '$ho_ten',
    kich_hoat = $kich_hoat,
    hinh = '$path',
    email = '$email',
    vai_tro = $vai_tro,
    dai_ly = '$dai_ly'
    where id = '$ids' ";      
    insert_update_delete($sql) ; 
    header("location:".BASE_URL."admin/khach_hang/list.php?msg=Sửa khách hàng thành công !") ; 


    
?>