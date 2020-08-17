<?php
    $servername = "localhost";
    $username = 'root';
    $password = '';
    $conn = new PDO("mysql:host=$servername;dbname=mobile", $username, $password); 

    $data = array();
    for($i=1;$i<=12;$i++){
    $query = "SELECT SUM(price_total) as price FROM card WHERE MONTH(card.created_at)= $i";
    $stmt = $conn->prepare($query);
    if($stmt->execute()){
        if($stmt->rowCount()>0){
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    if($result){
    foreach($result as $row){
        array_push($data,new thang1($i,$row['price']));
    }
    }
    }

    echo json_encode($data);
    class thang1{
        public $thang;
        public $rate;
        function __construct($thang,$rate){
        $this->thang = $thang;
        $this->rate = $rate;
        }    
    }
?>