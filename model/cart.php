<?php

function addtocart($id_product, $quantity){
    $sql="select * from product where 1";
    if($id_product>0){
        $sql.=" and id_product='".$id_product."'";
    }
    $conn = connectdb();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
    return $result;

    if(isset($_SESSION['cartview']['id_product'])){
        $quantity += $_SESSION['cartview'][$id_product]['qty'];
        update_item($id_product,$quantity);
        return;
    }
    
}
function insertcart($name, $email, $address, $mobile_card, $shipping_method, $price_total){
    $sql="insert into card (name,email,address,mobile_card,shipping_method,status,price_total) values ('$name','$email','$address','$mobile_card','$shipping_method','1','$price_total')";
    $conn = connectdb();
    $conn->exec($sql);
}
function insertdetailcard($namepro,$quantity,$price_total){
    $sql="insert into detail_card (name,quantity,price_total) values ('$namepro','$quantity','$price_total')";
    $conn = connectdb();
    $conn->exec($sql);
}
// function updatestatus($id_card){
//     $sql="update card set status=1 where id=".$id_card;
//     $conn = connectdb();
//     $conn->exec($sql);
// }