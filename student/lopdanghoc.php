<?php include_once('../layout/header.php');
    $personalwork = $db->thucthi("SELECT `classroom`.classname ,`teachers`.fullname ,`classroom`.id
                                FROM `classjoin` 
                                INNER JOIN `classroom` 
                                ON `classjoin`.idclass = `classroom`.id 
                                INNER JOIN `teachers` 
                                ON  `classroom`.idgiaovien = `teachers`.id
                                WHERE `idstudent` = $id");

?>
<h3>Các lớp đang học</h3>
<div class="congviecs" style="display: flex; align-items: center; flex-wrap: wrap; gap: 5em;">
        <?php while ($row1 = mysqli_fetch_assoc($personalwork)) { ?>
        <div class="item-hs">
                <p>----------</p>
                <i class="fa-solid fa-mug-hot"></i>
                <p>Môn: <?php echo $row1['classname'] ?></p>
                <p>Giáo viên: <?php echo  $row1['fullname'] ?></p>
                <p>----------</p>
                <a href="xoalop.php?id=<?php echo $row1['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn rời lớp không?')">Rời lớp</a>
            </div>
        <?php } ?>
    </div>
<?php include_once('../layout/header.php') ?>