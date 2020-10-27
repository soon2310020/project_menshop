<?php
require_once 'models/Model.php';

class Product extends Model
{

    public $id;
    public $category_id;
    public $title;
    public $avatar;
    public $price;
    public $amount;
    public $summary;
    public $content;
    public $seo_title;
    public $seo_description;
    public $seo_keywords;
    public $status;
    public $size;
    public $color;
    public $created_at;
    public $updated_at;
    /*
     * Chuỗi search, sinh tự động dựa vào tham số GET trên Url
     */
    public $str_search = '';

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['title']) && !empty($_GET['title'])) {
            $this->str_search .= " AND products.title LIKE '%{$_GET['title']}%'";
        }
        if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
            $this->str_search .= " AND products.category_id = {$_GET['category_id']}";
        }
    }

    /**
     * Lấy thông tin của sản phẩm đang có trên hệ thống
     * @return array
     */
    public function getAll()
    {
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name FROM products 
                        INNER JOIN categories ON categories.id = products.category_id
                        WHERE TRUE $this->str_search
                        ORDER BY products.created_at DESC
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }

    /**
     * Lấy thông tin của sản phẩm đang có trên hệ thống
     * @param array Mảng các tham số phân trang
     * @return array
     */
    public function getAllPagination($arr_params)
    {
        $limit = $arr_params['limit'];
        $page = $arr_params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name,product_color.color AS pd_color,product_color.size AS pd_size,product_color.amount as pd_amount FROM products 
                        INNER JOIN categories ON categories.id = products.category_id 
                        inner join product_color on product_color.product_id=products.id
                        WHERE TRUE $this->str_search
                        ORDER BY products.updated_at DESC, products.created_at DESC
                        LIMIT $start, $limit
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $products;
    }
    public function getLatest()
    {
        $obj_select = $this->connection
            ->prepare("select * from products ORDER BY id DESC LIMIT 1");

        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Tính tổng số bản ghi đang có trong bảng products
     * @return mixed
     */
    public function countTotal()
    {
        $obj_select = $this->connection->prepare("SELECT COUNT(*) FROM products inner join product_color on products.id=product_color.product_id
WHERE TRUE $this->str_search");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }

    /**
     * Insert dữ liệu vào bảng products
     * @return bool
     */
    public function insert()
    {
        $obj_insert = $this->connection
            ->prepare("INSERT INTO products(category_id,title, avatar, price, summary, content, seo_title, seo_description, seo_keywords, status) 
                                VALUES (:category_id , :title, :avatar, :price, :summary, :content, :seo_title, :seo_description, :seo_keywords, :status)");
        $arr_insert = [
            ':category_id' => $this->category_id,
            ':title' => $this->title,
            ':avatar' => $this->avatar,
            ':price' => $this->price,
            ':summary' => $this->summary,
            ':content' => $this->content,
            ':seo_title' => $this->seo_title,
            ':seo_description' => $this->seo_description,
            ':seo_keywords' => $this->seo_keywords,
            ':status' => $this->status
        ];
        return $obj_insert->execute($arr_insert);
    }

    /**
     * Lấy thông tin sản phẩm theo id
     * @param $id
     * @return mixed
     */
    public function insertSizeColor()
    {
        $obj_insert = $this->connection
            ->prepare("insert into product_color(product_id,color,`size`,amount) values(:product_id,:color,:size_z,:amount) ");
        $arr_insert = [
            ':product_id'=>$this->id,
            ':color'=>$this->color,
            ':size_z'=>$this->size,
            ':amount'=>$this->amount
        ];
        return $obj_insert->execute($arr_insert);
    }
    public function getById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT products.*, categories.name AS category_name FROM products 
          INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $id");

        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }


    public function update($id,$color,$size)
    {

        $obj_update = $this->connection
            ->prepare("UPDATE products SET category_id=:category_id, title=:title, avatar=:avatar, price=:price,
            summary=:summary, content=:content, seo_title=:seo_title, seo_description=:seo_description, seo_keywords=:seo_keywords, status=:status, updated_at=:updated_at WHERE id = $id
");
        $arr_update = [
            ':category_id' => $this->category_id,
            ':title' => $this->title,
            ':avatar' => $this->avatar,
            ':price' => $this->price,
            ':summary' => $this->summary,
            ':content' => $this->content,
            ':seo_title' => $this->seo_title,
            ':seo_description' => $this->seo_description,
            ':seo_keywords' => $this->seo_keywords,
            ':status' => $this->status,
            ':updated_at' => $this->updated_at,
        ];

        $is_updated_product = $obj_update->execute($arr_update);

        if ($is_updated_product)
        {
            return true;
        }
        return false;
    }


    public function delete($id,$color,$size)
    {

        $obj_delete = $this->connection
            ->prepare("DELETE product_color FROM products inner join product_color on products.id=product_color.product_id WHERE products.id = $id and product_color.color='".$color."' and  product_color.size='"."$size'");
        return $obj_delete->execute();

    }
    public function getColorSize($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT count(*) from product_color WHERE product_id = $id");

        return $obj_select->execute();

    }
    public function getColorSize2($id,$color,$size)
    {
        $obj_select = $this->connection
            ->prepare("select * FROM products inner join product_color on products.id=product_color.product_id WHERE products.id = $id and product_color.color='".$color."' and  product_color.size='"."$size'");

        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);

    }
    public function delete2($id)
    {
        $obj_delete = $this->connection
            ->prepare("DELETE FROM products WHERE id = $id");
        return $obj_delete->execute();
    }
}