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
        $searchBV = $connect->query("SELECT * FROM baiviet WHERE ma_bviet='".$_GET['id']."'");
        $id = $_GET['id'];
        if (mysqli_num_rows($searchBV)>0){
            $BV = mysqli_fetch_array($searchBV);
            /// Khai bao
            $ma_bviet = $BV['ma_bviet'];
        $tieude  = "tieude";
        $ten_bhat = "ten_bhat";
        $ma_tloai = "ma_tloai";
        $tomtat = "tomtat";
        $noidung = "noidung";
        $ma_tgia = "ma_tgia";
        $ngayviet = $BV['ngayviet'];
        $hinhanh = "hinhanh";
            /// post form submit
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST["tieude"])) { $tieude = $_POST['tieude']; }
                if(isset($_POST["ten_bhat"])) { $ten_bhat = $_POST['ten_bhat']; }
                if(isset($_POST["ma_tloai"])) { $ma_tloai = $_POST['ma_tloai']; }
                if(isset($_POST["tomtat"])) { $tomtat = $_POST['tomtat']; }
                if(isset($_POST["noidung"])) { $noidung = $_POST['noidung']; }
                if(isset($_POST["ma_tgia"])) { $ten_tgia = $_POST['ma_tgia']; }
                if(isset($_POST["hinhanh"])) { $ten_tgia = $_POST['hinhanh']; }

                /// xu ly
                if (empty($tieude)){
                    echo 'Phải nhập tiêu đề';
                }else{
                    $sql = "UPDATE baiviet SET tieude='$tieude', ten_bhat='$ten_bhat', ma_tloai='$ma_tloai', tomtat='$tomtat', noidung='$noidung', ma_tgia='$ma_tgia', hinhanh='$hinhanh', ngayviet='$ngayviet' WHERE ma_bviet=$ma_bviet";
                    if  (mysqli_query($connect, $sql)) {
                        echo 'Cap nhat thanh cong';
                        header("Location: ./article.php");
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
                        <input type="text" class="form-control" name="idTL" readonly value="<?php echo $BV['ma_bviet'] ?>">
                    </div>

                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tiêu đề</span>
                        <input type="text" class="form-control" name="tieude" value = "<?php echo $BV['tieude'] ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên Bài Hát</span>
                        <input type="text" class="form-control" name="ten_bhat" value = "<?php echo $BV['ten_bhat'] ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tóm Tắt</span>
                        <input type="text" class="form-control" name="tomtat" value = "<?php echo $BV['tomtat'] ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Nội Dung</span>
                        <input type="text" class="form-control" name="noidung" value = "<?php echo $BV['noidung'] ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Thể loại</span>
                        <select name="ma_tloai" class="form-control" aria-label="Default select example">
                        <option value="<?php echo $BV['ma_tloai'] ?>" selected><?php echo $BV['ma_tloai'] ?> </option>
  <?php
  $showTloai = $connect->query("SELECT * FROM `theloai` ORDER BY `theloai`.`ma_tloai` ASC");
  $STloaiRow = mysqli_num_rows($showTloai);
  if ($STloaiRow>0) {
    while ($theloai = mysqli_fetch_array($showTloai)) {
        ?>
        <option value="<?php echo $theloai['ma_tloai'] ?>"><?php echo $theloai['ma_tloai'] ?> | <?php echo $theloai['ten_tloai'] ?></option>
        <?php
    };
    }else{
        // khong co the loai nao
    };
  ?>
</select>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tác giả</span>
                        <input type="text" class="form-control" name="ma_tgia" value = "<?php echo $BV['ma_tgia'] ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">URL Hình Ảnh</span>
                        <input type="text" class="form-control" name="hinhanh" value = "<?php echo $BV['hinhanh'] ?>">
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatId">Ngày đăng</span>
                        <input type="text" class="form-control" name="ngayviet" readonly value="<?php echo $BV['ngayviet'] ?>">
                    </div>

                    <div class="form-group  float-end ">
                        <input type="submit" value="Lưu lại" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning ">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

            <?php

        }else{
            echo 'ID Bai Viet khoong ton tai';
        }
    }

?>



<?php
if ($act=="del") {
    $delbaiviet = $connect->query("SELECT * FROM baiviet WHERE ma_bviet='".$_GET['id']."'");
    $id = $_GET['id'];
    if(mysqli_num_rows($delbaiviet)>0){
        $sql = "DELETE FROM `baiviet` WHERE `baiviet`.`ma_bviet` = $id";
        // Thực hiện câu truy vấn
        if (mysqli_query($connect, $sql)) {
            echo 'Xoa Thanh Cong';
            header("Location: ./article.php");
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