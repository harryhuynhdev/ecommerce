<?php
$servername = "localhost";
$username = 'root';
$password = '';
$conn = new PDO("mysql:host=$servername;dbname=mobile", $username, $password); // Create Object of PDO class by connecting to Mysql database

  
    if(isset($_POST["action"])) //Check value of $_POST["action"] variable value is set to not
    {
     //For Load All Data
     if($_POST["action"] == "Load") 
     {
      
      $statement = $conn->prepare("SELECT * FROM category ORDER BY id_category ASC");
      $statement->execute();
      $result = $statement->fetchAll();
      $output = '';
      $output .= '
       <table class="table table-bordered">
        <tr>
        <th width="10%">#</th>
         <th width="40%">Tên danh mục</th>
         <th width="40%">Trạng thái</th>
         <th width="10%" colspan="2">Thao tác</th>
        
        </tr>
      ';
      if($statement->rowCount() > 0)
      {
       foreach($result as $row)
       {
         $status = '';
         if($row['status'] == 1){
           $status = '<button type="button" class="btn btn-success">ON</button>';
         }else{
           $status = '<button type="button" class="btn btn-secondary">OFF</button>';
         }
        $output .= '
        <tr>
        <td>'.$row["id_category"].'</td>
         <td>'.$row["name"].'</td>
         <td>'.$status.'</td>
         <td><button type="button" id_category="'.$row["id_category"].'" class="btn btn-warning btn-xs update">Sửa</button></td>
         <td><button type="button" id_category="'.$row["id_category"].'" class="btn btn-danger btn-xs delete">Xoá</button></td>
        </tr>
        ';
       }
      }
      else
      {
       $output .= '
        <tr>
         <td align="center">Không có dữ liệu</td>
        </tr>
       ';
      }
      $output .= '</table>';
      echo $output;
     }
    
     //This code for Create new Records
     if($_POST["action"] == "Create")
     {

      $statement = $conn->prepare("
       INSERT INTO category (name, status) 
       VALUES (:name, :status)
      ");
      $result = $statement->execute(
       array(
        ':name' => $_POST["name"],
        ':status' => $_POST["status"]
       )
      );
      if(!empty($result))
      {
       echo 'Thêm thành công';
      }
     }
    
     //This Code is for fetch single customer data for display on Modal
     if($_POST["action"] == "Select")
     {
      $output = array();

      $statement = $conn->prepare(
       "SELECT * FROM category 
       WHERE id_category = '".$_POST["id_category"]."' 
       LIMIT 1"
      );
      $statement->execute();
      $result = $statement->fetchAll();
       
      foreach($result as $row)
      {
       $output["name"] = $row["name"];
       $output["status"] = $row["status"];
      }
     
      echo json_encode($output);
     }
    
     if($_POST["action"] == "Update")
     {

      $statement = $conn->prepare(
       "UPDATE category 
       SET name = :name, status = :status 
       WHERE id_category = :id_category
       "
      );
      $result = $statement->execute(
       array(
        ':name' => $_POST["name"],
        ':status' => $_POST["status"],
        ':id_category'   => $_POST["id_category"]
       )
      );
      if(!empty($result))
      {
       echo 'Sửa thành công';
      }
     }
    
     if($_POST["action"] == "Delete")
     {
        
      $statement = $conn->prepare(
       "DELETE FROM category WHERE id_category = :id_category"
      );
      $result = $statement->execute(
       array(
        ':id_category' => $_POST["id_category"]
       )
      );
      if(!empty($result))
      {
       echo 'Xoá thành công';
      }
     }
    
    }

  
    
?>