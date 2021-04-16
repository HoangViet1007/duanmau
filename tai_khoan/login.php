<?php  
    require_once "../config.php";
    require_once "../dao/pdo.php" ; 
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
         *{
             padding: 0;
             margin: 0;
             box-sizing: border-box;
         }
         body{
             font-family: Tahoma, Verdana, sans-serif;
         }
         .wave{
             position: fixed;
             height: 100%;
             left: 0;
             bottom: 0;
             z-index: -1;

         }
         .container{
             width: 100vw;
             height: 100vh;
             display: grid;
             grid-template-columns: repeat(2,1fr);
             grid-gap: 7rem;
             padding: 0 2rem;
         }
         .img{
             display: flex;
             justify-content: flex-end;
             align-items: center;
         }
         .img img{
             width: 400px;
         }
         .login-container{
             display: flex;
             align-items: center;
             text-align: center;
         }
         .avatar{
             width: 100px;
         }
         form{
             width: 360px;
         }
         form h2{
             font-size: 2.9rem;
             text-transform: uppercase;
             margin: 15px 0;
             color: #333;
         }
         .input-div{
             position: relative;
             display: grid;
             grid-template-columns: 7% 93%;
             margin: 25px 0 ;
             padding: 5px 0 ;
             border-bottom: 2px solid #d9d9d9;
         }
         .input-div .one{
             margin-top: 0;
         }
         .input-div .two{
             margin-bottom: 4px;
         }
         .i{
             display: flex;
             justify-content: center;
             align-items: center;
         }
         .i i{
             color: #d9d9d9;
         }
         .input-div div{
             position: relative;
             height: 45px;
         }
         .input-div div h5{
             color: #d9d9d9;
             position: absolute;
             left: 15px;
             top: 50%;
             transform: translateY(-50%);
             color: #999;
             font-size: 18px;
             transition: .3s;
         }
         .input{
             position: absolute;
             width: 100%;
             height: 100%;
             top: 0;
             left: 0;
             border: none;
             outline: none;
             background: none;
             padding: 0.5rem 0.7rem;
             font-size: 1.2rem;
             color: #555;
         }
         /* input::-webkit-input-placeholder {
            color: #6699ff;
            } */
         a{
             display: block;
             text-align: right;
             text-decoration: none;
             font-size: 0.9rem;
             color: #999;
             transition: .3s ;
         }
         a:hover{
             color: #6699ff;
             text-decoration: none;
         }
         .btn{
             display: block;
             width: 100%;
             height: 50px;
             border-radius: 25px;
             margin :1rem 0;
             font-size: 1.2rem;
             outline: none;
             border: none;
             cursor: pointer;
             color: #fff;
             background-size: 200%;
             transition : .5s;
             background-color:#6699ff ;

         }
          .btn:hover{
              background-color: #3366ff;
              color: #fff;
          }

    </style>
</head>
<body>
     <img src="../public/image/wave.png" alt="" class="wave">
     <div class="container">
         <div class="img">
              <img src="../public/image/undraw_personalization_triu.svg" alt="">
         </div>

         <div class="login-container">
              <form action="<?php echo BASE_URL ?>tai_khoan/post_login.php" method="POST">
                  <img src="../public/image/undraw_profile_pic_ic5t.svg" alt="" class="avatar">
                  <h2>WELCOME</h2>
                  <!--------- In za loi  ------------>
                  <?php if(isset($_GET['msgs'])) { ?>
                       <p style="color: #6699ff;">
                            <?php echo $_GET['msgs'] ?>
                       </p>
                  <?php } ?>

                  <div class="input-div one focus">
                       <div class="i">
                       <i class="fa fa-user" aria-hidden="true"></i>
                       </div>

                       <div>
                          <input type="text" class="input" placeholder="Username" name="id">
                       </div>
                  </div>

                  <div class="input-div two focus">
                       <div class="i">
                       <i class="fa fa-lock" aria-hidden="true"></i>
                       </div>

                       <div>
                          <input type="password" class="input" placeholder="Password" name="mat_khau">
                       </div>
                  </div>

                  <a href="<?php echo BASE_URL ?>tai_khoan/forgot_password.php">Forgot Password ?</a>
                  <input type="submit" value="Login" class="btn">

              </form>
         </div>
     </div>


</body>
</html>