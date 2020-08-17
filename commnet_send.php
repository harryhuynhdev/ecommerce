<?php
    require_once './model/connect.php';
    require_once './model/commnet.php';

    $id_product= $_POST['id_product'];
    $name=$_POST['name'];
    $comment = $_POST['comment'];
 
    insertcmt($id_product, $comment, $name);
    

    $listcmt = loadcmt();
       
    $output= '';
    foreach($listcmt as $list){
        extract($listcmt);
        $list['name'];
        $output.='<strong>'.$list['name'].'</trong><br><p>'.$list['comment'].'';
     
    }
    echo $output;  

?>