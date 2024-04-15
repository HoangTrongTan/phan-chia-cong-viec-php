<?php
    include_once('../dbcontext/db.php');
    $db = new Database();
    if ( isset($_GET['id']) ) {
        $idclass = $_GET['id'];        
        $idhocsinh = $_GET['idsinhvien'];        
        $check = $db->thucthi("DELETE FROM `uploadfilefromstudent` WHERE id = $idclass");
        if ($check) {
            echo "<script>alert('xóa thành công') </script>";
            echo "<script>location.href = 'index.php?id=$idhocsinh;</script>";
        }
        echo "<script>location.href = 'index.php';</script>";
    }
?>