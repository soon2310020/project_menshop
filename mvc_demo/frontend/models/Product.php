<?php
require_once 'models/Model.php';
class Product extends Model {

  public function getProductInHomePage($params = []) {
//      echo "<pre>";
//        print_r($params);
//        echo "</pre>";
    $str_filter = '';
    if (isset($params['category'])) {
      $str_category = $params['category'];
      $str_filter .= " AND categories.id IN $str_category";
    }
    if (isset($params['price'])) {
      $str_price = $params['price'];
      $str_filter .= " AND $str_price";
    }
    if (isset($params['search']))
    {
        $str_filter.=$params['search'];
    }

    $start=0;
    $total =$this->countTotal($params);
    if (isset($params['page'])&& is_numeric($params['page']))
    {
        $start=($params['page']-1)*12;
        if($params['page']>ceil($total/12))
        {
            $start=(ceil($total/12)-1)*12;
        }
    }
    //do cả 2 bảng products và categories đều có trường name, nên cần phải thay đổi lại tên cột cho 1 trong 2 bảng
    $sql_select = "SELECT products.*, categories.name 
          AS category_name FROM products
          INNER JOIN categories ON products.category_id = categories.id
          WHERE products.status = true $str_filter LIMIT $start,12
           ";

    $obj_select = $this->connection->prepare($sql_select);
    $obj_select->execute();

    $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
    return $products;
  }
  public function getProductNewArrivals()
  {
      $sql_select = "SELECT products.*, categories.name 
          AS category_name FROM products
          INNER JOIN categories ON products.category_id = categories.id
          limit 12";

      $obj_select = $this->connection->prepare($sql_select);
      $obj_select->execute();

      $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
      return $products;
  }
    public function getColor($id)
    {
        $sql_select = "SELECT product_color.color FROM products INNER JOIN product_color on products.id=product_color.product_id where products.id=$id";

        $obj_select = $this->connection->prepare($sql_select);
        $obj_select->execute();

        $color = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $color;
    }
  /**
   * Lấy thông tin sản phẩm theo id
   * @param $id
   * @return mixed
   */
  public function getById($id)
  {
    $obj_select = $this->connection
      ->prepare("SELECT products.*, categories.name AS category_name FROM products 
          INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $id");

    $obj_select->execute();
    $product =  $obj_select->fetch(PDO::FETCH_ASSOC);
    return $product;
  }
    public function countTotal($params=[])
    {
        $str_filter = '';
        if (isset($params['category'])) {
            $str_category = $params['category'];
            $str_filter .= " AND categories.id IN $str_category";
        }
        if (isset($params['price'])) {
            $str_price = $params['price'];
            $str_filter .= " AND $str_price";
        }
        if (isset($params['search']))
        {
            $str_filter.=$params['search'];
        }
        $obj_select = $this->connection ->prepare("SELECT count(*) FROM products 
                        INNER JOIN categories ON categories.id = products.category_id
                        WHERE TRUE $str_filter
                        ");
        $obj_select->execute();

        return $obj_select->fetchColumn();
    }
}

