
<?php
session_start();
$quantity = $_POST['quantity'];
$loc = $_POST['loc'];
$output="";
if ($quantity > 0) {
    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
        if ($i == $loc) {
            array_splice($_SESSION['cart'][$i], 4, 1, $quantity);
            break;
        }
    }
}
$total_price = 0;
for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
    $id_product = $_SESSION['cart'][$i][0];
    $price = $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][4];
    $money = number_format($price);
    $total_price += $price;
    $del = "<a href='index.php?act=viewcart&del=" . $i . "'><i class='fa fa-times' aria-hidden='true'></i>";
    $output.= '<tr>
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
$output.=  "<tr><td colspan='6'>" . number_format($total_price) . " VNĐ</tr></td>";

echo $output;

?>

<script> 
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