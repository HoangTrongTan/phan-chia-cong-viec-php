<?php include_once('../layout/header.php');
include_once('../teacher/uploadComponent.php');
$allgiaovienofstudent = $db->thucthi("SELECT `teachers`.id, `teachers`.`fullname` FROM `classjoin` INNER JOIN `teachers` ON `classjoin`.`idgiaovien` = `teachers`.`id` WHERE `classjoin`.`idstudent` = '$id' ");
$giaovien = $db->thucthi("SELECT `student`.`id` ,`teachers`.`fullname` FROM `student` INNER JOIN `teachers` ON `student`.`idgiaovien` = `teachers`.`id` WHERE `student`.`id` = '$id'  ");
$giaovienInfo = mysqli_fetch_array($giaovien);
if (isset($_POST['btn_send'])) {
    $fileName = $_FILES["file"]["name"];
    $idgv = isset($_POST['gv']) ? $_POST['gv'] : '';
    $check = $db->thucthi("INSERT INTO `uploadfilefromstudent`(`file`, `idsinhvien`, `idgiaovien`) VALUES ('$fileName','$id','$idgv')");
    if ($check) {
        uploadFILES($fileName);
        echo "<script>alert('thêm thành công') </script>";
        echo "<script>location.href = location.href;</script>";
    }
}
$cacfile = $db->thucthi("SELECT * FROM `uploadfilefromstudent` WHERE `idsinhvien` = '$id'  ");

?>
<h3>Các lớp đang học</h3>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Tải file lên
</button>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal body -->
            <div class="modal-body">
                <form  method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="email">File </label>
                        <input type="file" class="form-control" name="file">
                    </div>
                    <select name="gv" id="chucvu">
                        <option value="<?php echo $giaovienInfo['id'] ?>"><?php echo $giaovienInfo['fullname'] ?></option>
                        <?php while ($row1 = mysqli_fetch_assoc($allgiaovienofstudent)) { ?>
                            <option value="<?php echo $row1['id'] ?>"><?php echo $row1['fullname'] ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-primary" name="btn_send">Gửi</button>
                </form>
            </div>

        </div>
    </div>
</div>
<h3>Cá nhân</h3>
<div class="congviecs" style="display: flex; align-items: center; flex-wrap: wrap; gap: 5em;">
    <?php while ($row1 = mysqli_fetch_assoc($cacfile)) { ?>
        <div class="item-hs" style="background-color: #FEB7C7;">
            <p>----------</p>
            <i class="fa-solid fa-snowman"></i>
            <p>File <?php echo $row1['file'] ?></p>
            <a href="../upload/<?php echo $row1['file']  ?>" target="_blank">Tải về </a>
            <p>----------</p>
        </div>
    <?php } ?>

</div>
<?php include_once('../layout/header.php') ?>