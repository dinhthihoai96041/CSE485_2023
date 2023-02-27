<?php
include("trust/config.php");
include("trust/head.php");
?>

<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
        $searchbaiviet = $connect->query("SELECT * FROM baiviet WHERE ma_bviet='$id'");
        if(mysqli_num_rows($searchbaiviet)>0){
            $baiviet = mysqli_fetch_array($searchbaiviet);
            // thêm lượt xem cho bài viết view_bv
            $view_bv = "UPDATE baiviet SET `view_bv`= `view_bv` + '1' WHERE ma_bviet='$id'";
            if (mysqli_query($connect, $view_bv)) {}else{}
            ?>
            <main class="container mt-5">
        <!-- <h3 class="text-center text-uppercase mb-3 text-primary">CẢM NHẬN VỀ BÀI HÁT</h3> -->
       
                <div class="row mb-5">
                    <div class="col-sm-4">
                        <img src="<?php echo $baiviet['hinhanh']; ?>" class="img-fluid" alt="<?php echo $baiviet['tieude']; ?>">
                    </div>
                    <div class="col-sm-8">
                        <h5 class="card-title mb-2">
                            <a href="" class="text-decoration-none"><?php echo $baiviet['tieude']; ?></a>
                        </h5>
                        <p class="card-text"><span class=" fw-bold">Bài hát: </span><?php echo $baiviet['tieude']; ?></p>
                        <?php
                        $mtheloai = $baiviet['ma_tloai'];
                        $searchtloai = $connect->query("SELECT * FROM theloai WHERE ma_tloai=$mtheloai");
                        if(mysqli_num_rows($searchtloai)>0){
                            $tloai = mysqli_fetch_array($searchtloai);
                            ?>
                            <p class="card-text"><span class=" fw-bold">Thể loại: </span><?php echo $tloai['ten_tloai']; ?></p>
                            <?php
                        }else{
                            echo '<p class="card-text"><span class=" fw-bold">Thể loại: </span> Chưa xác định</p>';
                        }
                        ?>
                        <p class="card-text"><span class=" fw-bold">Tóm tắt: </span><?php echo $baiviet['tomtat']; ?></p>
                        <p class="card-text"><span class=" fw-bold">Nội dung: </span><?php echo $baiviet['noidung']; ?></p>
                        <?php
                        $tgia = $baiviet['ma_tgia'];
                        $searchtgia = $connect->query("SELECT * FROM tacgia WHERE ma_tgia=$tgia");
                        if(mysqli_num_rows($searchtgia)>0){
                            $tgia = mysqli_fetch_array($searchtgia);
                            ?>
                            <p class="card-text"><span class=" fw-bold">Tác giả: </span><?php echo $tgia['ten_tgia']; ?></p>
                            <?php
                        }else{
                            echo '<p class="card-text"><span class=" fw-bold">Tác giả: </span> Chưa xác định</p>';
                        }
                        ?>
                    </div>          
        </div>
    </main>
    <?php
        }else{

        }

}
?>
    
    <?php
include("trust/foot.php");
?>