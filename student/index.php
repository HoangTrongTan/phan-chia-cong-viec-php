<?php include_once('../layout/header.php');
$personalwork = $db->thucthi("SELECT * FROM `personalwork` WHERE `idstudent` = $id");
$lops = $db->thucthi("SELECT `groupwork`.workcontent,`groupwork`.startdate,`groupwork`.enddate   FROM `classjoin` INNER JOIN `groupwork` ON `classjoin`.idclass = `groupwork`.idclass WHERE  `classjoin`.idstudent = $id ");
$files = $db->thucthi("SELECT * FROM `uploadfilepersonal` WHERE `idstudent` = $id");
?>
<h3>Cá nhân</h3>
<div class="congviecs" style="display: flex; align-items: center; flex-wrap: wrap; gap: 5em;">
    <?php while ($row1 = mysqli_fetch_assoc($personalwork)) { ?>
        <div class="item-hs" style="background-color: orange;">
            <p>----------</p>
            <i class="fa-solid fa-car"></i>
            <p>Công việc: <?php echo $row1['workcontent'] ?></p>
            <p>Ngày thực hiện: <?php echo  $row1['startdate'] ?></p>
            <p>Ngày hoàn thiện: <?php echo $row1['enddate'] ?></p>
            <p>----------</p>
        </div>
    <?php } ?>

</div>
<h3 style="margin-top: 20px;">Lớp</h3>
<div class="congviecs" style="display: flex; align-items: center; flex-wrap: wrap; gap: 5em;">
    <?php while ($row1 = mysqli_fetch_assoc($lops)) { ?>
        <div class="item-hs">
            <p>----------</p>
            <i class="fa-brands fa-docker"></i>
            <p>Môn: <?php echo $row1['workcontent'] ?></p>
            <p>Ngày thực hiện: <?php echo  $row1['startdate'] ?></p>
            <p>Ngày hoàn thiện: <?php echo $row1['enddate'] ?></p>
            <p>----------</p>
        </div>
    <?php } ?>
</div>

<?php include_once('../layout/header.php') ?>