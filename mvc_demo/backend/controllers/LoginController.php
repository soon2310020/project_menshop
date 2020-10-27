<?php
require_once 'models/User.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class LoginController
{
    //chứa nội dung view
    public $content;
    //chứa nội dung lỗi validate
    public $error;

    public function forgot()
    {
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $user_model = new User();
            if (empty($email)) {
                $this->error = "vui lòng nhập email";
            } else {

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->error = "email không đúng định dạng vui lòng nhập lại";
                } else {
                    $email_cf = $user_model->checkUserEmail($email);
                    if (!empty($email_cf)) {


                        require_once 'helpers/PHPMailer/src/Exception.php';
                        require_once 'helpers/PHPMailer/src/PHPMailer.php';
                        require_once 'helpers/PHPMailer/src/SMTP.php';

                        $mail = new PHPMailer(true);


                        //Server settings
//                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                        $mail->isSMTP();                                            // Send using SMTP
                        $mail->Host = 'smtp.gmail.com';                    // Set the SMTP server to send through
                        $mail->SMTPAuth = true;
                        // Enable SMTP authentication
                        //tên đăng nhập gmail
                        $mail->Username = 'sont457@gmail.com';                     // SMTP username
                        //ko phải password đưang nhập gmail, là mật khẩu ứng dụng
                        //https://myaccount.google.com/
                        //cần xác minh 2 bước để có thể tạo mật khẩu ứng dụng
                        $mail->Password = 'fdhluxtrovkfrope';                               // SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                        $mail->Port = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                        //Recipients
                        $mail->setFrom('sont457@gmail.com', 'reset password');

                        $mail->addAddress($email);

                        $mail->addReplyTo('info@example.com', 'Information');
                        $mail->addCC('cc@example.com');
                        $mail->addBCC('bcc@example.com');


                        $mail->isHTML(true);                                  // Set email format to HTML
                        $mail->Subject = 'reset your web password';
                        $mail->Body = 'nơi để link reset <b>click here to reset!</b>';
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                        $mail->send();

                        $_SESSION['success'] = "thành công kiểm tra email của bạn để reset password";

                    }
                    else
                    {
                        $this->error=' không có user nào có email trên';
                    }
                }
            }
        }
        $this->content = $this->render('views/users/forgot.php');

        require_once 'views/layouts/main_login.php';
    }

    /**
     * @param $file string Đường dẫn tới file
     * @param array $variables array Danh sách các biến truyền vào file
     * @return false|string
     */
    public function render($file, $variables = [])
    {
        //Nhập các giá trị của mảng vào các biến có tên tương ứng chính là key của phần tử đó.
        //khi muốn sử dụng biến từ bên ngoài vào trong hàm
        extract($variables);
        //bắt đầu nhớ mọi nội dung kể từ khi khai báo, kiểu như lưu vào bộ nhớ tạm
        ob_start();
        //thông thường nếu ko có ob_start thì sẽ hiển thị 1 dòng echo lên màn hình
        //tuy nhiên do dùng ob_Start nên nội dung của nó đã đc lưu lại, chứ ko hiển thị ra màn hình nữa
        require_once $file;
        //lấy dữ liệu từ bộ nhớ tạm đã lưu khi gọi hàm ob_Start để xử lý, lấy xong rồi xóa luôn dữ liệu đó
        $render_view = ob_get_clean();

        return $render_view;
    }

    public function login()
    {
        //nếu user đã đăngn hập r thì ko cho truy cập lại trang login, mà chuenr hướng tới backend
        if (isset($_SESSION['user'])) {
            $_SESSION['success'] = "bạn đã đăng nhập rồi";
            header('Location: index.php?controller=category&action=index');
            exit();
        }

        if (isset($_POST['submit'])) {
//            die;
            $username = $_POST['username'];
            //do password đang lưu trong CSDL sử dụng cơ chế mã hóa md5 nên cần phải thêm
//            hàm md5 cho password
            $password = md5($_POST['password']);
            //validate
            if (empty($username) || empty($password)) {
                $this->error = 'Username hoặc password không được để trống';
            }
            $user_model = new User();
            if (empty($this->error)) {
                $user = $user_model->getUserByUsernameAndPassword($username, $password);
                if (empty($user)) {
                    $this->error = 'Sai username hoặc password';
                } else {
                    $_SESSION['success'] = 'Đăng nhập thành công';
                    //tạo session user để xác định user nào đang login
                    $_SESSION['user'] = $user;
                    header("Location: index.php?controller=dashboard&action=index");
                    exit();
                }
            }
        }
        $this->content = $this->render('views/users/login.php');

        require_once 'views/layouts/main_login.php';
    }

    /**
     * Đăng ký tài khoản mới, mặc định tất cả các user đều có quyền admin
     */
    public function register()
    {
        if (isset($_SESSION['user'])) {
            $_SESSION['success'] = "bạn đã đăng nhập rồi";
            header("Location: index.php?controller=dashboard&action=index");
            exit();
        }

        if (isset($_POST['submit'])) {
            $user_model = new User();
            $username = $_POST['username'];
            $password = $_POST['password'];
            $cf_password = $_POST['cf_password'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $user = $user_model->getUserByUsername($username);

            //check validate
            if (empty($username) || empty($password) || empty($cf_password) || empty($lastname) || empty($firstname) || empty($email)) {
                $this->error = 'Không được để trống các trường';
            } else if ($password != $cf_password) {
                $this->error = 'Password nhập lại chưa đúng';
            } else if (!empty($user)) {
                $this->error = 'Username này đã tồn tại';
            } else if (!empty($email)) {

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->error = "email không đúng định dạng vui lòng nhập lại";
                } else {
                    $email_cf = $user_model->checkUserEmail($email);
                    if (!empty($email_cf)) {
                        $this->error = "email đã tồn tại vui lòng nhập lại";
                    }
                }
            }
            //xử lý lưu dữ liệu khi không có lỗi
            if (empty($this->error)) {

                $user_model->username = $username;
                $user_model->password = md5($password);
                $user_model->first_name = $firstname;
                $user_model->last_name = $lastname;
                $user_model->email = $email;
                $user_model->status = 1;
                $is_insert = $user_model->insertRegister();
                if ($is_insert) {
                    $_SESSION['success'] = 'Đăng ký thành công';
                } else {
                    $_SESSION['error'] = 'Đăng ký thất bại';
                }
                header('Location: index.php?controller=login&action=login');
                exit();
            }
        }

        $this->content = $this->render('views/users/register.php');
        require_once 'views/layouts/main_login.php';
    }
}