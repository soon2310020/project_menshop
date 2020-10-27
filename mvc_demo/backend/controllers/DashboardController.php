<?php
require_once 'controllers/Controller.php';
class DashboardController extends Controller{
    public function index()
    {
        $this->content = $this->render('views/dashboards/index.php');
        //gọi layout để nhúng nội dung view create vừa lấy đc
        require_once 'views/layouts/main.php';
    }
}
?>