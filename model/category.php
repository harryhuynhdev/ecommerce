<?php
    function loadcategory(){
        $conn = connectdb(); 
        $sql = "select * from category where status='1' order by id_category asc";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


?>