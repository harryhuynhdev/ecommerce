<?php
    $servername = "localhost";
    $username = 'root';
    $password = '';
    $conn = new PDO("mysql:host=$servername;dbname=mobile", $username, $password); 

    $data_date = array();
    // for($i=1; $i <= 30; $i++){
        $sql = "SELECT SUM(price_total) as price, DATE(created_at) as data_day FROM card GROUP BY DAY(created_at)";
        $stmt = $conn->prepare($sql);
        if($stmt->execute()){
            if($stmt->rowCount()>0){
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        if($result){
            foreach($result as $row){
                // array_push($data_date,new ngay1($i,$row['price']));
                $data_date [] = $row;
            }
        }
    // }
   
    echo json_encode($data_date);
    // class ngay1{
    //     public $ngay;
    //     public $rate1;
    //     function __construct($ngay,$rate1){
    //     $this->ngay = $ngay;
    //     $this->rate1 = $rate1;
    //     }    
    // }
?>