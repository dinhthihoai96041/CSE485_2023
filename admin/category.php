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
$showTloai = $connect->query("SELECT * FROM `theloai` ORDER BY `theloai`.`ma_tloai` ASC");
$STloaiRow = mysqli_num_rows($showTloai);
if ($STloaiRow>0) {
    echo '<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <a href="add_category.php" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên thể loại</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>';
    while ($theloai = mysqli_fetch_array($showTloai)) {
?>
<tbody>
                        <tr>
                            <th scope="row"><?php echo $theloai['ma_tloai'] ?></th>
                            <td><?php echo $theloai['ten_tloai'] ?></td>
                            <td>
                                <a href="edit_category.php?act=edit&id=<?php echo $theloai['ma_tloai'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href="edit_category.php?act=del&id=<?php echo $theloai['ma_tloai'] ?>"><i class="fa-solid fa-trash"></i></a>
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