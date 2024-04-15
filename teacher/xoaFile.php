<?php
    include_once('../dbcontext/db.php');
    $db = new Database();
    if ( isset($_GET['id']) ) {
        $id = $_GET['id'];
        
        $check = $db->thucthi("DELETE FROM `uploadfileclassroom` WHERE id = $id");
        if ($check) {
            echo "<script>alert('sửa thành công') </script>";
            echo "<script>location.href = 'phancong.php';</script>";
        }
        echo "<script>location.href = 'index.php';</script>";
    }
?>