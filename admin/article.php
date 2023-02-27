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
$showBViet = $connect->query("SELECT * FROM `baiviet` ORDER BY `baiviet`.`ma_bviet` DESC");
$SBvietRow = mysqli_num_rows($showBViet);
if ($SBvietRow>0) {
    echo '<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <a href="add_article.php" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên tác giả</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>';
    while ($baiviet = mysqli_fetch_array($showBViet)) {
?>
<tbody>
                        <tr>
                            <th scope="row"><?php echo $baiviet['ma_bviet'] ?></th>
                            <td><?php echo $baiviet['tieude'] ?></td>
                            <td>
                                <a href="edit_article.php?act=edit&id=<?php echo $baiviet['ma_bviet'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href="edit_article.php?act=del&id=<?php echo $baiviet['ma_bviet'] ?>"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>


<?php
    }
echo '</table>
</div>
</div>
</main>';
}else{
    // khong co the loai nao
}
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