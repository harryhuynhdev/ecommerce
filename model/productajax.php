<?php
$servername = "localhost";
$username = 'root';
$password = '';
$conn = new PDO("mysql:host=$servername;dbname=mobile", $username, $password); // Create Object of PDO class by connecting to Mysql database


if (isset($_POST["action"])) //Check value of $_POST["action"] variable value is set to not
{
  //For Load All Data
  if ($_POST["action"] == "LoadPro") {

    $statement = $conn->prepare("SELECT * FROM product ORDER BY id_product Desc");
    $statement->execute();
    $result = $statement->fetchAll();
    $output = '';
    $output .= '
       <table class="table table-bordered">
        <tr>
        <th width="10%">#</th>
         <th width="10%">Tên sản phẩm</th>
         <th width="20%">Giá</th>
         <th width="20%">Hình ảnh</th>
         <th width="10%">Loại</th>
         <th width="10%">Trạng thái</th>
         <th width="10%" colspan="2">Thao tác</th>
        </tr>
      ';
    if ($statement->rowCount() > 0) {
      foreach ($result as $row) {
        $image = '';
        if ($row["image"] != '') {
          $image = '<img src="upload/' . $row["image"] . '" class="img-thumbnail" width="50" height="35" />';
        } else {
          $image = '';
        }
        $status = '';
        if($row['status'] == 1){
          $status = '<button type="button" class="btn btn-success">Hiện</button>';
        }else {
          $status = '<button type="button" class="btn btn-danger">Ẩn</button>';
        }

        $type = '';
        if($row['type'] == 1){
          $type = '<button type="button" class="btn btn-success">Hot</button>';
        }else {
          $type = '<button type="button" class="btn btn-danger">Thường</button>';
        }
        $output .= '
        <tr>
        <td>' . $row["id_product"] . '</td>
         <td>' . $row["name"] . '</td>
         <td>' . $row['price'] . '</td>
         <td>' . $image . '</td>
         <td>' . $type. '</td>
         <td>' . $status . '</td>
         <td><button id="edit_btn" type="button" edit="'.$row["id_product"].'" class="btn btn-warning btn-xs update">Sửa</button></td>
         <td><button id="delete_btn" type="button" delete_data="'.$row["id_product"].'" delete_btn_img="'.$row['image'].'" class="btn btn-danger btn-xs delete">Xoá</button></td>
        </tr>
        ';
      }
    } else {
      $output .= '
        <tr>
         <td align="center">Không có dữ liệu</td>
        </tr>
       ';
    }
    $output .= '</table>';
    echo $output;
  }
  function upload_image()
  {
    if(isset($_FILES["image"]))
    {
     $extension = explode('.', $_FILES['image']['name']);
     $new_name = rand() . '.' . $extension[1];
     $destination = "../upload/".$new_name;
     move_uploaded_file($_FILES['image']['tmp_name'], $destination);
     return $new_name;
    }
  }
  //This code for Create new Records
  if ($_POST["action"] == "Create") {
    $id_category = $_POST['id_category'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $detail = $_POST['detail'];
    $image = '';
    if($_FILES["image"]["name"] != '')
    {
     $image = upload_image();
    }


    $status = $_POST['status'];
    $type = $_POST['type'];
    $price_promotion = $_POST['price_promotion'];

    var_dump($_FILES['image']);
    $sql = "INSERT INTO product(id_category, name, price, detail, image, status, type, price_promotion) 
      VALUES('$id_category','$name','$price','$detail','$image','$status','$type','$price_promotion')
     ";
    $conn->exec($sql);
    echo 'created';
  }
 
  //This Code is for fetch single customer data for display on Modal
  if ($_POST['action'] == 'fetchSingle') {
    $output = array();
    $editId =$_POST['editId'];
   
    $sql = "SELECT * FROM product WHERE id_product='$editId'  LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($data as $value){
      $output["id_category"] = $value["id_category"];
      $output['name'] = $value["name"];
      $output['price'] = $value["price"];
      $output['detail'] = $value["detail"];
      $output['uplopaded_image'] = $value["image"];
      $output['upload_hidden_img'] = '<img width="70px" height="70px" src="upload/'.$value["image"].'">';
      $output['status'] = $value["status"];
      $output['type'] = $value["type"];
      $output['price_promotion'] = $value["price_promotion"];
    }
    echo json_encode($output);
 
  }

  if ($_POST["action"] == "update") {
    $id_product = $_POST['id_product'];
    if($_FILES['image']['name'] != ''){
      $image = upload_image($_FILES['image']);
      unlink('upload/'.$_POST['upload_img']);
    }else{
      $image = $_POST['upload_img'];
    }

    // $sql = "UPDATE product SET id_category = '".$id_category."' name = '".$name."' detail = '".$detail."'
    // image = '".$image."' status = '".$status."' type = '".$type."' price_promotion = '".$price_promotion."' where id_product= '$id_product'";
    // $stmt = $conn->prepare($sql);
    // $stmt->execute();
    $statement = $conn->prepare(
      "UPDATE product 
       SET id_category = :id_category, name = :name,price = :price,detail = :detail,image = :image,status = :status,type = :type, price_promotion = :price_promotion 
       WHERE id_product = :id_product
       "
    );
    $result = $statement->execute(
      array(
        ':id_product' => $_POST["id_product"],
        ':id_category' => $_POST["id_category"],
        ':name' => $_POST["name"],
        ':price'   => $_POST["price"],
        ':detail'   => $_POST["detail"],
        ':image'   => $image,
        ':status'   => $_POST["status"],
        ':type'   => $_POST["type"],
        ':price_promotion'   => $_POST["price_promotion"]
        
      )
    );
    if (!empty($result)) {
      echo 'Update succes';
    }
  }

  if($_POST["action"] == 'delete') {
    $id_product = $_POST['delete_btn_id'];
    $id_img = $_POST['delete_btn_img'];
    $statement = $conn->prepare(
      "DELETE FROM product WHERE id_product = :id_product"
    );
    $result = $statement->execute(
      array(
        ':id_product' => $_POST["delete_btn_id"]
      )
    );
    unlink('upload/'.$id_product);
    echo 'deleted';
  }
}
