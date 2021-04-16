<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout.php</title>
    <?php include "../link/link.php" ?>
    <style>
        *{
            margin : 0;
            padding: 0;
        }
        .all{
            width: 100%;
            display: grid;
            grid-template-columns: 20% 80%;
        }
        .left{
            width: 100%;
            height: 600px;
            background-color: #f3f3f3;
        }
        .right{
            width: 100%;
        }
        .left-top{
            width: 100%;
            height: 50px;
            background-color: #6699ff;
        }
        .left-mid{
            width: 94%;
            height: 170px;
            padding: 15px;
            background-color: #f3f3f3;
            border-bottom: 1px solid #29558f ;
        }
        .right-top{
            height: 50px;
            background-color: #6699ff;
        }
        .image-ad{
            border-bottom: 1px solid #29558f ;
            display: grid;
            grid-template-columns: 25% 1fr;
        }
        .logo{
            margin-top: -50px;
            height: 150px;
            margin-left: 38px;
        }
        .image-me{
           
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        .icon-search{
            position: absolute;
            left: 210px;
            top: 167px;
            color: gray;
        }
        .dot{
            color: #29b869;
            margin-top: -10px;
        }
        .online{
            margin-top: -15px;
        }
        input{
            outline-color: #354650;
        }
     
        #menu ul {
            background-color: #f3f3f3;
            width: 250px;
            padding: 0;
            list-style-type: none;
            text-align: left;
        }
            #menu li {
            width: auto;
            height: 40px;
            line-height: 40px;
            border-bottom: 1px solid #e8e8e8;
            padding: 0 1em;
         }
            #menu li a {
            text-decoration: none;
            color: #333;
            display: block;
        }
            #menu li:hover {
            background: gray;
        }
        #menu li a:hover{
            /* font-weight: bold; */
            color: white;
        }

            /*==Dropdown Menu==*/
            #menu ul li {
            position: relative;
        }
            #menu .sub-menu {
            position: absolute;
            left: 220px;
            top: 0;
            display: none;
            width: 150px;
        }
            #menu li:hover .sub-menu {
            display: block;
         } 
         .menu2{
             float: right;
         } 
    </style>
</head>
<body>
      <div class="all">
            <div class="left">
                <div class="left-top">
                      <img src="../../public/image/logo1.png" alt="" class="logo">
                </div>

                <div class="left-mid">
                    <div class="image-ad mb-4">
                        <div>
                            <img src="../../public/image/image-me.jpg" alt="" class="image-me mb-3">
                        </div>
                        <div>
                            <p class="mt-1" style="font-weight: 600;">Hoàng Quốc Bảo Việt</p> 
                            <p class="online"><i class="fa fa-circle dot" aria-hidden="true"></i>&ensp;Online</p>
                        </div>
                    </div>
                    <form action="#">
                        <input type="text" name="search" id="search" placeholder="Tìm Kiếm ..." class="form-control">
                        <a href=""><i class="fa fa-search icon-search" aria-hidden="true"></i></a>
                        
                    </form>

                </div>

                <div id="menu">
                    <ul>
                        <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> &ensp;Trang chủ</a></li>
                        <li><a href="#"><i class="fa fa-gg" aria-hidden="true"></i>&ensp;Loại hàng</a>
                        <ul class="sub-menu">
                            <li><a href="#">Thêm loại hàng</a></li>
                            <li><a href="#">Sửa loại hàng</a></li>
                            <li><a href="#">Xóa loại hàng</a></li>
                        </ul>
                        </li>
                        <li><a href="#"><i class="fa fa-th-large" aria-hidden="true"></i>&ensp;Hàng hoá</a></li>
                        <li><a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i>&ensp;Khách hàng</a></li>
                        <li><a href="#"><i class="fa fa-comments" aria-hidden="true"></i>&ensp;Bình luận</a></li>
                        <li><a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>&ensp;Thống kê</a></li>

                    </ul>
                </div>
            </div>

            <div class="right">
                 <div class="row right-top">
                     <div class="col-md-2">
                        <a href=""> <i class="fa fa-bars" style="margin-left: 30px; color: white;margin-top: 15px;" aria-hidden="true"></i></a>
                     </div>
                     <div class="col-md-7"></div>
                     <div class="col-md-3">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#"><i class="fa fa-bell" aria-hidden="true"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#"><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                 </div>

                 <div class="row ml-4 mt-4">
                    
                      <div class="col" style="margin-right: 35px;">
                          <!--- thực hiện include các file vào băng switch case  -->
                          <?php include "../loai_hang/new.php" ; ?>
                      </div>
                 </div>
            </div>
      </div>
</body>
</html>