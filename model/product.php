<?php
function loadproduct()
{
    $conn = connectdb();
    $sql = "select * from product where status='1' and type='1'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function loadproductHight1()
{
    $conn = connectdb();
    $sql = "SELECT * FROM `product` WHERE status='1' AND type = '1' ORDER BY id_product ASC LIMIT 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function loadproductHight2()
{
    $conn = connectdb();
    $sql = "SELECT * FROM `product` WHERE status='1' AND type = '1' ORDER BY id_product DESC LIMIT 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $result;
}

function loaddetail($id_product)
{
    $conn = connectdb();
    $sql = "select * from product where status='1'";
    if ($id_product > 0) {
        $sql .= " AND id_product=" . $id_product;
    }
    // $sql.=" order by id_product desc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
    return $result;
}
function loadproductcate($idcate, $limit)
{
    $conn = connectdb();
    $sql = "select * from product where status='1'";
    if ($idcate > 0) {
        $sql .= " AND id_product=" . $idcate;
    }
    $sql .= " order by id_product desc";
    if ($limit > 0) {
        $sql .= " limit " . $limit;
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
    return $result;
}
function loadproductpage($id_category, $page)
{
    global $allproduct;
    if ($page<1) {
        $take = 0;
    } else {
        $take = ($page - 1) * $allproduct;
    }
    $get = $allproduct;
    $conn = connectdb();
    $sql = "select * from product where status='1'";
    if ($id_category > 0) {
        $sql .= " AND id_category=" . $id_category;
    }

    $sql .= " order by id_product desc";
    $sql .= " limit " . $take . "," . $get;
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}
function loadnav($idcate, $page)
{
    global $allproduct;
    $totalproduct = getTotalProduct($idcate);
    $numberpage = ceil($totalproduct / $allproduct);
    $loadnav = "";
    for ($i = 1; $i <= $numberpage; $i++) {
        $linkpage = "index.php?act=product&id_category=" . $idcate . "&page=" . $i;
        if ($i == $page) {
            $loadnav .= '<a class="active disabled"><span>' . $i . '</span></a>';
        } else {
            $loadnav .= '<a href="' . $linkpage . '">' . $i . '</a>';
        }
    }
    return $loadnav;
}
function loadproductall() // cái này là load tất cả sản phẩm, a anh ngu, tạo thêm cái page nữa @@. sida thiệc hì
{
    $conn = connectdb();
    $sql = "select * from product where status='1'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}
function getTotalProduct($id_category)
{
    $conn = connectdb();
    $sql = "select count(*) from product where status='1'";
    if ($id_category) {
        $sql .= "AND id_category = $id_category";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result[0];
}
// từ từ ông nội

function filter_data(){
    $conn = connectdb();
    // $sql = "SELECT product.id_product,category.name FROM product INNER JOIN category on product.id_category = category.id_category";
    $sql = "SELECT category.name as name, category.id_category as id FROM category where status ='1'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;
}