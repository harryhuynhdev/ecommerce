<body>
<section class="content-owl">
  <div class="owl-left">
    <div class="owl-one owl-carousel owl-theme" style="height: 300px;">
      <div class="item" data-merge="8" style="height: 280px;">
        <a href="#"><img width="900" height="300" src="https://cdn.tgdd.vn/2020/05/banner/800-300-800x300.gif" alt=""></a>
      </div>
      <div class="item" data-merge="8" style="height: 280px;">
        <a href="#"><img width="900" height="300" src="https://cdn.tgdd.vn/2020/05/banner/800-300-800x300-15.png" alt=""></a>
      </div>
      <div class="item" data-merge="8" style="height: 280px;">
        <a href="#"><img width="900" height="300" src="https://cdn.tgdd.vn/2020/05/banner/800-300-800x300-11.png" alt=""></a>
      </div>
    </div>
    <div class="owl-two owl-carousel">
      <div class="owl__item">
        <p>IP 7 Plus</p>
        <p>đang giảm giá 10%</p>
      </div>
      <div class="owl__item">
        <p>IP 7 Plus</p>
        <p>đang giảm giá 10%</p>
      </div>
      <div class="owl__item">
        <p>IP 7 Plus</p>
        <p>đang giảm giá 10%</p>
      </div>
      <div class="owl__item">
        <p>IP 7 Plus</p>
        <p>đang giảm giá 10%</p>
      </div>
    </div>
  </div>

  <div class="content-right">
    <div class="content-right__title">
      <div class="title__a">Tin Công nghệ</div>
      <div class="title__b">Mobile ProH vừa cập nhật</div>
    </div>
    <div class="content-right__new">
      <ul>
        <li><a href="#"><img width="80" height="57" src="https://cdn.tgdd.vn/Files/2020/05/15/1255676/aag-cable_800x450-100x100.jpg" alt=""></a></li>
        <h4>Lướt facebook thấy mạng chậm là tui nghi quá mà, thì ra là bị cá mặp cắn đứt cáp.</h4>
      </ul>
    </div>
    <div class="two-banner">
      <a href="#"><img width="460" height="110" src="https://cdn.tgdd.vn/2020/05/banner/A71-398-110-398x110.png" alt=""></a>
      <a href="#"><img width="460" height="110" style="margin-top: 10px;" src="https://cdn.tgdd.vn/2020/05/banner/398-110-398x110-1.png" alt=""></a>
    </div>
  </div>
</section>

<section class="banner__list">
  <a href="#"><img width="1180" height="75" src="https://cdn.tgdd.vn/2020/05/banner/1200x75(13)(1)-1200x75.png"></a>
</section>

<div class="owl-main">
  <div class="owl-main__content">
    <h3>Khuyến mãi hot nhất</h3>
    <?php echo var_dump($product) ?>
  </div>
  <div id="demo" class="owl-three weeked owl-carousel">
  
    <?php foreach ($product as $pro) {
      $price = number_format($pro['price']);
      $linkdetail = "index.php?act=detail&id_product=". $pro['id_product'];
      
      echo '  <div class="owl-main__item"> <a href="' . $linkdetail . '">
            <img width="180" height="180"
              src="upload/' . $pro['image'] . '"
              alt="">
            <h5>' . $pro['name'] . '</h5>
            <h4>' . $price . ' VNĐ <span>6.9990.000 VNĐ</span></h4>
            <p>Tặng 2 suất mua Đồng hồ thời trang giảm 40% (không áp dụng thêm khuyến mãi khác)</p>
          </a>  </div>';
    }
    ?>

  </div>
</div>
<section class="main-list">
  <div class="list-type">
    <h3>Điện thoại nỗi bật</h3>
    <div class="list-type__list">
      <a href="#">Điện thoại độc quyền</a>
      <a href="#">IPHONE 11 PROMAX</a>
      <a href="#">REDMID NOTE9S</a>
      <a href="#">SAMSUNG NOTE10</a>
      <a href="#">OPPO A91</a>
      <a href="#">Xem tất cả</a>
    </div>
  </div>
  <ul class="list-itemPro">
    <li class="list-itemPro__first">
      <a href="#">
        <img class="list-itemPro__img" width="600" height="275" src="https://cdn.tgdd.vn/Products/Images/42/217287/Feature/oppo-a91-ft-spec-2-720x333.jpg" alt="">
        <h4>OPPO A91</h4>
        <strong>5.990.000 VNĐ</strong>
        <span>6.990.000 VNĐ</span>
      </a>
    </li>
    
      <?php
      
      foreach ($productHight1 as $pro1) {
        $linkdetail = "index.php?act=detail&id_product=". $pro1['id_product'];
        $price = number_format($pro1['price'], 0, ',', '.');
        $price_promotion = number_format($pro1['price_promotion'], 0, ',', '.');
        echo '
        <li class="list-itemPro__item">
        <a href="'.$linkdetail.'"> <img width="180" height="180"
            src="upload/'.$pro1['image'].'" alt="">
          <label class="price-promotion">Giảm giá 500.000Đ</label>
          <h4>'.$pro1['name'].'</h4>
          <strong>'.$price.' VND</strong>
          <span>'.$price_promotion.'</span>
          <p>Tặng hai xuất mua đồng hồ thời trang giảm 40%(Không áp dụng trên khuyến mãi khác).</p>
        </a>
        </li>'
        ;
      }
      ?>



  </ul>
  <ul class="list-itemPro">
    <li class="list-itemPro__first">
      <a href="#">
        <img class="list-itemPro__img" width="600" height="275" src="https://cdn.tgdd.vn/Products/Images/42/220649/Feature/oppo-a52-spec-720x333.jpg" alt="">
        <h4>OPPO A91</h4>
        <strong>5.990.000 VNĐ</strong>
        <span>6.990.000 VNĐ</span>
      </a>
    </li>
    <?php 
      foreach($productHight2 as $pro2){
        $linkdetail = "index.php?act=detail&id_product=". $pro2['id_product'];
        $price = number_format($pro2['price'], 0, ',', '.');
        $price_promotion = number_format($pro2['price_promotion'], 0, ',', '.');
        echo ' <li class="list-itemPro__item">
        <a href="'.$linkdetail.'"> <img width="180" height="180" src="upload/'.$pro2['image'].'" alt="">
          <h4>'.$pro2['name'].'</h4>
          <strong>'.$price.' VND</strong>
          <span>'.$price_promotion.'</span>
          <p>Tặng hai xuất mua đồng hồ thời trang giảm 40%(Không áp dụng trên khuyến mãi khác).</p>
        </a>
  
      </li>';
      }
    
    ?>
   
    
  </ul>
</section>