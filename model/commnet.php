<?php
    function loadcmt($id_product){
        $sql="SELECT * FROM review where id_product=" .$id_product ;
        
        $conn = connectdb();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        return $result;
    }
    function insertcmt($id_product,$id_user,$comment,$name,$date){
        $sql="insert into review (id_product, id_user, comment, name, date) values ('$id_product','$id_user','$comment','$name','$date')";
        $conn = connectdb();
        $conn->exec($sql);
    }
?>