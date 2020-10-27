<?php
require_once 'helpers/Helper.php';
?>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $product['id']?></td>
    </tr>
    <tr>
        <th>Category name</th>
        <td><?php echo $product2['category_name']?></td>
    </tr>
    <tr>
        <th>Title</th>
        <td><?php echo $product['title']?></td>
    </tr>
    <tr>
        <th>Avatar</th>
        <td>
            <?php if (!empty($product['avatar'])): ?>
                <img height="80" src="assets/uploads/products_avatar/<?php echo $product['avatar'] ?>"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>Price</th>
        <td><?php echo number_format($product['price']) ?></td>
    </tr>
    <tr>
        <th>Số lượng</th>
        <td><?php echo $product['amount'] ?></td>
    </tr>
    <tr>
        <th>Size</th>
        <td><?php echo $product['size'] ?></td>
    </tr>
    <tr>
        <th>Màu sắc</th>
        <td><span style="background-color: <?php echo $product['color']  ?>; " class="btn btn-facebook">          </span></td>
    </tr>
    <tr>
        <th>Mô tả ngắn</th>
        <td><?php echo $product['summary'] ?></td>
    </tr>

    <tr>
        <th>Mô tả chi tiết</th>
        <td><?php echo $product['content'] ?></td>
    </tr>
    <tr>
        <th>Seo Title</th>
        <td><?php echo $product['seo_title'] ?></td>
    </tr>
    <tr>
        <th>Seo description</th>
        <td><?php echo $product['seo_description'] ?></td>
    </tr>
    <tr>
        <th>Seo keywords</th>
        <td><?php echo $product['seo_keywords'] ?></td>
    </tr>
    <tr>
        <th>Status</th>
        <td><?php echo Helper::getStatusText($product['status']) ?></td>
    </tr>
    <tr>
        <th>Created at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($product['created_at'])) ?></td>
    </tr>
    <tr>
        <th>Updated at</th>
        <td><?php echo !empty($product['updated_at']) ? date('d-m-Y H:i:s', strtotime($product['updated_at'])) : '--' ?></td>
    </tr>
</table>
<a href="index.php?controller=product&action=index" class="btn btn-facebook">Back</a>