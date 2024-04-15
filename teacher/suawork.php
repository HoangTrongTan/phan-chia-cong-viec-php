<?php
    include_once('../dbcontext/db.php');
    $db = new Database();
    if ( isset($_GET['id']) ) {
        $idclass = $_GET['id'];
        $lop = $_POST['ten'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        
        $check = $db->thucthi("UPDATE `groupwork` SET `workcontent`='$lop' , `startdate` = '$start', `enddate` = '$end' WHERE id = $idclass");
        if ($check) {
            echo "<script>alert('sửa thành công') </script>";
            echo "<script>location.href = 'index.php';</script>";
        }
        echo "<script>location.href = 'index.php';</script>";
    }
?>