<?php
    require_once "../../config.php" ; 
    require_once APP_PATH."/dao/pdo.php" ;

    // lấy id 
    $id = isset($_POST['id']) ? $_POST['id'] : "" ; 

    // kiểm tra xem id này có trong database ko 
    $sql = "select * from hang_hoa where id = '$id'" ; 
    $hang_hoa = select_one($sql) ; 

    if(!$hang_hoa){
        header("location:".BASE_URL."admin/hang_hoa/list.php?msg=Hàng hóa không tồn tại !") ; 
        die ; 
    }

     // nhận dữ liệu tù from
     $ten_hh = trim($_POST['ten_hh']) ; 
     $ten_hhErr = "" ; 
 
     $don_gia = $_POST['don_gia'] ; 
     $don_giaErr = "" ; 
 
     $giam_gia = $_POST['giam_gia'] ; 
     $giam_giaErr = "" ; 
 
     $hinh = $_FILES['hinh'] ; 
     $hinhErr = "" ; 
 
     $ngay_nhap = $_POST['ngay_nhap'] ; 
     $ngay_nhapErr = "" ; 
 
     $mo_ta = $_POST['mo_ta'] ; 
     $mo_taErr = "" ; 
 
     $dac_biet = $_POST['dac_biet'];
     $dac_bietErr = "" ; 
 
     $so_luot_xem = $view = 1 ; 
 
     $ma_loai = $_POST['ma_loai'] ; 
     $ma_loaiErr = "" ; 
 
     // validate
     // tên
     if(strlen($ten_hh) == 0){
         $ten_hhErr = "Hãy nhập tên hàng hóa" ; 
     }
     if(strlen($ten_hh) < 3){
        $ten_hhErr = "Tên hàng hóa không hợp lệ !" ; 
    }
    // đơn giá
    if( strlen($don_gia) == 0 || $don_gia <= 0 ){
        $don_giaErr = "Gía không hợp lệ !" ; 
    }
 
     // giảm giá
    if( strlen($giam_gia) == 0 || $giam_gia <= 0 || strlen($giam_gia) > 3){
        $giam_giaErr = "Giảm giá không hợp lệ !" ; 
    }

    // ngày nhập
    if(strlen($ngay_nhap) == 0 ){
        $ngay_nhapErr = "Hãy nhập ngày nhập hàng hóa " ; 
    }
    if(strtotime("now")-strtotime($ngay_nhap) < 0 ){
        $ngay_nhapErr = "Ngày nhập không hợp lệ !" ; 
    }

    if (!validateDate($ngay_nhap, 'd/m/Y')) {
        $ngay_nhapErr = "Vui lòng nhập ngày tháng năm đúng định dạng dd/mm/YYYY (VD : 08/09/2001)";
    }else{
        $arr=explode("/",$ngay_nhap); // cái này đang là mảng 
        $mm=$arr[0]; // first element of the array is month
        $dd=$arr[1]; // second element is date
        $yy=$arr[2]; // third element is year
        if(!checkdate($mm,$dd,$yy)){
            $ngay_nhapErr = "Vui lòng nhập ngày tháng năm chính xác !";
        }else {
           $tmp = array_reverse($arr) ; 
           $ngay_nhap_save = implode("-",$tmp) ; 
        }
    }
    

    // mô tả 
     if(empty($_POST['mo_ta'])){
         $mo_taErr = "Hãy nhập mô tả sản phẩm" ; 
     }
    //  // check ảnh 
    // // updateload anh

    $path = $hang_hoa['hinh'] ;
    $check = getimagesize($_FILES['hinh']['tmp_name']); 
    $sizeanh = 1500000;
    if($_FILES['hinh']['size'] <= 0  ){
        $path = $hang_hoa['hinh']; 
    }    
    elseif ($_FILES['hinh']['size'] > $sizeanh) {
        $hinhErr = "File ảnh quá lớn. Vui lòng chọn ảnh khác !";
    }
    elseif(!($check !== false)) {
        $hinhErr = "Hãy nhập ảnh hợp lệ !";
    } 
    else{
        $dir = "../../public/image/product/";
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
            move_uploaded_file($hinh['tmp_name'], "../../public/image/product/" . $filename);
            $path = "public/image/product/" . $filename;
        } 
        else {
            $hinhErr = "";
        }
    } 
  
 
    
 
     // hiển thị lỗi
     if($ten_hhErr.$don_giaErr.$giam_giaErr.$ngay_nhapErr.$hinhErr != ""){
         header('location:'.BASE_URL."admin/hang_hoa/edit.php?id=$id&ten_hherr=$ten_hhErr&don_giaerr=$don_giaErr&giam_giaerr=$giam_giaErr&hinherr=$hinhErr&ngay_nhaperr=$ngay_nhapErr&mo_taerr=$mo_taErr&hinherr=$hinhErr") ; 
         die ; 
     }
 

      // bắt đầu update ten_hh,don_gia,giam_gia,hinh,ngay_nhap,mo_ta,dac_biet,so_luot_xem,ma_loai
      $sql = "update hang_hoa set
                              ten_hh = '$ten_hh',
                              don_gia = '$don_gia',
                              giam_gia = '$giam_gia',
                              hinh = '$path',
                              ngay_nhap = '$ngay_nhap_save',
                              mo_ta = '$mo_ta',
                              dac_biet = $dac_biet,
                              so_luot_xem = '$so_luot_xem',
                              ma_loai = '$ma_loai'
                              where id = '$id'
                              " ; 
        insert_update_delete($sql) ; 
        header("location:".BASE_URL."admin/hang_hoa/list.php?msg=Sửa hàng hóa thành công !");                       


?>