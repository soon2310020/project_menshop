<?php
require_once 'helpers/Helper.php';
?>
    <div class="container-fluid">
        <!--form search-->
        <form action="" method="GET">
            <div class="form-group">
                <label for="title">Nhập tên sản phẩm</label>
                <input type="text" name="title" value="<?php echo isset($_GET['title']) ? $_GET['title'] : '' ?>"
                       id="title"
                       class="form-control"/>
            </div>
            <div class="form-group">
                <label for="title">Chọn loại sản phẩm</label>
                <select name="category_id" class="form-control">
                    <?php foreach ($categories as $category):
                        //giữ trạng thái selected của category sau khi chọn dựa vào
//                tham số category_id trên trình duyệt
                        $selected = '';
                        if (isset($_GET['category_id']) && $category['id'] == $_GET['category_id']) {
                            $selected = 'selected';
                        }
                        ?>
                        <option value="<?php echo $category['id'] ?>" <?php echo $selected; ?>>
                            <?php echo $category['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="hidden" name="controller" value="product"/>
            <input type="hidden" name="action" value="index"/>
            <input type="submit" name="search" value="Tìm kiếm" class="btn btn-success"/>
            <a href="index.php?controller=product" class="btn btn-secondary">Bỏ tìm</a>
        </form>


        <div class="card shadow mb-4">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Sản phẩm</h6>
                <a href="index.php?controller=product&action=create" class="btn btn-primary"><i class="fa fa-plus"></i>Thêm</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <tr>
                            <th>ID</th>
                            <th>Category name</th>
                            <th>Title</th>
                            <th>Avatar</th>
                            <th>size</th>
                            <th>color</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th></th>
                        </tr>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo $product['id'] ?></td>
                                    <td><?php echo $product['category_name'] ?></td>
                                    <td><?php echo $product['title'] ?></td>
                                    <td>
                                        <?php if (!empty($product['avatar'])): ?>
                                            <img height="80" src="assets/uploads/products_avatar/<?php echo $product['avatar'] ?>"/>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $product['pd_size'] ?></td>
                                    <td><span style="background-color: <?php echo $product['pd_color']  ?>; " class="btn btn-facebook">          </span></td>
                                    <td><?php echo number_format($product['price']) ?></td>
                                    <td><?php echo $product['pd_amount'] ?></td>
                                    <td><?php echo Helper::getStatusText($product['status']) ?></td>
                                    <td><?php echo date('d-m-Y H:i:s', strtotime($product['created_at'])) ?></td>
                                    <td><?php echo !empty($product['updated_at']) ? date('d-m-Y H:i:s', strtotime($product['updated_at'])) : '--' ?></td>
                                    <td style="text-align: unset;">
                                        <?php
                                        $product['pd_color']=str_replace('#','z',$product['pd_color']);

                                        $url_delete = "index.php?controller=product&action=delete&id={$product['id']}&color={$product['pd_color']}&size={$product['pd_size']}";
                                        $url_update = "index.php?controller=product&action=update&id={$product['id']}&color={$product['pd_color']}&size={$product['pd_size']}";
                                        $url_detail = "index.php?controller=product&action=detail&id={$product['id']}&color={$product['pd_color']}&size={$product['pd_size']}";
                                        ?>
                                        <a title="Chi tiết" href="<?php echo $url_detail ?>"><i
                                                    class="fa fa-eye"></i></a> &nbsp;&nbsp;<br>
                                        <a title="Update" href="<?php echo $url_update ?>"><i
                                                    class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;<br>
                                        <a title="Xóa" href="<?php echo $url_delete ?>"
                                           onclick="return confirm('Are you sure delete?')"><i
                                                    class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        <?php else: ?>
                            <tr>
                                <td colspan="9">No data found</td>
                            </tr>
                        <?php endif; ?>

                    </table>
                    <?php echo $pages; ?>
                </div>
            </div>
        </div>

    </div>
