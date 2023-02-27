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
$showTGia = $connect->query("SELECT * FROM `tacgia` ORDER BY `tacgia`.`ma_tgia` ASC");
$STgiaRow = mysqli_num_rows($showTGia);
if ($STgiaRow>0) {
    echo '<main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <a href="add_author.php" class="btn btn-success">Thêm mới</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên tác giả</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>';
    while ($tacgia = mysqli_fetch_array($showTGia)) {
?>
<tbody>
                        <tr>
                            <th scope="row"><?php echo $tacgia['ma_tgia'] ?></th>
                            <td><?php echo $tacgia['ten_tgia'] ?></td>
                            <td>
                                <a href="edit_author.php?act=edit&id=<?php echo $tacgia['ma_tgia'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <a href="edit_author.php?act=del&id=<?php echo $tacgia['ma_tgia'] ?>"><i class="fa-solid fa-trash"></i></a>
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