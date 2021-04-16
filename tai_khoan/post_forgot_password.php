<?php
    require_once "../config.php" ; 
    require_once "../dao/pdo.php" ; 

        // laays is 
        $id = $_POST['id'] ; 

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
        // ho va ten
        // $ho_ten = $_POST['ho_ten'] ; 
        // $ho_tenErr = "" ; 

        // if(empty($ho_ten)){
        //     $ho_tenErr = "Hãy nhập họ và tên !" ; 
        // }

        // kiểm tra email
        $email_hop_le = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/" ; 
        $email = $_POST['email'] ; 
        $emailErr = "" ; 

        if(empty($email)){
            $emailErr = "Hãy nhập email !" ;  
        }
        elseif(!preg_match($email_hop_le , $email)){
            $emailErr = "Email không hợp lệ !" ;  
        }else{
            $emailErr = "" ; 
        }

        // kiểm tra mật khẩu cũ có giống trog database ko 
     

        if($idErr.$emailErr != ""){
            header("location:".BASE_URL."tai_khoan/forgot_password.php?iderr=$idErr&emailerr=$emailErr") ; 
            die() ; 
        }

        // kiểm tra xem thông tin người dùng nhập có giống trong datadase ko 
        $sql = "SELECT * FROM khach_hang where id = '$id'" ; 
        $kh = select_one($sql) ; 
        // xem có tồn tại ko 
        if(!$kh){
            header("location:".BASE_URL."tai_khoan/forgot_password.php?msg=User này không tồn tại !") ; 
            die() ;
        }else{
            // nếu tồn tại bắt đầu gửi mk mới về email của  người dùng 
            // 1. Key dưới đây chỉ dùng tạm, khi chạy dịch vụ chính thức bạn cần đăng ký tài khoản của sendgrid.com
            // website nhỏ thì dùng tài khoản miễn phí ok
            // tham khảo cách đăng ký để lấy key https://saophaixoan.net/search-tut?q=sendgrid
            // trong code này chỉ cần lấy key là ok, sau khi gửi thử xong thì verify là ok.
            // $SENDGRID_API_KEY = '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'; 
            $SENDGRID_API_KEY = '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';                   
           
            require '../lien_he/vendor/autoload.php';
            $mkm = rand() ; 
            $obj_email = new \SendGrid\Mail\Mail();
            ///------- bạn chỉnh sửa các thông tin dưới đây cho phù hợp với mục đích cá nhân
            // Thông tin người gửi
            $obj_email->setFrom("viettuyet10072001@gmail.com", "X-SHOP");
            // Tiêu đề thư
            $obj_email->setSubject("MẬT KHẨU MỚI");
            // Thông tin người nhận
            $obj_email->addTo($email,"");
            // Soạn nội dung cho thư
            // $email->addContent("text/plain", "Nội dung text thuần không có thẻ html");
            $obj_email->addContent(
                "text/html",
                "Mật khẩu mới của bạn là : <p style='color: teal;'> $mkm </p>"
            );

            // tiến hành gửi thư
            $sendgrid = new \SendGrid($SENDGRID_API_KEY);
            try {
                $response = $sendgrid->send($obj_email);
                print $response->statusCode() . "\n";
                print_r($response->headers());
                print $response->body() . "\n";
                // gửi xong bắt đầu update mk mới vào database 
                $sql = "UPDATE khach_hang set mat_khau = '$mkm' where id = '$id'" ; 
                insert_update_delete($sql) ;
                
                header("location:".BASE_URL."tai_khoan/forgot_password.php");
        
            } catch (Exception $e) {
                echo 'Caught exception: ' . $e->getMessage() . "\n";
            }

     
        }




   
?>
