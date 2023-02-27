<?php
include("trust/config.php");
include("trust/head.php");
?>


<?php

if (isset($_POST['username'])){
    $username = stripslashes($_REQUEST['username']);
$username = mysqli_real_escape_string($connect,$username);
$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($connect,$password);
    $query = "SELECT * FROM `users` WHERE taikhoan='$username' and matkhau='".md5($password)."'";
$result = mysqli_query($connect,$query) or die(mysql_error());
$rows = mysqli_num_rows($result);
    if($rows==1){
  $_SESSION['username'] = $username;
  header("Location: ./index.php");
        }else { 
            // login fail
            echo 'Tên Tài Khoản Hoặc Mật Khẩu không đúng!';
        }
    }else{

        ?>
        <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="d-flex justify-content-center h-100">
                <div class="card" style="background-color: rgba(0,0,0,0.5) !important;">
                    <div class="card-header">
                        <h3>Sign In</h3>
                        <div class="d-flex justify-content-end social_icon">
                            <span><i class="fab fa-facebook-square"></i></span>
                            <span><i class="fab fa-google-plus-square"></i></span>
                            <span><i class="fab fa-twitter-square"></i></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" name="login">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="txtUser"><i class="fas fa-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="username" >
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="txtPass"><i class="fas fa-key"></i></span>
                                <input type="text" name="password" class="form-control" placeholder="password" >
                            </div>
                            
                            <div class="row align-items-center remember">
                                <input type="checkbox">Remember Me
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" value="Login" class="btn float-end login_btn">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center ">
                            Dont have an account?<a href="./reg.php" class="text-warning text-decoration-none">Sign Up</a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="#" class="text-warning text-decoration-none">Forgot your password?</a>
                        </div>
                    </div>
                </div>

        </div>
    </main>
   
        <?php
        // bang login
    }
        ?>

<?php
include("trust/foot.php");
?>