<?php
    include_once('../dbcontext/db.php');
    $db = new Database();
    if ( isset($_GET['id']) ) {
        $idclass = $_GET['id'];
        $lop = $_POST['ten'];
        
        $check = $db->thucthi("UPDATE `classroom` SET `classname`='$lop' WHERE id = $idclass");
        if ($check) {
            echo "<script>alert('sửa thành công') </script>";
            echo "<script>location.href = 'index.php';</script>";
        }
        echo "<script>location.href = 'index.php';</script>";
    }
?>