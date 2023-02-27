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
        if(mysqli_num_rows($sql)>0){    // oke
        $row = mysqli_fetch_array($sql);
        
        /// khai bao
        $ma_tloai  = "ma_tloai";
        $ten_tloai = "ten_tloai";
        /// Form submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["ten_tloai"])) { $ten_tloai = $_POST['ten_tloai']; }
            //// xu ly
            if (empty($ten_tloai)){
                echo 'Phải Nhập Tên Thể Loại';
            }else{
                $sql = "INSERT INTO theloai (ten_tloai) VALUES ('$ten_tloai')";
                if (mysqli_query($connect, $sql)){
                    echo 'Thể Loại: '; echo $ten_tloai; echo ' Thêm thành công';
                    header("Location: ./category.php");
                }else{
                    echo 'Lỗi';
                }
            }
        }
        ?>

<main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Thêm mới thể loại</h3>
                <form action="" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên thể loại</span>
                        <input type="text" class="form-control" name="ten_tloai" >
                    </div>

                    <div class="form-group  float-end ">
                        <input type="submit" value="Thêm" class="btn btn-success">
                        <a href="category.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
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