<?php
include("trust/config.php");
include("trust/head.php");
include("trust/main.php");
?>
<?php
$showBaiviet = $connect->query("SELECT * FROM `baiviet` ORDER BY `baiviet`.`view_bv` DESC");
$SBaiVietRow = mysqli_num_rows($showBaiviet);
if ($SBaiVietRow>0) {
    echo '<main class="container-fluid mt-3">
    <h3 class="text-center text-uppercase mb-3 text-primary">TOP bài hát yêu thích</h3>
    <div class="row">';
    while ($baiviet = mysqli_fetch_array($showBaiviet)) {
?>


<div class="col-sm-3">
                <div class="card mb-2" style="width: 100%;">
                    <img src="<?php echo $baiviet['hinhanh'] ?>" class="card-img-top" alt="<?php echo $baiviet['tieude'] ?>">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="./detail.php?id=<?php echo $baiviet['ma_bviet'] ?>" class="text-decoration-none"><?php echo $baiviet['tieude'] ?></a>
                        </h5>
                    </div>
                </div>
</div>
        

<?php
    }
echo '</div>
</main>';
}else{
    // khong co bai viet nao
}
?>


<?php
include("trust/foot.php");
?>