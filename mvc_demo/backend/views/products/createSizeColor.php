<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
<div class="form-group">
        <label for="title">Nhập size sản phẩm</label>
        <input type="text" name="size" value="<?php echo isset($_POST['size']) ? $_POST['size'] : '' ?>"
               class="form-control" id="size"/>
    </div>
    <div class="form-group">
        <label for="title">Nhập màu sắc sản phẩm <small>(click để chọn)</small></label>
        <input type="color" name="color"  value="<?php echo isset($_POST['color']) ? $_POST['color'] : '#FFFFFF' ?>" class="form-control" style="width: 10%;">
    </div>
        <div class="form-group">
            <label for="title">Nhập số lượng sản phẩm</label>
            <input type="number" name="amount" value="<?php echo isset($_POST['amount']) ? $_POST['amount'] : '' ?>"
                   class="form-control" id="color"/>
        </div>
        <input type="submit" name="submit" value="Thêm" class="btn btn-primary"/>
        <a href="index.php?controller=product&action=index" class="btn btn-facebook">Không thêm nữa</a>
        <a href="index.php?controller=product&action=cancel" class="btn btn-default">Hủy không lưu</a>
</form>