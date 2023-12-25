<?php
include 'core/conf.php';
if (!isLogin()){
    exit;
}
$isAdmin = false;
$isContributor = false;
$userType = userType();
function fileSVG($type){
    switch ($type){
        case "pdf":
            $return = "/assets/svg/pdf.svg";
            break;
        case "ppt":
            $return = "/assets/svg/ppt.svg";
            break;
        case "word":
            $return = "/assets/svg/word.svg";
            break;
        case "video":
            $return = "/assets/svg/video.svg";
            break;
        case "audio":
            $return = "/assets/svg/audio.svg";
            break;
        default:
            $return = "/assets/svg/file.svg";
    }
    return $return;
}
$id = filter_var($_GET['data'], FILTER_SANITIZE_NUMBER_INT);
if ($stmt = $conn->prepare("SELECT * FROM `archive` WHERE `no` = ?")) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //check if it's a file or a folder
            $type = $row['type'];
            $directory = $row['directory'];
            $name = $row['name'];
            if ($type == "folder"){
                //case if admin:
                if ($userType == 1){
                    $isAdmin = true;
                } else if($userType == 3){
                    $isContributor = true;
                }
                //case if admin end
                //get all file/folder that their directory == $id
                $children = $conn->prepare("SELECT * FROM `archive` WHERE `directory` = ?");
                $children->bind_param("i", $id);
                $children->execute();
                $childrenResult = $children->get_result();
                ?>
                    <div class="d-flex justify-content-start align-items-center">
                        <?
                        if ($directory != -1){
                            ?>
                            <a href="#<? echo $directory; ?>">
                                <button type="button" class="btn btn-outline-light">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </button>
                            </a>&nbsp;&nbsp;
                            <?
                        }
                        ?>
                        <h3 style="margin-top: 5px;"><b><? echo $name; ?></b></h3>
                    </div>
                    <hr>
                    <div class="row">
                    <?
                if ($childrenResult->num_rows > 0) {
                    while ($childrenRow = $childrenResult->fetch_assoc()) {
                        $childrenType = $childrenRow['type'];
                        $childrenId = $childrenRow['no'];
                        $childrenTitle = $childrenRow['name'];
                        ?>
                        <div class="col-6 col-md-4 col-lg-3" style="padding: 5px; margin-top: 10px; margin-bottom: 5px;">
                            <?
                            if ($isAdmin || $isContributor){
                            ?>
                            <i class="fa-solid fa-ellipsis" onclick="editIcon(this)" data-value="<? echo $childrenId; ?>" ></i><br>
                            <?
                            }
                            if ($childrenType == 'folder'){
                                ?>
                                <a href="#<? echo $childrenId; ?>" id="loadDataButton">
                                    <img src="/assets/svg/folder.svg" alt="Folder" style="width: 5em;">
                                    <b class="two-line-text"><? echo $childrenTitle; ?></b>
                                </a>
                                
                                <?
                            } else {
                                ?>
                                <a href="file/<? echo $childrenId; ?>">
                                    <img src="<? echo fileSVG($childrenType); ?>" alt="File" style="width: 5em;">
                                    <b class="two-line-text"><? echo $childrenTitle; ?></b>
                                </a>
                                <?
                            }
                            ?>
                        </div>
                        <?
                    }
                }
                $children->close();
                ?>
                    </div>
                    <?
            } else {
                echo "this is not a folder";
            }
        }
    } else {
        echo "folder not found";
    }
    $stmt->close();
} else {
    echo "something went wrong on the database part";
}
$conn->close();
?>