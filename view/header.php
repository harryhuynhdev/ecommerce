<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thegioidienthoai</title>
  <link rel="stylesheet" href="view/css/main.css">
  <link rel="stylesheet" href="view/css/detail.css">
  
  <!-- <link rel="stylesheet" href="css/setting.css">
  <link rel="stylesheet" href="css/reset.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="view/owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="view/owlcarousel/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="view/css/jquery-ui.css">
  <!-- <link rel="stylesheet" href="view/cart.css"> -->
  <!-- <script src="view/js/jquery-3.5.1.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="view/owlcarousel/owl.carousel.min.js"></script>

</head>


  <div class="main">
    <div class="warp-main">
      <a href="http://localhost:81/ProjectH/" class="logo-main"><img src="view/img/logo.png" alt=""></a>
      <form class="form-main" action="#" autocomplete="off">
        <input class="input-main" type="text" placeholder="Bạn muốn tìm...">
        <button class="btn-main" type="submit">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </form>
      <nav class="menu">
      <?php foreach($category as $cate){
        $linkcate = "index.php?act=product&id_category=".$cate['id_category'];
          echo '<a href="'.$linkcate.'">
          <i class="fa fa-mobile" aria-hidden="true"></i>
          <p>'.$cate['name'].'</p>
        </a>';
      }
      ?>
      </nav>
      <div class="main-service">
        <a href="index.php?act=allproduct"> 
          Tất cả sản Phẩm
        </a>
        <?php 
        if(isset($_SESSION['id_user'])&& ($_SESSION['id_role'] == 2) && ($_SESSION['id_user']>0)){
          echo '<a href="index.php?act=info">'.$_SESSION['name'].'</a>
          <a href="index.php?act=logout">Đăng xuất</a>
          ';
        }else {
          echo  '<a href="index.php?act=regiter">Đăng ký</a>
          <a href="index.php?act=login">Đăng nhập</a>';
        }
     ?>
       
      </div>
      <a class="cart" href="index.php?act=viewcart">
        <i class="fa fa-cart-arrow-down fa-2x" aria-hidden="true"></i>
      </a>
    </div>

  </div>
 