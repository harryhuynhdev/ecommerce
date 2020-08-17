<?php
include_once "./model/connect.php";
include_once "./model/categorydb.php";
include_once "./view/admin/header.php";
include_once "./model/dashboar.php";
$listcate = getList();
if ($_SESSION['id_role'] == 1) {
    if (isset($_GET['act'])) {
        switch ($_GET['act']) {
            case 'dashboar':
                $quantity_pro = dataproduct();
                $price = dataprice();
                $card = datacard();
                $price_today = data_date();
                include_once "view/admin/dashboar.php";
                break;
            case 'category':
                if (isset($_POST['name'])) {
                    $name =  $_POST['name'];
                    $staus =  $_POST['status'];
                    addCate($name, $staus);
                }
                include_once "view/admin/listcate.php";
                break;
            case 'product':


                include_once "view/admin/listproduct.php";
                break;
            case 'logout':
                unset($_SESSION['id_user']);
                unset($_SESSION['pass']);
                unset($_SESSION['email']);
                unset($_SESSION['id_role']);
                header('Location: index.php?act=login');

                break;
            case 'cart':


                include_once "view/admin/listcart.php";
                break;
        }
    } else {
        include_once '../view/admin/home.php';
    }
}else{
    header('location: index.php');
}

include_once "./view/admin/footer.php";
