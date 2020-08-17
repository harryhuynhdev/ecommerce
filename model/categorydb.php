<?php
function getList()
{
    $output1 = '';
    $sql = "select * from category order by id_category asc";
    $conn = connectdb();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();
    return $result;

    $output1 .= '
       <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Tên danh mục</th>
                    <td colspan="2">Thao tác</td>
                    <th colspan="1">Trạng thái</th>
                </tr>
            </thead>
        ';
    if ($result > 0) {
        while ($row = $result) {
            $output1 .= '
                    <tr>
                         <td>'.$row['id_category'].'</td>
                        <td>'.$row['name'].'</td>
                        <td></td>
                        <td>';if ($row['status'] == 1) {
                            echo '<input type="checkbox" checked data-toggle="toggle" data-onstyle="success" data-offstyle="danger">';
                        } else {
                            echo '<input type="checkbox" data-toggle="toggle" data-offstyle="danger" data-onstyle="success">';
                        };'</td>
                    </tr>
                ';
        }
    } else {
        $output1 .= '
          
            <tr>
            <th colspan="5">Không có dữ liệu</th>
        </tr>
            ';
    }
    $output1 .='</table></div>';
    echo $output1;
}

function addCate($name, $status)
{

    $sql = "insert into category(name,status) values ('$name','$status')";
    $conn = connectdb();
    $conn->exec($sql);
}
