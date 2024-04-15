<?php
function NotFileComponent()
{
?>
    <div class="form-group">
        <label for="email">Nội dung</label>
        <input class="form-control" name="ten">
    </div>
    <div class="form-group">
        <label for="comment">Ngày bắt đầu</label>
        <input type="date" class="form-control" rows="5" name="start"></textarea>
    </div>
    <div class="form-group">
        <label for="comment">Ngày kết thúc</label>
        <input type="date" class="form-control" rows="5" name="end"></textarea>
    </div>
<?php } ?>



<?php function chucnang_component($id, $isFile = false)
{
    $actions_form_sua = ($isFile ? "suaFile.php?id="  : "suawork.php?id=" ) . $id ;
    $actions_form_xoa = ($isFile ? "xoaFile.php?id=" : "xoawork.php?id=" ) . $id ;

?>
    <button class="btn btn-warning" data-toggle="modal" data-target="#modalsua1<?php echo $id ?>">Sửa</button><a class="btn btn-danger" href="<?php echo $actions_form_xoa ?>">xóa</a>

    <div class="modal fade" id="modalsua1<?php echo $id ?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="<?php echo $actions_form_sua ?>" enctype="multipart/form-data">
                        <?php if($isFile)
                            {  
                        ?>
                            <input type="file" class="form-control" name="file">
                        <?php } 
                                else 
                                {  NotFileComponent(); }  
                                ?>
                                
                        <button type="submit" class="btn btn-primary" name="themlop">cháp nhận</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
<?php } ?>