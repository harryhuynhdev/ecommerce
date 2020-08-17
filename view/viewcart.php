<style>
    .box-cart{
        width: 1180px;
        height: 100vh;
        margin: 0 auto;
    }
    .tbl-cart1 {
        border-collapse: collapse;
        width: 100%;
    }

    .tbl-cart1 {
        border: 1px solid #ddd;
    }

    .tbl-cart__tr1 {
        border: 1px solid #ddd;
    }

    .tbl-cart__td1 {
        border: 1px solid #ddd;
    }
    .cf-cart{
        background-color: #F73E80;
        width: 200px;
        height: 50px;
        color: white;
        font-weight: 500;
        font-style: 18px;
        border-radius: 10px;
       
        /* text-align: center; */
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;

    }
    .cf-cart a{
        text-decoration: none;
        color: white;
    }
    .box-cart__main{
        display: flex;
        justify-content: center;
        flex-direction: column;
    }
    .tile-cart{
        margin-left: 10px;
        font-size: 20px;
        font-weight: 500;
    }
    .quantity {
  position: relative;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button
{
  -webkit-appearance: none;
  margin: 0;
}

input[type=number]
{
  -moz-appearance: textfield;
}

.quantity input {
  width: 45px;
  height: 42px;
  line-height: 1.65;
  float: left;
  display: block;
  padding: 0;
  margin: 0;
  padding-left: 20px;
  border: 1px solid #eee;
}

.quantity input:focus {
  outline: 0;
}

.quantity-nav {
  float: left;
  position: relative;
  height: 42px;
}

.quantity-button {
  position: relative;
  cursor: pointer;
  border-left: 1px solid #eee;
  width: 20px;
  text-align: center;
  color: #333;
  font-size: 13px;
  font-family: "Trebuchet MS", Helvetica, sans-serif !important;
  line-height: 1.7;
  -webkit-transform: translateX(-100%);
  transform: translateX(-100%);
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
}

.quantity-button.quantity-up {
  position: absolute;
  height: 50%;
  top: 0;
  border-bottom: 1px solid #eee;
}

.quantity-button.quantity-down {
  position: absolute;
  bottom: -1px;
  height: 50%;
}
.cart-empty{
  margin-block-start: 0;
  margin-block-end: 0;
  margin-top: 10px;
  color:red;
 
  
}
</style>
<body style="background-color: white;">
    
<section class="box-cart">
   
    <div class="box-cart__main">
    <h3 class="tile-cart">Giỏ hàng của bạn</h3>
<?php
// var_dump($item);
//     var_dump($_SESSION['cart']);
if(isset($_SESSION['cart'])){
    echo '
    <table class="tbl-cart1" cellpadding="10" cellspacing="1">
    <tr class="tbl-cart__tr1">
    <td class="tbl-cart__td1">Tên</td>    
    <td class="tbl-cart__td1">Hình</td>    
    <td class="tbl-cart__td1">Giá</td>    
    <td class="tbl-cart__td1">Số lượng</td>    
    <td class="tbl-cart__td1">Thành tiền</td>
    <td class="tbl-cart__td1"></td>    
        </tr><tbody id="cart">';
            // number_format($detail['price'], 0, ',', '.'); 
            $total_price = 0;
            for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
                $id_product = $_SESSION['cart'][$i][0];
                $price = $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][4];
                $money = number_format($price);
                $total_price += $price;
                $del = "<a href='index.php?act=viewcart&del=".$i."'><i class='fa fa-times' aria-hidden='true'></i>";
                echo ' <tr>
            <td class="tbl-cart__td1">' . $_SESSION['cart'][$i][1] . '</td>
            <td class="tbl-cart__td1"><img src="upload/' . $_SESSION['cart'][$i][3] . '" height="80px"></td>
            <td class="tbl-cart__td1">' . number_format($_SESSION['cart'][$i][2]) . ' VNĐ</td>
            <td class="tbl-cart__td1"><div class="quantity">
            <input type="number" onchange="handling(this,'.$i.')" min="1" max="9" step="1" value="'. $_SESSION['cart'][$i][4].'">
          </div></td>
            <td class="tbl-cart__td1">' . $money . ' VNĐ</td>
            <td class="tbl-cart__td1">' . $del . '</td>
        </tr>';
            }
            echo "<tr><td colspan='6'>".number_format($total_price)." VNĐ</tr></td>";
            echo '</tbody></table>';
            if(empty($_SESSION['cart'])){
              echo '<h3 class="cart-empty">Giỏ hàng của bạn đang trống</h3>';
            }else{
              echo '<div class="cf-cart">
              <a href="index.php?act=cart">Xác nhận đơn hàng</a>
              </div>
              </div>';
            }
        }
        ?>
       
</section>

<script type="text/javascript">
    function handling(quantity,loc){
        $.post("handling.php",{
            quantity: quantity.value,
            loc: loc
        },function(result){
           $("#cart").html(result);     
        });
    }

    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });
</script>