<?php include_once('../layout/header.php') ?>

<?php
$idtemp = "";
if (isset($_GET['id'])) {
    $idtemp = $_GET['id'];
}
?>
<?php if ($idtemp != "") { ?>
    <div class="congviecs" style="display: flex; align-items: center; flex-wrap: wrap; gap: 8em;">
        <?php
        $alllop2 = $db->thucthi("SELECT * FROM `classroom` where idgiaovien = $idtemp ");
        while ($row = mysqli_fetch_assoc($alllop2)) {
        ?>
            <div class="item-hs">
                <p>----------</p>
                <i class="fa-solid fa-otter"></i>
                <p>Lớp: <?php echo $row['classname'] ?></p>
                <a href="dangky.php?idclass=<?php echo $row['id'] ?>&idgiaovien=<?php echo $idtemp ?>&idhocsinh=<?php echo $id ?>">Đăng ký</a>
                <p>----------</p>
            </div>
        <?php } ?>
    </div>

<?php } else { ?>
    <div class="congviecs" style="display: flex; align-items: center; flex-wrap: wrap; gap: 5em;">
    <?php
    $alllop2 = $db->thucthi("SELECT * FROM `teachers`");
    while ($row = mysqli_fetch_assoc($alllop2)) {
    ?>
        <div class="item-hs" style="background-color: yellow;">
            <p>----------</p>
            <i class="fa-solid fa-person"></i>
            <p>Giáo viên: <?php echo $row['fullname'] ?></p>
            <p>----------</p>
            <a href="gheplop.php?id=<?php echo $row['id'] ?>">Chi tiết</a>
        </div>
<?php } ?>
</div>
<?php } ?>
<?php include_once('../layout/header.php') ?>