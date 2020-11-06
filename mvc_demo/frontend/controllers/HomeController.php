<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';

class HomeController extends Controller {
  public function index() {
    $product_model = new Product();
    $products = $product_model->getProductNewArrivals();
    $product_id=[];
    $color_pd=[];

    foreach ( $products as $product)
    {
        $color=$product_model->getColor($product['id']);
        array_push($product_id,$product['id']);
        array_push($color_pd,$color);

    }
    $params=array_combine($product_id,$color_pd);

    $this->content = $this->render('views/homes/index.php', [
      'products' => $products,
        'color'=>$params
    ]);
    require_once 'views/layouts/main.php';
  }
}