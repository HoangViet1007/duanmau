<?php 
    require_once 'config.php';
    require_once APP_PATH."/dao/pdo.php" ;
    
    // lấy dữ liệu từ from 
    // laays id để truyền lại đường  dẫn 
    $id = $_POST['id'] ; 
    $sp = $_POST['sp'] ; 
    $g = $_POST['g'] ; 

    ///
    $ho_ten = $_POST['ho_ten'] ; 
    $ho_tenErr = "" ; 

    $sdt = $_POST['sdt'] ; 
    $sdtErr = "" ; 

    $email = $_POST['email'] ; 
    $emailErr = "" ; 

  

    $dc = $_POST['dc'] ; 
    $dcErr = "" ; 

    // validate
    if(strlen($ho_ten) == 0 ){
        $ho_tenErr = "Họ và tên không hợp lệ !" ;
    }
    if (!preg_match("/^[a-zA-Z-'(àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD) ]*$/", $ho_ten)) {
        $ho_tenErr = "Họ và tên không hợp lệ";
    }
    
    
    // sdt
    //  $sdt_hop_le = '/((09|03|07|08|05)+([0-9]{8}))$/' ; 
    $sdt_hop_le = '/((^0)(32|33|34|35|36|37|38|39|56|58|59|70|76|77|78|79|81|82|83|84|85|86|88|89|90|92|91|93|94|96|97|98|99)+([0-9]{7}))$/' ; 
    //  32,33,34,35,36,37,38,39,56,58,59,70,76,77,78,79,81,82,83,84,85,86,88,89,90,91,92,93,94,96,97,98,99   /^[a-zA-Z0-9_]{3,30}$/
    if (empty($_POST['sdt'])) {
        $sdtErr = "Vui lòng nhập số điện thoại !";

    }
    else if(!preg_match($sdt_hop_le , $sdt)){
        $sdtErr = "Số điện thoại không hợp lệ !";
    }
    else {
        $sdtErr = "";
    }
    
    // email
    $email_hop_le = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/" ; 
    if (empty($_POST['email'])) {
        $emailErr = "Vui lòng nhập email !";
    }
    elseif (!preg_match($email_hop_le , $email)) {
        $emailErr = "Định dạng email không hợp lệ !";
    }else{
        $emailErr = "";
    }

    if(empty($tinh_tp)){
        $tinh_tpErr = "Hãy nhập tên tỉnh / thành phố ! " ; 
    }
    if(empty($dc)){
        $dcErr = "Hãy nhập địa chỉ !" ; 
    }

    if($ho_tenErr.$sdtErr.$emailErr.$dcErr){
        header("location:".BASE_URL."tt-sp.php?id=$id&ho_tenerr=$ho_tenErr&sdterr=$sdtErr&emailerr=$emailErr&tinh_tperr=$tinh_tpErr&dcerr=$dcErr") ; 
        die() ; 
    }else{

            // nếu tồn tại bắt đầu gửi mk mới về email của  người dùng 
        // 1. Key dưới đây chỉ dùng tạm, khi chạy dịch vụ chính thức bạn cần đăng ký tài khoản của sendgrid.com
        // website nhỏ thì dùng tài khoản miễn phí ok
        // tham khảo cách đăng ký để lấy key https://saophaixoan.net/search-tut?q=sendgrid
        // trong code này chỉ cần lấy key là ok, sau khi gửi thử xong thì verify là ok.
        // $SENDGRID_API_KEY = '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'; 
        $SENDGRID_API_KEY = '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';                   

        require '././lien_he/vendor/autoload.php';
        $obj_email = new \SendGrid\Mail\Mail();
        ///------- bạn chỉnh sửa các thông tin dưới đây cho phù hợp với mục đích cá nhân
        // Thông tin người gửi
        $obj_email->setFrom("viettuyet10072001@gmail.com", "X-SHOP");
        // Tiêu đề thư
        $obj_email->setSubject("THÔNG TIN ĐƠN HÀNG");
        // Thông tin người nhận
        $obj_email->addTo($email, "$ho_ten");
        // Soạn nội dung cho thư
        // $email->addContent("text/plain", "Nội dung text thuần không có thẻ html");
        $obj_email->addContent(
            "text/html",
            "
            <h2 style='color: teal;'>ĐƠN HÀNG CỦA BẠN</h2>
            <table class='table' border='1' style='coloer: teal ; '>
                <thead>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                </thead>
                <tbody>
                    <tr>
                        <td> $sp </td>
                        <td> $g đ</td>
                    </tr>
                </tbody>
            </table>
            <p style='color: teal;''>Chúng quý khách có một ngày mới vui vẻ !</p>
            "
        );

        // tiến hành gửi thư
        $sendgrid = new \SendGrid($SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($obj_email);
            // print $response->statusCode() . "\n";
            // print_r($response->headers());
            // print $response->body() . "\n";
            // header("location:".BASE_URL."thank.php") ; 

        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }



    }



?>