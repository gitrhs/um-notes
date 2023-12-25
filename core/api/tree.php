<?php
include '../conf.php';
$sql = "SELECT * FROM archive ORDER BY no";
$select = mysqli_query($conn, $sql);
if(mysqli_num_rows($select)) {
    $isFirst = true;
    echo "[\r\n";
    while ($row = mysqli_fetch_assoc($select)) {
        if (!$isFirst){
            echo ",\r\n";
        }
        /*
        {id: 101, pId: 1, name: "Standard JSON Data", open: false},
      {id: 102, pId: 101, name: "Simple JSON Data", file: "core/simpleData"},
      no 	name 	type 	directory 
        */
        $id = $row['no'];
        $name = $row['name'];
        $type = $row['type'];
        $dir = $row['directory'];
        if ($type == "folder"){
            echo "{id: $id, pId: $dir, name: \"$name\", open: false}";
        } else {
            echo "{id: $id, pId: $dir, name: \"$name\", file: \"core/simpleData\"}";
        }
        $isFirst = false;
    }
    echo "]";
}


$conn->close();
?>