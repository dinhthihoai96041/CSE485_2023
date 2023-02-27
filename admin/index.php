<?php
include("../trust/config.php");
include("./head.php");
?>
<?php
if(!isset($_SESSION["username"])){ 
    echo 'Thầy chưa đăng nhập mà mò vào đây làm gì? Đăng nhập trước rồi hãy rồi vào đây nha!';
    } else {  // kiểm tra level 2                        
        $username = $_SESSION['username'];
        $sql = $connect->query("SELECT * FROM users WHERE taikhoan='$username' AND level='2'");
        if(mysqli_num_rows($sql)>0){
?>
    <main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="" class="text-decoration-none">Người dùng</a>
                        </h5>

                        <h5 class="h1 text-center">
        <?php
        $result = mysqli_query($connect, "SELECT COUNT(*) AS `count` FROM `users`");
        $row = mysqli_fetch_array($result);
        $count = $row['count'];
        echo $count;
        ?>    
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="./category.php" class="text-decoration-none">Thể loại</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?php
        $result = mysqli_query($connect, "SELECT COUNT(*) AS `count` FROM `theloai`");
        $row = mysqli_fetch_array($result);
        $count = $row['count'];
        echo $count;
        ?>  
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="" class="text-decoration-none">Tác giả</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?php
        $result = mysqli_query($connect, "SELECT COUNT(*) AS `count` FROM `tacgia`");
        $row = mysqli_fetch_array($result);
        $count = $row['count'];
        echo $count;
        ?>  
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="" class="text-decoration-none">Bài viết</a>
                        </h5>

                        <h5 class="h1 text-center">
                        <?php
        $result = mysqli_query($connect, "SELECT COUNT(*) AS `count` FROM `baiviet`");
        $row = mysqli_fetch_array($result);
        $count = $row['count'];
        echo $count;
        ?>  
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php
} else {  // ko
    echo 'Tài khoản này không phải admin, set trong sql level 2!';
};
};
?>
<?php
include("./foot.php");
?>