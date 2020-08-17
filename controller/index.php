<?php

use function Symfony\Component\VarDumper\Dumper\esc;

include_once "./model/connect.php";

include_once "./model/category.php";
include_once "./model/product.php";

include_once "./model/user.php";
include_once "./model/commnet.php";
include_once "./model/cart.php";
include_once "./model/mail.php";
require_once "./view/sendmail.php";

include_once "./global.php";
include_once "./stoge/PHPMailer-master/src/Exception.php";
include_once "./stoge/PHPMailer-master/src/OAuth.php";
include_once "./stoge/PHPMailer-master/src/PHPMailer.php";
include_once "./stoge/PHPMailer-master/src/POP3.php";
include_once "./stoge/PHPMailer-master/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$category = loadcategory();

include_once "view/header.php";

$product = loadproduct();

$productHight1 = loadproductHight1();
$productHight2 = loadproductHight2();

if (isset($_GET['act'])) {
    switch ($_GET['act']) {
        case 'product':
            if (isset($_GET['id_category'])) {
                $idcate = $_GET['id_category'];
            } else {
                $idcate = 0;
            }
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $listpro = loadproductpage($idcate, $page);
            $paginate = loadnav($idcate, $page);

            include_once "view/product.php";
            break;
        case 'about':
            include_once "view/about.php";
            break;
        case 'allproduct':
            if (isset($_GET['id_product'])) {
                $id_product = $_GET['id_product'];
            } else {
                $id_product = 0;
            }
            $listproall = loadproductall($id_product);
            $filter = filter_data();
            include_once "view/allproduct.php";
            break;
        case 'detail':
            if (isset($_GET['id_product'])) {
                $id_product = $_GET['id_product'];
            } else {
                $id_product = 0;
            }
            $detail = loaddetail($id_product);
            $listcmt = loadcmt($id_product);
            if (isset($_POST['sendcomment']) && $_POST['sendcomment']) {
                $id_product = $_POST['id_product'];
                $id_user = $_POST['id_user'];
                $comment = $_POST['comment'];
                $name = $_POST['name'];
                $date = date('Y-m-d');
                insertcmt($id_product, $id_user, $comment, $name, $date);
            }
            include_once "view/detail.php";
            break;
        case 'login':
            if (isset($_SESSION['id_user'])) {
                header('location: index.php');
            }
            if (isset($_POST['login']) && $_POST['login']) {
                $email = $_POST['email'];
                $password = $_POST['pass'];
                // if(password_verify($password, ))
                $info = checkuser($email, $password);

                if (count($info) > 0) {

                    $_SESSION['name'] = $info['name'];
                    $_SESSION['id_user'] = $info['id_user'];
                    $_SESSION['mobile'] = $info['mobile'];
                    $_SESSION['email'] = $info['email'];
                    $_SESSION['address'] = $info['address'];
                    $_SESSION['id_role'] = $info['id_role'];
                    if ($info['id_role'] == 1) {
                        header('Location: admin.php?act=dashboar');
                    } else {
                        header('Location: index.php');
                    }
                } else {
                    header('Location: index.php');
                }
            }
            include_once "view/login.php";
            break;
        case 'logout':
            unset($_SESSION['id_user']);
            unset($_SESSION['pass']);
            unset($_SESSION['email']);
            unset($_SESSION['id_role']);
            header('Location: index.php?act=login');
            break;
        case 'regiter':
            if (isset($_POST['regiter']) && $_POST['regiter']) {
                $name = $_POST['name'];
                $mobile = $_POST['mobile'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $_SESSION['email'] = $email;
                $_SESSION['pass'] = $pass;
                register($name, $mobile,$address, $pass, $email);
                header('Location: index.php?act=login');
            }
            include_once "view/regiter.php";
            break;

        case 'unset':
            unset($_SESSION['id_product']);
            unset($_SESSION['name']);
            unset($_SESSION['price']);
            unset($_SESSION['image']);
            header('Location: index.php?act=cart');
            break;
        case 'cart':

            include_once 'view/cart.php';
            break;

        case 'viewcart':
            if (isset($_GET['delall']) && $_GET['delall'] == 1) {
                $_SESSION['cart'] = null;
            }
            if (isset($_GET['del']) && $_GET['del'] >= 0) {
                array_splice($_SESSION['cart'], $_GET['del'], 1);
            }
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            } else {
                if (isset($_POST['submit']) && $_POST['submit']) {
                    $id_product = $_POST['id_product'];
                    $name = $_POST['name'];
                    $price = $_POST['price'];
                    $image = $_POST['image'];
                    $quantity = 1;

                    $loc = 0;
                    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                        if ($_SESSION['cart'][$i][0] == $id_product) {
                            $loc = $i + 1;
                            $loc_quantity = $_SESSION['cart'][$i][4];
                            break;
                        }
                    }
                    if ($loc > 0) {
                        $quantity_new = $loc_quantity + $quantity;
                        $_SESSION['cart'][$loc - 1][4] = $quantity_new;
                    } else {
                        $item = [$id_product, $name, $price, $image, $quantity];
                        $_SESSION['cart'][] = $item;
                    }
                }
            }
            include_once 'view/viewcart.php';
            break;
        case 'okcard':
            if (isset($_SESSION['name']) && ($_SESSION['name'] != "")) $name = $_SESSION['name'];
            if (isset($_SESSION['email']) && ($_SESSION['email'] != "")) $email = $_SESSION['email'];
            if (isset($_SESSION['mobile']) && ($_SESSION['mobile'] != "")) $mobile_card = $_SESSION['mobile'];
            if (isset($_SESSION['address']) && ($_SESSION['address'] != "")) $address = $_SESSION['address'];

            if (isset($_POST['name']) && ($_POST['name'] != "")) $name = $_POST['name'];
            if (isset($_POST['email']) && ($_POST['email'] != "")) $email = $_POST['email'];
            if (isset($_POST['address']) && ($_POST['address'] != "")) $address = $_POST['address'];
            if (isset($_POST['mobile_card']) && ($_POST['mobile_card'] != "")) $mobile_card = $_POST['mobile_card'];
            if (isset($_POST['shipping_method']) && ($_POST['shipping_method'] != "")) $shipping_method = $_POST['shipping_method'];
            if (isset($_POST['price_total']) && ($_POST['price_total'] != "")) $price_total = $_POST['price_total'];

            // if($shipping_method == 1){
            //     echo $ship1 = 'Tới của hàng nhận máy';
            // }else{
            //     echo $ship2 = 'Nhận hàng rồi mới giao tiền';
            // }

            insertcart($name, $email, $address, $mobile_card, $shipping_method, $price_total);
            // var_dump($name,$email,$address,$mobile_card,$shipping_method,$price_total);
            for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                $namepro = $_SESSION['cart'][$i][1];
                $quantity = $_SESSION['cart'][$i][4];
                $price_total = $_SESSION['cart'][$i][2];

                insertdetailcard($namepro, $quantity, $price_total);
            }


            include_once "view/cardconfirm.php";
            break;
        case 'okdeal':
            // $id_card=$_POST['id_card'];
            // updatestatus($id);
            // var_dump($id_card);
            if (isset($_SESSION['cart'])) unset($_SESSION['cart']);
            if (isset($_SESSION['shipping'])) unset($_SESSION['shipping']);

            // sendmail
            $mail = new PHPMailer(true);
            $info = sendmail();
            $detail_mail = maildetail();
         
            $address = $info['address'];
           
            $email = $info['email'];
            $ship = $info['shipping_method'];
            $name_detail = $detail_mail['name'];
            $quantity_detail = $detail_mail['quantity'];
            $price_detail = $detail_mail['price_total'];
            $name = $info['name'];
            $mobile_card = $info['mobile_card'];
            // $teamplate = ('view/sendmail.php');
            $body = sendmail1($name,$mobile_card,$quantity_detail ,$price_detail, $name_detail, $address);
            try {
                //Server settings
                $mail->SMTPDebug = 2;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'huykhai.sida@gmail.com';                     // SMTP username
                $mail->Password   = 'v2c47mk7jd3r89f';                               // SMTP password
                $mail->SMTPSecure = "tls";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->CharSet     = 'UTF-8';
                //Recipients
                $mail->setFrom('huykhai.sida@gmail.com', 'Thegioidienthoai');
                $mail->addAddress(''.$email.'', 'hi');     // Add a recipient
                // $mail->addAddress('ellen@example.com');               // Name is optional
                // $mail->addReplyTo('', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Đặt hàng thành công';
                $mail->Body    =  $body;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            // echo $infomail["price_total"];
            // echo $infomail['email'];
            // header('Location: index.php');



            header('Location: index.php');
        
            break;
    }
} else {
    include_once "view/home.php";
}

include_once "view/footer.php";
