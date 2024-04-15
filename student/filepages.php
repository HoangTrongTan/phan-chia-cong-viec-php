<?php include_once('../layout/header.php');
    $personalwork = $db->thucthi("SELECT * FROM `uploadfilepersonal`
                                WHERE `idstudent` = $id");

?>
<h3>Các files</h3>
<div class="congviecs" style="display: flex; align-items: center; flex-wrap: wrap; gap: 5em;">
        <?php while ($row1 = mysqli_fetch_assoc($personalwork)) { ?>
        <div class="item-hs" style="background-color: brown; color: #fff;">
                <p>----------</p>
                <i class="fa-solid fa-road-bridge"></i>
                <p>Files: <?php echo $row1['file'] ?></p>
                <p>----------</p>
                <a href="../upload/<?php echo $row1['file'] ?>" target="_blank">xem</a>
            </div>
        <?php } ?>
    </div>
<?php include_once('../layout/header.php') ?>