<?php
include 'core/conf.php';
//check if isLogin and isAdmin
$userType = userType();
if (!isLogin() || ($userType != 1 && $userType != 3)){
    echo 'unauthorized access';
    exit;
}
//make sure if the variable have value
if (!isset($_GET['data'])){
    echo 'empty value';
    exit;
}
$id = $_GET['data'];
/*
<option value="1" selected>-</option>
<option value="2">BUILT ENVIRONMENT</option>
<option value="3">LANGUAGES AND LINGUISTICS</option>
<option value="4">ECONOMICS AND ADMINISTRATION</option>
<option value="5">PHARMACY</option>
<option value="6">ENGINEERING</option>
<option value="7">EDUCATION</option>
<option value="8 ">DENTISTRY</option>
<option value="9">BUSINESS AND ACCOUNTANCY</option>
<option value="10">MEDICINE</option>
<option value="11">SCIENCE</option>
<option value="12 ">COMPUTER SCIENCE AND INFORMATION TECHNOLOGY</option>
<option value="13">ARTS AND SOCIAL SCIENCES</option>
<option value="14">CREATIVE ARTS</option>
<option value="15">LAW</option>
*/
function faculty($fac){
    switch ($fac) {
      case 1;
        return "-";
        break;
      case 2;
        return "BUILT ENVIRONMENT";
        break;
      case 3;
        return "LANGUAGES AND LINGUISTICS";
        break;
      case 4;
        return "ECONOMICS AND ADMINISTRATION";
        break;
      case 5;
        return "PHARMACY";
        break;
      case 6;
        return "ENGINEERING";
        break;
      case 7;
        return "EDUCATION";
        break;
      case 8;
        return "DENTISTRY";
        break;
      case 9;
        return "BUSINESS AND ACCOUNTANCY";
        break;
      case 10;
        return "MEDICINE";
        break;
      case 11;
        return "SCIENCE";
        break;
      case 12;
        return "COMPUTER SCIENCE AND INFORMATION TECHNOLOGY";
        break;
      case 13;
        return "ARTS AND SOCIAL SCIENCES";
        break;
      case 14;
        return "CREATIVE ARTS";
        break;
      case 15;
        return "LAW";
        break;
      default:
        return "-";
    }
}
$one; $two; $three; $four; $five; $six; $seven; $eight; $nine; $ten; $eleven; $twelve; $thirdteen; $fourteen; $fiveteen;
//get data that have the id
if ($stmt = $conn->prepare("SELECT * FROM pending ORDER BY FacultyName ASC")) {
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //no userID 	fileName 	fileURL 	fileDesc 	fileType 	FacultyName 	courseName 	weekOF 
            $userID = $row['userID'];
            $fileNo = $row['no'];
            $fileName = $row['fileName'];
            $fileURL = $row['fileURL'];
            $fileDesc = $row['fileDesc'];
            $fileType = $row['fileType'];
            $FacultyName = $row['FacultyName'];
            $courseName = $row['courseName'];
            $weekOF = $row['weekOF'];
            $temp = '
                    <li class="list-group-item">
                        Title: '.substr($fileName, 0, 20).'
                        <br>URL: <a href="'.$fileURL.'" target="_blank">'.substr($fileURL, 0, 20).'</a>
                        <br>Type : '.$fileType.'
                        <br>Course : '.$courseName.'
                        <br>Week of : '.$weekOF.'
                        <br><br><a href="action/admin/refuse.php?base='.$id.'&file='.$fileNo.'"><button class="btn btn-danger">Refuse</button></a>&nbsp;<a href="action/admin/accept.php?base='.$id.'&file='.$fileNo.'"><button class="btn btn-success">Accept file</button></a>
                    </li>
                    ';
            switch ($FacultyName) {
                case 1;
                    $one[] = $temp;
                    break;
                case 2;
                    $two[] = $temp;
                    break;
                case 3;
                    $three[] = $temp;
                    break;
                case 4;
                    $four[] = $temp;
                    break;
                case 5;
                    $five[] = $temp;
                    break;
                case 6;
                    $six[] = $temp;
                    break;
                case 7;
                    $seven[] = $temp;
                    break;
                case 8;
                    $eight[] = $temp;
                    break;
                case 9;
                    $nine[] = $temp;
                    break;
                case 10;
                    $ten[] = $temp;
                    break;
                case 11;
                    $eleven[] = $temp;
                    break;
                case 12;
                    $twelve[] = $temp;
                    break;
                case 13;
                    $thirdteen[] = $temp;
                    break;
                case 14;
                    $fourteen[] = $temp;
                    break;
                case 15;
                    $one[] = $temp;
                    break;
                default:
                    $fiveteen[] = $temp;
            }
        }
        //print
        function checkarr($arr, $num){
            if (!empty($arr)){
                echo '<button class="btn btn-news" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$num.'" aria-expanded="false" aria-controls="collapse'.$num.'">
                        '.faculty($num).'
                      </button>
                      <div class="collapse" style="color: black;" id="collapse'.$num.'"><br>
                      <ul class="list-group">';
                foreach ($arr as $res){
                    echo $res;
                }
                echo '</ul></div><br><br>';
            }
        }
        checkarr($one, 1);
        checkarr($two, 2);
        checkarr($three, 3);
        checkarr($four, 4);
        checkarr($five, 5);
        checkarr($six, 6);
        checkarr($seven, 7);
        checkarr($eight, 8);
        checkarr($nine, 9);
        checkarr($ten, 10);
        checkarr($eleven, 11);
        checkarr($twelve, 12);
        checkarr($thirdteen, 13);
        checkarr($fourteen, 14);
        checkarr($fiveteen, 15);
    } else {
        echo "Empty Pending";
    }
    $stmt->close();
} else {
    echo "something went wrong in the server side";
}
$conn->close();
?>