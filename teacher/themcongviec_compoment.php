<div class="wrapper-them">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Thêm công việc
    </button>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post">
                        <select class="form-control" name="id">
                            <?php
                            $alllop2 = $db->thucthi("SELECT * FROM `classroom` WHERE `idgiaovien` = $id");
                            while ($row = mysqli_fetch_assoc($alllop2)) {
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['classname'] ?></option>
                            <?php } ?>
                        </select>
                        <div class="form-group">
                            <label for="comment">Ngày bắt đầu</label>
                            <input type="date" class="form-control" rows="5" name="start"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="comment">Ngày kết thúc</label>
                            <input type="date" class="form-control" rows="5" name="end"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="comment">Nội dung công việc:</label>
                            <textarea class="form-control" rows="5" name="comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="themcongviec">Thêm</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>