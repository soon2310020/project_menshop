<!-- Begin Page Content -->
<div class="container-fluid">
    <form action="" method="post">
        <input type="hidden" name="controller" value="category"/>
        <input type="hidden" name="action" value="index"/>
        <div class="form-group ">
            <div class="form-row">
                <div class=" col-sm-12 col-12  col-md-8">
                    <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>"
                           class="form-control" placeholder="nhập tên danh mục"/>
                </div>
                <div class=" col-sm-12 col-12  col-md-2">
                    <input type="submit" name="submit" value="Tìm kiếm"
                           class="btn btn-success form-control "/>
                </div>
                <div class=" col-sm-12 col-12  col-md-2">
                    <a href="index.php?controller=category&action=index" class="btn btn-secondary form-control">bỏ tìm</a>
                </div>
            </div>
        </div>

    </form>


    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh Mục</h6>
            <a href="index.php?controller=category&action=create" class="btn btn-primary"><i class="fa fa-plus"></i>create</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Avatar</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created_at</th>
                        <th>Updated_at</th>
                        <th></th>
                    </tr>
                    <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td>
                                    <?php echo $category['id']; ?>
                                </td>
                                <td>
                                    <?php echo $category['name']; ?>
                                </td>
                                <td>
                                    <?php if (!empty($category['avatar'])): ?>
                                        <img src="assets/uploads/categories_avatar/<?php echo $category['avatar'] ?>" width="60"/>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo $category['description']; ?>
                                </td>
                                <td>
                                    <?php
                                    $status_text = 'Active';
                                    if ($category['status'] == 0) {
                                        $status_text = 'Disabled';
                                    }
                                    echo $status_text;
                                    ?>
                                </td>
                                <td>
                                    <?php echo date('d-m-Y H:i:s', strtotime($category['created_at'])); ?>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($category['updated_at'])) {
                                        echo date('d-m-Y H:i:s', strtotime($category['updated_at']));
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="index.php?controller=category&action=detail&id=<?php echo $category['id'] ?>"
                                       title="Chi tiết">
                                        <i class="fa fa-eye"></i>
                                    </a><br>
                                    <a href="index.php?controller=category&action=update&id=<?php echo $category['id'] ?>"
                                       title="Sửa">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a><br>
                                    <a href="index.php?controller=category&action=delete&id=<?php echo $category['id'] ?>"
                                       title="Xóa"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này')">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>




                    <?php else: ?>
                        <tr>
                            <td colspan="8">Không có bản ghi nào</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <?php echo $pages; ?>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
