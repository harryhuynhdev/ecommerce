<style>
    .box-cart {
        width: 1180px;
        height: 100vh;
        margin: 0 auto;
        background-color: white;
        display: flex;
        justify-content: space-between;
        margin-bottom: 50px;
    }

    .box-cart__left {
        width: 48%;

    }
    .box-cart__left h3{
        font-weight: 500;
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

    .box-pay {
        width: 45%;
        display: flex;
        flex-direction: column;

    }
    .box-pay h3{
        font-weight: 500;
    }

    .back-buy {
        width: 200px;
        height: 50px;
        background-color: #e6872d;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
        /* border-radius: 15px; */
        margin-bottom: 10px;
    }

    .back-buy a {
        color: white;
        font-size: 1rem;
        text-decoration: none;
    }
    /* .pay-form{
        display: flex;
    } */
    .pay-form input {
        width: 95%;
        margin-bottom: 10px;
        height: 30px;
    }

    .pay-form__method {
        margin-bottom: 10px;
        display: flex;
        /* flex-direction: column; */
        width: 100%;
        /* justify-content: space-between; */
    }
    .pay-form__method div{
        display: flex;
        width: 100%;
    }

    .pay-form__method div input{
        
        width: 30px;
        height: 30px;
        margin: 5px;
    }
    .btn-buy {
        width: 150px;
        height: 40px;
        background-color: #e6872d;
        outline: none;
        border: 0;
        color: white;
        font-size: 14px;
        margin-top: 10px;
        cursor: pointer;
    }
</style>
<body style="background-color: white;"> 
<section class="box-cart">
    <div class="box-cart__left">
        <h3>Đơn hàng</h3>
        <form action="index.php?act=okcard" method="post">
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
        <h3>Tổng số tiền</h3>
        <?php echo number_format($total_price) ?>VNĐ
        <input type="hidden" name="price_total" value="<?=$total_price?>">
        <div class="back-buy"><a href="index.php?act=detail">Tiếp tục mua hàng</a></div>

    </div>

    <div class="box-pay">
        <h3>Thông tin khách hàng</h3>
        <div class="pay-form" >
        <?php if(isset($_SESSION['id_user'])&&($_SESSION['id_user']>0)){
            echo '<div class="form-gr">
            <input type="text" name="name" value="'.$_SESSION['name'].'"  required disabled>
            <input type="email" name="email" value="'.$_SESSION['email'].'" required disabled>
            <input type="text" name="address" value="'.$_SESSION['address'].'" required disabled>
            <input type="number" name="mobile_card" value="'.$_SESSION['mobile'].'" required disabled>
        </div>';
        }else{
            echo '<div class="form-gr">
            <input type="text" name="name" placeholder="Họ và Tên" required>
            <input type="type" name="address" placeholder="Địa chỉ" required>
            <input type="text" name="email" placeholder="Email" required>
            <input type="number" name="mobile_card" placeholder="Số điện thoại" required>
        </div>';
        }
        ?>
            
            <span>Địa chỉ khác:</span>
            <input style="width:20px;height:20px" type="checkbox" id="checkorder" onclick="showinfo(this);">
            <div id="inforeceiver">
                <input type="text" name="name1" placeholder="Họ và Tên" >
                <input type="text" name="address1" placeholder="Địa chỉ" >
                <input type="text" name="email1" placeholder="Email" >
                <input type="number" name="mobile1" placeholder="Số điện thoại" >
            </div>
            <br>
            <label>Phương thức giao máy</label>
            <div class="pay-form__method">
           
                <div>
                <input type="radio" name="shipping_method" value="1" checked>
                <p>Nhận máy ở cửa hàng</p>
                </div>
                <div>
                <input type="radio" name="shipping_method" value="2" >
                <p>Giao máy tại nhà</p>
                </div>
                

            </div>
            <!-- <h3>Đơn hàng của bạn</h3>
            <table>
                <tr>
                    <td>Sản phẩm</td>
                    <td>Số tiền</td>
                    <td>Tổng cộng</td>
                </tr>
                <tr>
                    <td>Samsung</td>
                    <td>500000</td>
                    <td>500000</td>
                </tr>
            </table> -->
            <input class="btn-buy" type="submit" value="Đặt hàng"></input>
            
        </form>
    </div>
</section>  

<script type="text/javascript">
    document.getElementById('inforeceiver').style.display="none";

    function showinfo(x){
        if(x.checked ==true){
            document.getElementById('inforeceiver').style.display="block";
        }else{
            document.getElementById('inforeceiver').style.display="none";

        }
    }

</script>