<?php
include_once('../layout/header.php');
include_once('../teacher/uploadComponent.php');
if (isset($_SESSION['hocsinh'])) {
    $isStudent = $_SESSION['hocsinh'];
    echo "<script>window.location.href='../student/index.php'</script>";
}
?>

<?php
$allhs = $db->thucthi("SELECT `student`.fullname, `student`.createdate,`student`.id
    FROM `student` 
    INNER JOIN `teachers` ON `teachers`.id = `student`.idgiaovien  
    WHERE `teachers`.id = $id ");

$idstu = "";
if (isset($_GET['id'])) {
    $idstu = $_GET['id']; //nghĩa là id sờ tiu đừn é

    $personalwork = $db->thucthi("SELECT * FROM `personalwork` WHERE `idstudent` = $idstu");
    $allFILES = $db->thucthi("SELECT * FROM `uploadfilepersonal` WHERE idstudent = $idstu");

    $cacfile = $db->thucthi("SELECT * FROM `uploadfilefromstudent` WHERE `idsinhvien` = '$idstu'  ");
}




if (isset($_POST['themcongviec'])) {
    $noidung = isset($_POST['noidung']) ? $_POST['noidung'] : '';
    $startdate = isset($_POST['startdate']) ? $_POST['startdate'] : '';
    $enddate = isset($_POST['enddate']) ? $_POST['enddate'] : '';
    $check = $db->thucthi("INSERT INTO `personalwork` VALUES ('$idstu','$noidung', '$startdate' , '$enddate')");
    if ($check) {
        echo "<script>alert('thêm thành công') </script>";
        echo "<script>location.href = location.href;</script>";
    }
}
if (isset($_POST['themfile'])) {
    $fileName = $_FILES["file"]["name"];

    $check = $db->thucthi("INSERT INTO `uploadfilepersonal`(`file`,`idstudent`) VALUES ('$fileName','$idstu')");
    if ($check) {
        echo "<script>alert('thêm thành công') </script>";
        echo "<script>location.href = 'index.php?id=$idstu';</script>";
    }
    uploadFILES($fileName);
}


?>

<h3>Dánh sách học sinh</h3>
<div style="padding: 40px 0; display: inline-block;">
    <?php if ($idstu != "") { ?>
        <button type="button" data-toggle="modal" data-target="#myModal">
            thêm công việc
        </button>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group">
                                <label for="email">Nội dung</label>
                                <input class="form-control" name="noidung">
                            </div>
                            <div class="form-group">
                                <label for="email">Ngày bắt đầu</label>
                                <input type="date" class="form-control" name="startdate">
                            </div>
                            <div class="form-group">
                                <label for="email">Ngày kết thúc</label>
                                <input type="date" class="form-control" name="enddate">
                            </div>
                            <button type="submit" name="themcongviec">chấp nhận</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div style="display: inline-block;">
    <button data-toggle="modal" data-target="#modalupload">Upload File đến học sinh</button>
    <div class="modal fade" id="modalupload">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="#" enctype="multipart/form-data">
                        <div class="form-group">
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

<?php
if ($idstu == "") {
    // Nếu $id rỗng, thì render ra phần HTML của trường hợp rỗng
    echo '<div class="wrapper-hocsinh">';

    while ($row = mysqli_fetch_assoc($allhs)) {
        echo '<div class="item-hs">';
        echo '<p>----------</p>';
        echo '<i class="fa-solid fa-paw"></i>';
        echo '<p>' . 'Học sinh: ' . $row['fullname'] . '</p>';
        echo '<p>' . 'Ngày vào lớp:  ' . $row['createdate'] . '</p>';
        echo '<p>' . 'Giáo viên: ' . $ten . '</p>';
        echo '<p>----------</p>';
        echo '<a href="index.php?id=' . $row['id'] . '">Chi tiết</a>';
        echo '</div>';
    }

    echo '</div>';
} else { ?>

    <div class="congviecs" style="display: flex; align-items: center; flex-wrap: wrap; gap: 8em; margin-top: 10px;">
        <?php while ($row1 = mysqli_fetch_assoc($personalwork)) { ?>
            <div class="item-hs">
                <p>----------</p>
                <i class="fa-solid fa-dragon"></i>
                <p>Công việc: <?php echo $row1['workcontent'] ?></p>
                <p>Ngày thực hiện: <?php echo  $row1['startdate'] ?></p>
                <p>Ngày hoàn thành: <?php echo $row1['enddate'] ?></p>
                <p>----------</p>
            </div>
        <?php } ?>
    </div>
    <h3 style="margin-top: 10px;">File </h3>
    <div class="congviecs" style="display: flex; align-items: center; flex-wrap: wrap; gap: 8em; margin-top: 10px;">
        <?php while ($row2 = mysqli_fetch_assoc($allFILES)) { ?>
            <div class="item-hs" style="width: 135px; height: 55px; background-color: gray;">
                <i class="fa-solid fa-kiwi-bird"></i>
                <p><a style="width: 200px; background-color: pink;" href="../upload/<?php echo $row2["file"] ?>" target="_blank"><?php echo $row2["file"] ?></a></p>
            </div>
        <?php } ?>
    </div>
    <h3 style="margin-top: 20px;" >File nộp</h3>
    <div class="congviecs" style="display: flex; align-items: center; flex-wrap: wrap; gap: 5em;">
        <?php while ($row1 = mysqli_fetch_assoc($cacfile)) { ?>
            <div class="item-wrapper">
                <a style="background-color: red; color: #FFF; border-radius: 10px;" class="hjklmnv" href="delfilehocsinh.php?id=<?php echo $row1['id'] ?>&idsinhvien=<?php echo $idstu ?>">xóa</a>
                <div class="item-hs" style="background-color: #B15DE3;">
                    <p>----------</p>
                    <i class="fa-solid fa-baby"></i>
                    <p>File <?php echo $row1['file'] ?></p>
                    <span> <a class="close-btn">&times;</a> </span>
                    <a href="../upload/<?php echo $row1['file']  ?>" target="_blank">Tải về </a>
                    <p>----------</p>
                </div>
            </div>
        <?php } ?>

    </div>
<?php } ?>




<?php include_once('../layout/header.php') ?>