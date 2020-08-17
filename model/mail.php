<?php
    function sendmail(){
        $sql="select * from card order by id_card desc limit 1";
        $conn = connectdb();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        return $result;
    }
    function maildetail(){
        $sql="select * from detail_card order by id desc limit 1";
        $conn = connectdb();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        return $result;
    }

?>