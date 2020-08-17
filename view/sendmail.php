
<?php 
function sendmail1($name,$mobile_card,$quantity_detail ,$price_detail, $name_detail, $address){ 
?>
    <style>
    tbody{
        border-collapse: collapse;
        border: 1px solid #ddd;
    }
</style>
<?php $output = "
<h4>Xác nhận đơn hàng</h4>
<p>Kính chào quý khách ".$name." đã tin tưởng thế giới điện thoại và cho chúng tôi phục vụ quý khách    
</p>
<p>Địa chỉ và số điện thoại quý khách: ".$address.",". $mobile_card."</p>
<h4>Chi tiết đơn hàng</h4>
<tbody>
    <table>
        <tr>
            <td>Tên sản phẩm</td>
            <td>Số lượng</td>
            <td>Giá</td>
        </tr>
        <tr>
            <td>".$name_detail."</td>
            <td>".$quantity_detail."</td>
            <td>".$price_detail."</td>
        </tr>
    </table>
</tbody>
";
return $output;
}?>