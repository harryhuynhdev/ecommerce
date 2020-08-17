<?php
$servername = "localhost";
$username = 'root';
$password = '';
$conn = new PDO("mysql:host=$servername;dbname=mobile", $username, $password);
$output ='';
if (isset($_POST['query'])){
    $name = $_POST['query'];
    $status = $_POST['query'];
    $status1 = '';
    if($status == 1){
        $status1 = 'Chưa xác nhận';
    }else{
        $status1 = 'Đã xác nhận';
    }
    
    $results = $conn->prepare("select * from card where name LIKE '&".$name."&'
            OR email LIKE '%".$name."%' OR address LIKE '%".$name."%'
            OR mobile_card LIKE '%".$name."%' OR shipping_method LIKE '%".$name."%'
            OR status LIKE '%".$status1."%'  
    ");
}else{
    $results = $conn->prepare("SELECT * FROM card ORDER BY id_card Desc");
   
}
$results->execute();
// if(count($results) > 0){
    
// }
    $output .= '
    <table class="table table-bordered">
    <tr>
    <th width="10%">#</th>
     <th width="10%">Tên khách hàng</th>
     <th width="10%">Email</th>
     <th width="20%">Địa chỉ</th>
     <th width="10%">Số điện thoại</th>
     <th width="10%">Phương thức vận chuyển</th>
     <th width="10%">Trạng thái đơn hàng</th>
     <th width="10%">Tổng tiền</th>
     <th width="10%" colspan="2">Thao tác</th>
    </tr>
    ';
    while($list = $results->fetch(PDO::FETCH_ASSOC)){
        $status = '';
        if($list['status'] == 1){
            $status = '<button type="button" class="btn btn-danger">Chưa xác nhận</button>';
        }else{
            $status = '<button type="button" class="btn btn-success">Đã xác nhận</button>';
        }
        $ship = '';
        if($list['shipping_method'] == 1){
            $ship = '<button type="button" class="btn btn-danger">Nhận tại cửa hàng</button>';
        }else{
            $ship = '<button type="button" class="btn btn-success">Giao tại nhà</button>';
        }
        $output .= '
        <tr>
        <td>' . $list["id_card"] . '</td>
         <td>' . $list["name"] . '</td>
         <td>' . $list['email'] . '</td>
         <td>' . $list['address'] . '</td>
         <td>' . $list['mobile_card'] . '</td>
         <td>' .  $ship  . '</td>
         <td>' .  $status. '</td>
         <td>' . $list['price_total'] . '</td>
         <td><button id="edit_btn" type="button" edit="' . $list["id_card"] . '" class="btn btn-warning btn-xs update">Sửa</button></td>
         <td><button id="delete_btn" type="button" delete_data="' . $list["id_card"] . '" class="btn btn-danger btn-xs delete">Xoá</button></td>
        </tr>
        ';
    }
    echo $output;


//     if ($_POST['action'] == 'Listcart') {
//         $statement = $conn->prepare();
//         $statement->execute();
//         $result = $statement->fetchAll();
//         // var_dump($result);
//         $out = '';
//         $out .= '
//             <table class="table table-bordered">
//             <tr>
//             <th width="10%">#</th>
//              <th width="10%">Tên khách hàng</th>
//              <th width="10%">Email</th>
//              <th width="20%">Địa chỉ</th>
//              <th width="10%">Số điện thoại</th>
//              <th width="10%">Phương thức vận chuyển</th>
//              <th width="10%">Trạng thái đơn hàng</th>
//              <th width="10%">Tổng tiền</th>
//              <th width="10%" colspan="2">Thao tác</th>
//             </tr>
//             ';
//         if ($statement->rowCount() > 0) {
//             foreach ($result as $list) {
//                 $status = '';
//                 if($list['status'] == 1){
//                     $status = '<button type="button" class="btn btn-danger">Chưa xác nhận</button>';
//                 }else{
//                     $status = '<button type="button" class="btn btn-success">Đã xác nhận</button>';
//                 }
//                 $ship = '';
//                 if($list['shipping_method'] == 1){
//                     $ship = '<button type="button" class="btn btn-danger">Nhận tại cửa hàng</button>';
//                 }else{
//                     $ship = '<button type="button" class="btn btn-success">Giao tại nhà</button>';
//                 }
//                 $out .= '
//                     <tr>
//                     <td>' . $list["id_card"] . '</td>
//                      <td>' . $list["name"] . '</td>
//                      <td>' . $list['email'] . '</td>
//                      <td>' . $list['address'] . '</td>
//                      <td>' . $list['mobile_card'] . '</td>
//                      <td>' .  $ship  . '</td>
//                      <td>' .  $status. '</td>
//                      <td>' . $list['price_total'] . '</td>
//                      <td><button id="edit_btn" type="button" edit="' . $list["id_card"] . '" class="btn btn-warning btn-xs update">Sửa</button></td>
//                      <td><button id="delete_btn" type="button" delete_data="' . $list["id_card"] . '" class="btn btn-danger btn-xs delete">Xoá</button></td>
//                     </tr>
                    
//                     ';
//             }
//         } else {
//             $output .= '
//         <tr>
//          <td align="center">Không có dữ liệu</td>
//         </tr>
//        ';
//         }
//         echo $out;
//     }
// }
