<?php
    include_once('../dbcontext/db.php');
    $db = new Database();
    if ( isset($_GET['id']) ) {
        $idclass = $_GET['id'];
        $lop = $_POST['ten'];
        
        $check = $db->thucthi("DELETE FROM `classroom` WHERE id = $idclass");
        $check = $db->thucthi("DELETE FROM `groupwork` WHERE idclass = $idclass");
        $check = $db->thucthi("DELETE FROM `classjoin` WHERE idclass =  $idclass");
        if ($check) {
            echo "<script>alert('xóa thành công') </script>";
            echo "<script>location.href = 'index.php';</script>";
        }
        echo "<script>location.href = 'index.php';</script>";
    }
?>