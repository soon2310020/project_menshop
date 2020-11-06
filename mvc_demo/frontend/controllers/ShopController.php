<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';
require_once 'models/Pagination.php';
class ShopController extends Controller
{
    public function shop() {
//    echo "<pre>" . __LINE__ . ", " . __DIR__ . "<br />";
//    print_r($_REQUEST);
//    echo "</pre>";
//    die;
//        echo "<pre>";
//        print_r($_POST);
//        echo "</pre>";
        if (isset($_SESSION['post'])&&empty($_POST))
        {
            $_POST=$_SESSION['post'];
            unset($_SESSION['post']);
        }


        $params=[];
        //nếu user có hành động filter
        if (isset($_POST['filters']))
        {
            $_SESSION['post']=$_POST;
            if (isset($_POST['search']))
            {

                $str_search="AND products.title like"."'%"."{$_POST['search']}"."%'";
                $params['search']=$str_search;
            }
        }
        if (isset($_POST['filter'])) {
            $_SESSION['post']=$_POST;


            if (isset($_POST['categories'])) {
                $category = implode(',', $_POST['categories']);
                //chuyển thành chuỗi sau để sử dụng câu lệnh in_array
                $str_category_id = "($category)";
                $params['category'] = $str_category_id;
            }
            if (isset($_POST['prices'])) {
                $str_price = '';
                foreach ($_POST['prices'] AS $price) {
                    if ($price == 0) {
                        $str_price .= " OR products.price < 200000";
                    }
                    if ($price == 1) {
                        $str_price .= " OR (products.price >= 200000 AND products.price < 1000000)";
                    }
                    if ($price == 2) {
                        $str_price .= " OR (products.price >= 1000000 AND products.price < 20000000)";
                    }
                    if ($price == 3) {
                        $str_price .= " OR products.price >= 2000000";
                    }
                }
                //cắt bỏ từ khóa OR ở vị trí ban đầu
                $str_price = substr($str_price, 3);
                $str_price = "($str_price)";
                $params['price'] = $str_price;
            }

//            echo "<pre>";
//            print_r($params);
//            echo "</pre>";
        }

        if (isset($_GET['page']))
        {
            $params['page']=$_GET['page'];

        }
        $product_model = new Product();
        $total= $product_model->countTotal($params);


        $products = $product_model->getProductInHomePage($params);
        $product_id=[];
        $color_pd=[];

        foreach ( $products as $product)
        {
            $color=$product_model->getColor($product['id']);
            array_push($product_id,$product['id']);
            array_push($color_pd,$color);

        }
        $params=array_combine($product_id,$color_pd);


        $params_pagination = [
            'controller'=>"shop",
            'action'=>"shop",
            'total' => $total,
            'limit' => 12,
            'full_mode' => FALSE,
        ];
        $pagination_model = new Pagination($params_pagination);
        $pagination = $pagination_model->getPagination();
        //get categories để filter
        $category_model = new Category();
        $categories = $category_model->getAll();

        $this->content = $this->render('views/shop/shop.php', [
            'products' => $products,
            'categories' => $categories,
        'pagination' => $pagination,
            'color'=>$params,
            'total'=>$total

        ]);

        require_once 'views/layouts/main.php';
    }
    public function cancel()
    {
        unset($_SESSION['post']);
        unset($_POST);
        header("location:index.php?controller=shop&action=shop");
        exit();
    }
}