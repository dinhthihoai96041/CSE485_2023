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

<?php

//// Edit The loai
if (isset($_GET['act'])){
    $act = $_GET['act'];
    if ($act=="edit"){
        $searchTG = $connect->query("SELECT * FROM tacgia WHERE ma_tgia='".$_GET['id']."'");
        $id = $_GET['id'];
        if (mysqli_num_rows($searchTG)>0){
            $TL = mysqli_fetch_array($searchTG);
            /// Lam
            /// Khai bao
            $idTL = $TL['ma_tgia'];
            $ten_tgia = "ten_tgia";
            /// post form submit
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST["ten_tgia"])) { $ten_tgia = $_POST['ten_tgia']; }
                /// xu ly
                if (empty($ten_tgia)){
                    echo 'Phai nhap ten the loai';
                }else{
                    $sql = "UPDATE tacgia SET ten_tgia='$ten_tgia' WHERE ma_tgia=$idTL";
                    if  (mysqli_query($connect, $sql)) {
                        echo 'Cap nhat thanh cong';
                        header("Location: ./author.php");
                    }else{
                        echo ' Loi';
                    }
                }
            }
            ?>

<main class="container mt-5 mb-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
        <div class="row">
            <div class="col-sm">
                <h3 class="text-center text-uppercase fw-bold">Sửa thông tin tác giả</h3>
                <form action="" method="post">
                <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">Mã tác giả</span>
                        <input type="text" class="form-control" name="idTL" readonly value="<?php echo $TL['ma_tgia'] ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên tác giả</span>
                        <input type="text" class="form-control" name="ten_tgia" value = "<?php echo $TL['ten_tgia'] ?>">
                    </div>

                    <div class="form-group  float-end ">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="author.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

            <?php

        }else{
            echo 'ID The loai khoong ton tai';
        }
    }

?>



<?php
if ($act=="del") {
    $deltacgia = $connect->query("SELECT * FROM tacgia WHERE ma_tgia='".$_GET['id']."'");
    $id = $_GET['id'];
    if(mysqli_num_rows($deltacgia)>0){
        $sql = "DELETE FROM `tacgia` WHERE `tacgia`.`ma_tgia` = $id";
        // Thực hiện câu truy vấn
        if (mysqli_query($connect, $sql)) {
            echo 'Xoa Thanh Cong';
            header("Location: ./author.php");
        } else {
            echo 'Xóa thất bại ';
        }

    }else{
        echo 'id khong ton tai';
    }
}

?>



<?php
};
?>
<?php
} else {  // ko
    echo 'Tài khoản này không phải admin, set trong sql level 2!';
};
};
?>


<?php

include("./foot.php");
?>