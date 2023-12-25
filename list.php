<?php
include 'core/conf.php';
if (!isLogin()){
    echo 'unauthorized access';
    exit;
}
$sql = "SELECT * FROM `archive` ORDER BY `no`";
$select = mysqli_query($conn, $sql);
header('Content-Type: application/json; charset=utf-8');
if(mysqli_num_rows($select)) {
    $data = [];
    while ($row = mysqli_fetch_assoc($select)) {
        $id = $row['no'];
        $name = $row['name'];
        $type = $row['type'];
        $dir = $row['directory'];

        if ($id != 0) {
            if ($type == "folder") {
                $data[] = [
                    'id' => $id,
                    'pId' => $dir,
                    'name' => $name,
                    'open' => false,
                    'type' => $type,
                    'file' => $id,
                    'isParent' => true
                ];
            } else {
                $data[] = [
                    'id' => $id,
                    'pId' => $dir,
                    'name' => $name,
                    'type' => $type,
                    'file' => "file/$id"
                ];
            }
        } else {
            $data[] = [
                'id' => $id,
                'pId' => $dir,
                'name' => $name,
                'open' => true,
                'type' => $type,
                'file' => $id,
                'isParent' => true
            ];
        }
    }
    echo json_encode($data);
}
?>
