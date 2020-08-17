<?php
$servername = "localhost";
$username = 'root';
$password = '';
$conn = new PDO("mysql:host=$servername;dbname=mobile", $username, $password);
if (isset($_POST['action'])) {
    $query = "select * from product where status = '1'";
    if (isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])) {
        $query .= "
          AND price BETWEEN '" . $_POST["minimum_price"] . "' AND '" . $_POST["maximum_price"] . "'
         ";
    }
    if (isset($_POST["brand"])) {
        $brand_filter = implode("','", $_POST["brand"]);
        $query .= "
   AND product.id_category IN('" . $brand_filter . "')
  ";
    }
    // $conn = connectdb();
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output = '';
    if($total_row>0){
        foreach($result as $product){
            $linkdetail = "index.php?act=detail&id_product=" . $product['id_product'];
            $output .='
            <li class="product-list1">
            <a href="' . $linkdetail . '"> <img width="180" height="180"
                src="upload/' . $product['image'] . '" alt="">
              <!-- <label class="price-promotion">Giảm giá 500.000Đ</label> -->
              <h4>' . $product['name'] . '</h4>
              <strong>' . number_format($product['price'], 0, ',', '.') . ' VND</strong>
              <p>Tặng hai xuất mua đồng hồ thời trang giảm 40%(Không áp dụng trên khuyến mãi khác).</p>
            </a>
          </li>
            ';
        }
    } else
    {
     $output = '<h3>Không có dữ liệu</h3>';
    }
    echo $output;    
}
