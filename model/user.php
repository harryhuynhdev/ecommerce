<?php
    function checkuser($email,$password){
        $sql = "select * from user where email='".$email."' and pass='".$password."'";
        $conn = connectdb();
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetch();
        return $result;
    }
  


    function register($name,$mobile,$address,$pass,$email){
        $sql ="insert into user (id_role,name, mobile,address, pass, status, email) values ('2','$name', '$mobile','$address', '$pass', '1', '$email')";
        $conn = connectdb();
        $conn->exec($sql);
    }
?>