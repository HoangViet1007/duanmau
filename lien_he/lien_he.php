<?php
   require_once "../config.php" ; 
   require_once APP_PATH."/dao/pdo.php" ; 
   require_once APP_PATH."/header_small.php"; 

   // lấy dữ liệu từ form 
   if(isset($_POST['gui'])){
        $errName = $errEmail = $errTitle = $errNoi_dung = $errSDT =  "";
        // name 
        if (empty($_POST['name'])) {
            $errName = "Vui lòng nhập tên !";
        } 
         else if (!preg_match("/^[a-zA-Z-'(àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẰẮẶẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỜỚỢỞỠÙÚỤỦŨƯỪỨỰỬỮỲÝỴỶỸĐD) ]*$/", $_POST['name'])) {
            $errName = "Họ và tên không hợp lệ";
        }
        
        else {
            $name = $_POST['name'];
        }

        // sdt
        //  $sdt_hop_le = '/((09|03|07|08|05)+([0-9]{8}))$/' ; 
         $sdt_hop_le = '/((^0)(32|33|34|35|36|37|38|39|56|58|59|70|76|77|78|79|81|82|83|84|85|86|88|89|90|92|91|93|94|96|97|98|99)+([0-9]{7}))$/' ; 
         $sdt = $_POST['sdt'];
        //  32,33,34,35,36,37,38,39,56,58,59,70,76,77,78,79,81,82,83,84,85,86,88,89,90,91,92,93,94,96,97,98,99   /^[a-zA-Z0-9_]{3,30}$/
        if (empty($_POST['sdt'])) {
            $errSDT = "Vui lòng nhập số điện thoại !";

        }
        else if(!preg_match($sdt_hop_le , $sdt)){
            $errSDT = "Số điện thoại không hợp lệ !";
        }
        else {
            $errSDT = "";
        }
        
        // email
        $email_hop_le = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/" ; 
        $email = $_POST['email'];
        if (empty($_POST['email'])) {
            $errEmail = "Vui lòng nhập email !";
        }
        elseif (!preg_match($email_hop_le , $email)) {
            $errEmail = "Định dạng email không hợp lệ !";
        }else{
            $errEmail = "";
        }
       
        // title
        if (empty($_POST['title'])) {
            $errTitle = "Vui lòng nhập tiêu đề !";
        } 
        else {
            $title = $_POST['title'];
        }

        // nội dung
        if (empty($_POST['noi_dung'])) {
            $errNoi_dung = "Vui lòng nhập nội dung !";
        }
        else {
            $noi_dung = $_POST['noi_dung'];
        }


        if ($errName . $errSDT . $errEmail . $errTitle . $errNoi_dung == "") {
            // 1. Key dưới đây chỉ dùng tạm, khi chạy dịch vụ chính thức bạn cần đăng ký tài khoản của sendgrid.com
            // website nhỏ thì dùng tài khoản miễn phí ok
            // tham khảo cách đăng ký để lấy key https://saophaixoan.net/search-tut?q=sendgrid
            // trong code này chỉ cần lấy key là ok, sau khi gửi thử xong thì verify là ok.

            // $SENDGRID_API_KEY = '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'; 
            $SENDGRID_API_KEY = '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';                
               
            require './vendor/autoload.php';

            $obj_email = new \SendGrid\Mail\Mail();
            ///------- bạn chỉnh sửa các thông tin dưới đây cho phù hợp với mục đích cá nhân
            // Thông tin người gửi
            $obj_email->setFrom("viettuyet10072001@gmail.com", "$name");
            // Tiêu đề thư
            $obj_email->setSubject("$title");
            // Thông tin người nhận
            $obj_email->addTo("viethqbph10539@fpt.edu.vn", "Hoàng Quốc Bảo Việt");
            // Soạn nội dung cho thư
            // $email->addContent("text/plain", "Nội dung text thuần không có thẻ html");
            $obj_email->addContent(
                "text/html",
                " Người gửi : {$email} <br> 
                  Nội dung thư : <p style='color: teal;'> $noi_dung </p>"
            );
    
            // tiến hành gửi thư
            $sendgrid = new \SendGrid($SENDGRID_API_KEY);
            try {
                $response = $sendgrid->send($obj_email);

                print $response->statusCode() . "\n";
                print_r($response->headers());
                print $response->body() . "\n";
                die() ; 
                $msg = "Gửi mail thành công !" ; 

        
            } catch (Exception $e) {
                echo 'Caught exception: ' . $e->getMessage() . "\n";
            }
        }
   }

   
   


?>
    <div class="container">
        <div style=" width: 100%; background-color: #cc0000; height: 45px; color: white; margin-right: 40px; padding-top: 5px;" class="text-center mb-5 mt-4">
                <span><h2 style="text-transform: uppercase;">LIÊN HỆ</h2></span>
        </div>

        <?php if(isset($msg)) { ?>
            <span class="text-danger mt-3 mb-2" style="margin-left: 460px;"> <?= $msg ?> </span>
        <?php } ?>


        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="" method="POST">
                   <div class="row">
                       <div class="col-md-12">
                            <div class="form-group">
                                <label for="">HỌ VÀ TÊN</label>
                                <input type="text" placeholder="Họ và tên" name="name" class="form-control">
                                <?php if (isset($errName)) {
                                    echo "<p style='color: red;'>" . $errName . "</p>";
                                } ?>
                            </div>

                            <div class="form-group">
                                <label for="">SỐ ĐIỆN THOẠI</label>
                                <input type="text" placeholder="Số điện thoại" name="sdt" class="form-control">
                                <?php if (isset($errSDT)) {
                                    echo "<p style='color: red;'>" . $errSDT . "</p>";
                                } ?>
                            </div>

                            <div class="form-group">
                                <label for="">MAIL CỦA BẠN</label>
                                <input type="text" placeholder="Mail của bạn" name="email" class="form-control">
                                <?php if (isset($errEmail)) {
                                    echo "<p style='color: red;'>" . $errEmail . "</p>";
                                } ?>
                            </div>

                            <div class="form-group">
                                <label for="">TIÊU ĐỀ </label>
                                <input type="text" placeholder="Tiêu đề" class="form-control" name="title">
                                <?php if (isset($errTitle)) {
                                    echo "<p style='color: red;'>" . $errTitle . "</p>";
                                } ?>
                            </div>

                            <div class="form-group">
                                <label for="">NỘI DUNG CẦN GỬI</label>
                                <textarea name="noi_dung" id="" cols="30" rows="6" class="form-control"></textarea>
                                <?php if (isset($errNoi_dung)) {
                                    echo "<p style='color: red;'>" . $errNoi_dung . "</p>";
                                } ?>
                            </div>
                       </div>
                       
                   </div>
                   <div class="row d-flex justify-content-center align-items-center">
                        <button type="submit" class="btn btn-info mr-3 ml-5" name="gui">Gửi</button>
                        <a href="<?php echo BASE_URL ?>" class="btn btn-danger">Hủy</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
<?php include "../footer.php" ?>