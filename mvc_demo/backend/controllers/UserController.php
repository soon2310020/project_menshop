<?php
require_once 'controllers/Controller.php';
require_once 'models/User.php';
require_once 'models/Pagination.php';

class UserController extends Controller
{
    public function profile()
    {
        $user_model = new User();
        if (isset($_GET['id']) & is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            $user_model->id = $id;
            $user = $user_model->getById();
            if (empty($user)) {
                header('location:index.php?controller=category&action=index');
                exit();
            }
            $this->content = $this->render('views/users/profile.php', [
                'user' => $user

            ]);
            if (isset($_POST['submit'])) {
                $username = $_POST['username'];
                $old_password = $_POST['old_password'];
                $new_password = $_POST['new_password'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $jobs = $_POST['jobs'];
                $facebook = $_POST['facebook'];
                $status = $_POST['status'];
                $us = $user_model->getUserByUsernameAndPassword($username, md5($old_password));
                //xử lý validate
                if (empty($username)) {
                    $this->error = 'Username không được để trống';
                } else if (!empty($new_password) || !empty($old_password)) {
                    if (empty($old_password)) {
                        $this->error = "nhập mật khẩu cũ để đổi mật khẩu ";

                    } else if (empty($new_password)) {
                        $this->error = "nhập mật khẩu mới để đổi mật khẩu ";
                    } else if (empty($us)) {
                        $this->error = "mật khẩu cũ không đúng ";
                    }
                } else if (!empty($email)) {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $this->error = 'Email không đúng định dạng';
                    } else {
                        $email_cf = $user_model->checkUserEmail($email);
                        if (!empty($email_cf)&&($email_cf['id']!=$id)) {
                            $this->error = "email đã tồn tại vui lòng nhập lại";
                        }
                    }

                } else if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
                    $this->error = 'Link facebook không đúng định dạng url';
                } else if ($_FILES['avatar']['error'] == 0) {
                    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                    $extension = strtolower($extension);
                    $allow_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                    $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                    $file_size_mb = round($file_size_mb, 2);
                    if (!in_array($extension, $allow_extensions)) {
                        $this->error = 'Phải upload avatar dạng ảnh';
                    } else if ($file_size_mb > 2) {
                        $this->error = 'File upload không được lớn hơn 2Mb';
                    }
                }
                if (empty($this->error)) {
                    $filename = $user['avatar'];// đặt bằng file ảnh có sẵn
                    if ($_FILES['avatar']['error'] == 0) {
                        $dir_uploads = __DIR__ . '/../assets/uploads/user_avatars';
                        @unlink($dir_uploads . '/' . $filename);
                        if (!file_exists($dir_uploads)) {
                            mkdir($dir_uploads);
                        }

                        $filename = time() . '-user-' . $_FILES['avatar']['name'];
                        move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                    }
                    $user_model->username = $username;
                    //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                    if (!empty($new_password) || !empty($old_password)) {
                        $user_model->password = md5($new_password);
                    }
                    $user_model->first_name = $first_name;
                    $user_model->last_name = $last_name;
                    $user_model->phone = $phone;
                    $user_model->address = $address;
                    $user_model->email = $email;
                    $user_model->avatar = $filename;
                    $user_model->jobs = $jobs;
                    $user_model->facebook = $facebook;
                    $user_model->status = $status;
                    $user_model->updated_at = date('Y-m-d H:i:s');
                    $is_update = $user_model->update($user['id']);
                    if ($is_update) {
                        $_SESSION['success'] = "cập nhập user thành công";
                        $user_model->id = $user['id'];
                        $_SESSION['user'] = $user_model->getById();
                        header('location:index.php?controller=category&action=index');
                        exit();
                    } else {
                        $_SESSION['error'] = "cập nhập user thất bại ";
                        header('location:index.php?controller=category&action=index');
                        exit();
                    }
                }
            }


        } else {
            header('location:index.php?controller=category&action=index');
            exit();
        }
        require_once 'views/layouts/main.php';
    }

    public function index()
    {
        $user_model = new User();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $total = $user_model->getTotal();
        $query_additional = '';
        if (isset($_GET['username'])) {
            $query_additional .= "&username=" . $_GET['username'];
        }
        $params = [
            'total' => $total,
            'limit' => 5,
            'query_string' => 'page',
            'controller' => 'user',
            'action' => 'index',
            'page' => $page,
            'query_additional' => $query_additional
        ];
        $pagination = new Pagination($params);
        $pages = $pagination->getPagination();
        $users = $user_model->getAllPagination($params);

        $this->content = $this->render('views/users/index.php', [
            'users' => $users,
            'pages' => $pages,
        ]);

        require_once 'views/layouts/main.php';
    }


    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=user");
            exit();
        }

        $id = $_GET['id'];
        $user_model = new User();
        $user = $user_model->getById($id);
        if (isset($_POST['submit'])) {

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $jobs = $_POST['jobs'];
            $facebook = $_POST['facebook'];
            $status = $_POST['status'];
            //xử lý validate
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error = 'Email không đúng định dạng';
            } else if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
                $this->error = 'Link facebook không đúng định dạng url';
            } else if ($_FILES['avatar']['error'] == 0) {
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $allow_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                $file_size_mb = round($file_size_mb, 2);
                if (!in_array($extension, $allow_extensions)) {
                    $this->error = 'Phải upload avatar dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được lớn hơn 2Mb';
                }
            }

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error)) {
                $filename = $user['avatar'];
                //xử lý upload ảnh nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = __DIR__ . '/../assets/uploads';
                    //xóa file ảnh đã update trc đó
                    @unlink($dir_uploads . '/' . $filename);
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }

                    $filename = time() . '-user-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                $user_model->first_name = $first_name;
                $user_model->last_name = $last_name;
                $user_model->phone = $phone;
                $user_model->address = $address;
                $user_model->email = $email;
                $user_model->avatar = $filename;
                $user_model->jobs = $jobs;
                $user_model->facebook = $facebook;
                $user_model->status = $status;
                $is_update = $user_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: index.php?controller=user');
                exit();
            }
        }

        $this->content = $this->render('views/users/update.php', [
            'user' => $user
        ]);

        require_once 'views/layouts/main.php';
    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=user');
            exit();
        }

        $id = $_GET['id'];
        $user_model = new User();
        $is_delete = $user_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: index.php?controller=user');
        exit();
    }

    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=user");
            exit();
        }
        $id = $_GET['id'];
        $user_model = new User();
        $user = $user_model->getById($id);

        $this->content = $this->render('views/users/detail.php', [
            'user' => $user
        ]);

        require_once 'views/layouts/main.php';
    }

    public function logout()
    {

//        session_destroy();
        $_SESSION = [];
        session_destroy();
//        unset($_SESSION['user']);
        $_SESSION['success'] = 'Logout thành công';
        header('Location: index.php?controller=login&action=login');
        exit();
    }
}