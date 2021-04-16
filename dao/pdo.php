<?php
    // thực chất file pdo.php này là định nghĩa ra các hàm để chạy các câu lệnh như : kết nối csdl , select , update , delete .
    // Chỉ cần nạp câu lệnh sql vào thôi 

    // require_once '../config.php';
    
    // viết hàm kết nối đến cssdl 
    function connect(){
        $host = "localhost" ; 
        $dbname = "dam" ; 
        $dbusername = "root" ; 
        $dbpass = "" ; 
        return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbusername,$dbpass) ; 
    }

    // hàm lấy tất cả accs dữ liệu 
    function select_all($sql){
        $connect = connect();
        $stml = $connect->prepare($sql);
        $stml->execute();
        return $select_all = $stml->fetchAll();
    }

    // hàm lấy 1 dữ liệu 
    function select_one($sql){
        $connect = connect() ; 
        $stmt = $connect->prepare($sql) ; 
        $stmt->execute() ; 
        return $select_one = $stmt->fetch() ; 
    }

    // hàm thêm sửa xóa dữ liệu 
    function insert_update_delete($sql){
        $connect = connect() ; 
        $stmt = $connect->prepare($sql) ; 
        $stmt->execute() ; 
    }

    // hàm format 
    function money($money){
        return number_format($money, 0, '.', ',');
    }

    // hàm formart thời gian

    function datetimeConvert($datetimedata,$formatString="d/m/yy"){
        $date = new DateTime($datetimedata) ; 
        return $date->format($formatString) ; 
    }


    function validateDate($date, $format = 'Y-m-d H:i:s'){
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
    }

?>