<?php
    include_once('../dbcontext/db.php');
    include_once('../teacher/uploadComponent.php');

    $db = new Database();
    if ( isset($_POST['themlop']) ) {
        $fileName = $_FILES["file"]["name"];
        $idclass = $_GET['id'];
        uploadFILES($fileName);
        
        
        $check = $db->thucthi("UPDATE `uploadfileclassroom` SET `file`='$fileName'  WHERE id  = $idclass");
        if ($check) {
            echo "<script>alert('sửa thành công') </script>";
            echo "<script>location.href = 'phancong.php';</script>";
        }
        echo "<script>location.href = 'index.php';</script>";
    }
?>