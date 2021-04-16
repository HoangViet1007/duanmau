<?php
   require_once "../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ; 
    
   // laays id 
   $id = isset($_GET['id']) ? $_GET['id'] : "" ;  
   
    // kiểm tra xem id này có trong database ko 

   $sql = "select * from khach_hang where id = '$id'" ; 
   $khach_hang = select_one($sql) ; 

   if(!$khach_hang){
       header("location:".BASE_URL."tai_khoan/update.php?msg=User này không tồn tại !") ; 
       die ; 
   }
   //    lấy dữ liệu từ from
   $ho_ten = $_POST['ho_ten'] ; 
   $ho_tenErr = ""; 

   $email = $_POST['email'] ;
   $emailErr = "" ; 

   $hinh = $_FILES['hinh'] ; 
   $hinhErr = "" ; 

 
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
  

    if($ho_tenErr.$emailErr.$hinhErr!= ""){
        header("location:".BASE_URL."tai_khoan/update.php?ho_tenerr=$ho_tenErr&emailerr=$emailErr&hinherr=$hinhErr") ;  
        die ; 
    }


    $sql = "UPDATE khach_hang set 
    ho_ten = '$ho_ten',
    hinh = '$path',
    email = '$email'
    where id = '$id'" ;      

    insert_update_delete($sql) ;   
    header("location:".BASE_URL."tai_khoan/update.php?msg=Cập nhật thông tin thành công !") ;

    


?>