<?php
    include_once('../dbcontext/db.php');
    $db = new Database();
    if (isset($_GET['idclass']) && isset($_GET['idgiaovien'])) {
        $idclass = $_GET['idclass'];
        $idgiaovien = $_GET['idgiaovien'];
        $idhocsinh = $_GET['idhocsinh'];

         
        $check = $db->thucthi("SELECT * FROM `classjoin` WHERE idstudent = $idhocsinh AND idclass = $idclass");
        $row = mysqli_num_rows($check);
        if($row > 0){
            echo "<script>alert('bạn đã đăng ký lớp này rồi') </script>";
            echo "<script>location.href = 'gheplop.php';</script>";
        }else{

            $check = $db->thucthi("INSERT INTO `classjoin`(`idstudent`, `idclass`, `idgiaovien`) VALUES ('$idhocsinh','$idclass', '$idgiaovien' )");
            if ($check) {
                echo "<script>alert('thêm thành công') </script>";
                echo "<script>location.href = 'index.php';</script>";
            }
            echo "<script>location.href = 'index.php';</script>";
        }
    }
?>
