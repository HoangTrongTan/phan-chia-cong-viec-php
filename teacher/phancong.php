<?php 
include_once('../layout/header.php');
include_once('../teacher/chucnang.php');
include_once('../teacher/uploadComponent.php');
if (isset($_SESSION['hocsinh'])) {
    $isStudent = $_SESSION['hocsinh'];
    echo "<script>window.location.href='../student/index.php'</script>";
}
?>

<?php

$alllop = $db->thucthi("SELECT * FROM `classroom` WHERE `idgiaovien` = $id");

// ---------------------------------------------------------------------------------------

if (isset($_POST['themcongviec'])) {
    $idcv = isset($_POST['id']) ? $_POST['id'] : '';
    $comment = isset($_POST['comment']) ? $_POST['comment'] : '';
    $start = isset($_POST['start']) ? $_POST['start'] : '';
    $end = isset($_POST['end']) ? $_POST['end'] : '';

    $check = $db->thucthi("INSERT INTO `groupwork`(`idclass`, `workcontent`,`startdate`,`enddate`) VALUES ('$idcv','$comment','$start', '$end')");
    if ($check) {
        echo "<script>alert('thêm thành công') </script>";
        echo "<script>location.href = location.href;</script>";
    }
}
if (isset($_POST['themlop'])) {
    $ten = isset($_POST['ten']) ? $_POST['ten'] : '';
    $check = $db->thucthi("INSERT INTO `classroom`(`classname`, `idgiaovien`) VALUES ('$ten',$id)");
    if ($check) {
        echo "<script>alert('thêm thành công') </script>";
        echo "<script>location.href = location.href;</script>";
    }
}

// ----------------------Thêm file-------------------------------------------

if (isset($_POST['themfile'])) {
    $fileName = $_FILES["file"]["name"];
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $check = $db->thucthi("INSERT INTO `uploadfileclassroom`(`file`, `idclassroom`) VALUES ('$fileName',$id)");
    if ($check) {
        echo "<script>alert('thêm thành công') </script>";
        echo "<script>location.href = location.href;</script>";
    }
    uploadFILES($fileName);
}
?>


<p style="margin: 50px;"></p>
<div class="wrapper-dsclass">
    <span>Danh sách các lớp</span>
    <?php while ($row = mysqli_fetch_assoc($alllop)) { ?>
        <div class="class-tem">
            <button data-toggle="collapse" data-target="#demo<?php echo $row['id'] ?>"><?php echo $row['classname'] ?></button>
            <button data-toggle="modal" data-target="#modalsua<?php echo $row['id'] ?>">Sửa</button>

            <div class="modal fade" id="modalsua<?php echo $row['id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="post" action="sua.php?id=<?php echo $row['id'] ?>">
                                <div class="form-group">
                                    <label for="email">Tên lớp</label>
                                    <input class="form-control" name="ten" id="file">
                                </div>
                                <button type="submit" class="btn btn-primary" name="themlop">sửa</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

            <button><a href="xoa.php?id=<?php echo $row['id']  ?>">Xóa</a></button>

            <!-- chức năng Xóa  -->

            <div id="demo<?php echo $row['id'] ?>" class="collapse">

                <table class="table">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $idlop = $row['id'];
                        $groupwork = $db->thucthi("SELECT * FROM `groupwork` WHERE idclass = $idlop");
                        while ($row1 = mysqli_fetch_assoc($groupwork)) { ?>
                            <tr>
                                <td>
                                    <p><?php echo $row1['workcontent'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo  $row1['startdate'] ?></p>
                                </td>
                                <td>
                                    <p><?php echo $row1['enddate'] ?></p>
                                </td>
                                <td>
                                    
                                    <?php $id_temp = $row1['id']; chucnang_component($id_temp) ?>
                                </td>

                            </tr>
                        <?php } ?>
                        <?php
                        $idlop = $row['id'];
                        $filesClass = $db->thucthi("SELECT * FROM `uploadfileclassroom` WHERE idclassroom = $idlop");
                        while ($row1 = mysqli_fetch_assoc($filesClass)) { ?>
                            <tr>
                                <td><a href="../upload/<?php echo $row1["file"] ?>" target="_blank"><?php echo $row1["file"] ?></a></td>
                                <td><i class="fa-solid fa-cloud"></i></td>
                                <td><i class="fa-solid fa-cloud"></i></td>
                                <td>
                                    <?php $id_temp = $row1['id']; chucnang_component($id_temp,true) ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- chức năng upload  -->
            <button data-toggle="modal" data-target="#modalupload<?php echo $row['id'] ?>">Upload File</button>
            <div class="modal fade" id="modalupload<?php echo $row['id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="post" action="#" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $row['id'] ?>">
                                    <label for="email">File </label>
                                    <input type="file" class="form-control" name="file">
                                </div>
                                <button type="submit" class="btn btn-primary" name="themfile">Thêm</button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>

        </div>
    <?php } ?>
</div>


<?php include_once("../teacher/themcongviec_compoment.php") ?>
<?php include_once("../teacher/themlop_component.php") ?>


<?php include_once('../layout/header.php') ?>
<!-- https://stackoverflow.com/questions/11601342/upload-doc-or-pdf-using-php -->