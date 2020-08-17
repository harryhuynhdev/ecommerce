<style>
    .confirm-card{
        width: 600px;
        height: 100%;

        margin-top: 50px;
        margin: 0 auto;
        margin-bottom: 50px;
        margin-top: 50px;
        background-color: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
 

    }
    .txt-card{
        font-size: 1rem;
        color: green;
        text-align: center;   
        padding-top: 40px;
        margin-block-end: 0;
        margin-block-start: 0;
    }
    .confirm_title{
        padding: 1rem;
    }
    .tbl-cart {
        border-collapse: collapse;
    }

    .tbl-cart {
        border: 1px solid #ddd;
    }

    .tbl-cart__tr {
        border: 1px solid #ddd;
    }

    .tbl-cart__td {
        border: 1px solid #ddd;
    }
    .btn-confirm{
        width: 250px;
        height: 40px;
        background-color: transparent;
        border-radius: 5px;
        color: #288ad6;
        border: 1px solid #288ad6;
        cursor: pointer;
        margin-top: 30px;
        margin-bottom: 30px;
        text-align: center;
        /* margin: 0 auto; */
        margin-bottom: 20px;
    }
    .box-cart__left h3{
        font-weight: 500;
    }
    
</style>

<body style="background-color: white;">
<section class="confirm-card">
<h3 class="txt-card"><i class="fa fa-check-circle" aria-hidden="true"></i> Đặt hàng thành công</h3>
<form action="index.php?act=okdeal" method="POST">
<div class="confirm_title">
<p>Cảm ơn Quý khách <?php echo $name?> đã cho thegioidienthoai cơ hội phục vụ. Trong 10 phút, nhân viên thegioidienthoai
sẽ gọi lại cho quý khách hoặc tin nhắn xác nhận giao hàng cho quý khách.</p>
<ul class="confirm_list">
    <li>Người nhận:<?php echo $name?></li>
    <li>Số điện thoại:<?= $mobile_card?></li>
    <li>Địa chỉ:<?php echo $address?>.(Nhân viên sẽ gọi xác nhận trước khi giao).</li>
    <li>Phương thức vận chuyển:<?php if($shipping_method==1){
        echo 'Tới của hàng lấy máy';
    }else{
        echo 'Giao máy tại nhà';
    }
    ?></li>
    <li>Tổng tiền<?php echo number_format($price_total)?>VNĐ</li>
</ul>
<div class="box-cart__left">
        <h3>Đơn hàng của bạn</h3>
        
        <?php
        // var_dump($item);
        //     var_dump($_SESSION['cart']);
        if (isset($_SESSION['cart'])) {
            echo '
    <table class="tbl-cart" cellpadding="10" cellspacing="1">
    <tr class="tbl-cart__tr">
    <td class="tbl-cart__td">Tên</td>    
    <td class="tbl-cart__td">Hình</td>    
    <td class="tbl-cart__td">Giá</td>    
    <td class="tbl-cart__td">Số lượng</td>    
    <td class="tbl-cart__td">Thành tiền</td>
       
        </tr><tbody id="cart">';
            // number_format($detail['price'], 0, ',', '.'); 
            $total_price = 0;
            for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                $id_product = $_SESSION['cart'][$i][0];
                $price = $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][4];
                $money = number_format($price);
                $total_price += $price;
                $del = "<a href='index.php?act=viewcart&del=" . $id_product . "'><i class='fa fa-times' aria-hidden='true'></i>";
                echo ' <tr>
            <td class="tbl-cart__td">' . $_SESSION['cart'][$i][1] . '</td>
            <td class="tbl-cart__td"><img src="upload/' . $_SESSION['cart'][$i][3] . '" height="80px"></td>
            <td class="tbl-cart__td">' . number_format($_SESSION['cart'][$i][2]) . ' VNĐ</td>
            <td class="tbl-cart__td">x'.$_SESSION['cart'][$i][4].'</td>
            <td class="tbl-cart__td">' . $money . ' VNĐ</td>
       
        </tr>';
            }
            echo '</tbody></table>';
        }
        ?>
      
       
</div>
<input type="hidden" name="id" value="<?= $id?>">
<input type="submit" class="btn-confirm" value="Xác nhận">
</form>
</section>