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
        $tieude  = "tieude";
        $ten_bhat = "ten_bhat";
        $ma_tloai = "ma_tloai";
        $tomtat = "tomtat";
        $noidung = "noidung";
        $ma_tgia = "ma_tgia";
        $ngayviet = date("Y-m-d H:i:s");
        $hinhanh = "hinhanh";
        /// Form submit
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["tieude"])) { $tieude = $_POST['tieude']; }
            if(isset($_POST["ten_bhat"])) { $ten_bhat = $_POST['ten_bhat']; }
            if(isset($_POST["ma_tloai"])) { $ma_tloai = $_POST['ma_tloai']; }
            if(isset($_POST["tomtat"])) { $tomtat = $_POST['tomtat']; }
            if(isset($_POST["noidung"])) { $noidung = $_POST['noidung']; }
            if(isset($_POST["ma_tgia"])) { $ma_tgia = $_POST['ma_tgia']; }
            if(isset($_POST["hinhanh"])) { $hinhanh = $_POST['hinhanh']; }
            //// xu ly
            if (empty($tieude)){
                echo 'Phải Nhập Tieu De';
            }else{
                $sql = "INSERT INTO baiviet (tieude, ten_bhat, ma_tloai, tomtat, noidung, ma_tgia, ngayviet, hinhanh) VALUES ('$tieude', '$ten_bhat', '$ma_tloai', '$tomtat', '$noidung', '$ma_tgia', '$ngayviet', '$hinhanh')";
                if (mysqli_query($connect, $sql)){
                    echo 'Bài Viết: '; echo $tieude; echo ' Thêm thành công';
                    header("Location: ./article.php");
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
                <h3 class="text-center text-uppercase fw-bold">Thêm mới Bài Viết</h3>
                <form action="" method="post">
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tiêu Đề</span>
                        <input type="text" class="form-control" name="tieude" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tên Bài Hát</span>
                        <input type="text" class="form-control" name="ten_bhat" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tóm Tắt</span>
                        <input type="text" class="form-control" name="tomtat" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Nội Dung</span>
                        <input type="text" class="form-control" name="noidung" >
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Thể Loại</span>
                        <select name="ma_tloai" class="form-control" aria-label="Default select example">
  <option value="" selected>Chọn Thể Loại?</option>
  <?php
  $showTloai = $connect->query("SELECT * FROM `theloai` ORDER BY `theloai`.`ma_tloai` ASC");
  $STloaiRow = mysqli_num_rows($showTloai);
  if ($STloaiRow>0) {
    while ($theloai = mysqli_fetch_array($showTloai)) {
        ?>
        <option value="<?php echo $theloai['ma_tloai'] ?>"><?php echo $theloai['ten_tloai'] ?></option>
        <?php
    }
    }else{
        // khong co the loai nao
    };
  ?>
</select>
                        
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">Tác Giả</span>
                        <select name="ma_tgia" class="form-control" aria-label="Default select example">
  <option value="" selected>Chọn Tác Giả?</option>
  <?php
  $showTgia = $connect->query("SELECT * FROM `tacgia` ORDER BY `tacgia`.`ma_tgia` ASC");
  $STgiaRow = mysqli_num_rows($showTgia);
  if ($STgiaRow>0) {
    while ($tacgia = mysqli_fetch_array($showTgia)) {
        ?>
        <option value="<?php echo $tacgia['ma_tgia'] ?>"><?php echo $tacgia['ten_tgia'] ?></option>
        <?php
    }
    }else{
        // khong co tac gia
    };
  ?>
</select>
                    </div>
                    <div class="input-group mt-3 mb-3">
                        <span class="input-group-text" id="lblCatName">URL Hình Ảnh</span>
                        <input type="text" class="form-control" name="hinhanh" >
                    </div>


                    <div class="form-group  float-end ">
                        <input type="submit" value="Thêm" class="btn btn-success">
                        <a href="article.php" class="btn btn-warning ">Quay lại</a>
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