<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['ten'])){
        echo 'không tồn tại';
        echo "<script>window.location.href='menu.php'</script>";
    }else{
        unset($_SESSION['ten']);
        unset($_SESSION['id']);
        unset($_SESSION['hocsinh']);
        echo "<script>window.location.href='menu.php' </script>";
    }
?>