<style>
  
  .product{
  width: 1180px;
  margin: 0 auto;
  background-color: white;
  height: 100vh;
}
  .product-list1 h4{
  font-size: 20px;
  margin-block-end: 0;
  margin-block-start: 0;
  text-decoration: none;
  color: black;
  font-weight: 500;
  margin-left: 10px;
}
.product-list{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  text-decoration: none;
  list-style: none;
  padding-inline-start: 0;
}
.product-list1{
  width: 24%;
  height: 450px;
  position: relative;
  overflow: hidden;
  border: 1px solid #ddd;
  border-radius: 5px;

  text-decoration: none;
}
.product-list1 a{
  text-decoration: none;
}
.product-list1 strong{
  text-decoration: none;
  color: black;
  font-style: 14px;
  margin-left: 10px;

}
.product-list1 p{
  margin-left: 10px;
  margin-right: 10px;
  
}
.product-list1 a img{
  text-align: center;
  margin: 50px;
  
  
}
</style>
<h3></h3>
<body style="background-color: white;">
<section class="product" >

  <ul class="product-list">

    <?php foreach ($listpro as $product) {
      $linkdetail = "index.php?act=detail&id_product=" . $product['id_product'];
      echo '<li class="product-list1">
              <a href="' . $linkdetail . '"> <img width="180" height="180"
                  src="upload/' . $product['image'] . '" alt="">
                <!-- <label class="price-promotion">Giảm giá 500.000Đ</label> -->
                <h4>' . $product['name'] . '</h4>
                <strong>' . number_format($product['price'], 0, ',', '.') . ' VND</strong>
                <span>8.300.000 VND</span>
                <p>Tặng hai xuất mua đồng hồ thời trang giảm 40%(Không áp dụng trên khuyến mãi khác).</p>
              </a>
            </li>';
    }
    ?>

  </ul>
  <div class="pagination">
    <?=$paginate?>
  </div>
  <?= '<pre>';
  // print_r($listpro);
  '</pre>'; ?>
</section>