<?php
    include_once('../dbcontext/db.php');
    $db = new Database();
    if ( isset($_GET['id']) ) {
        $idclass = $_GET['id'];
        
        $check = $db->thucthi("DELETE FROM `classjoin` WHERE idclass =  $idclass");
        if ($check) {
            echo "<script>alert('xóa thành công') </script>";
            echo "<script>location.href = 'index.php';</script>";
        }
        echo "<script>location.href = 'index.php';</script>";
    }
?>