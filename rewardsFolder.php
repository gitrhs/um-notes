<?php
include 'core/conf.php';
if (!isLogin()){
    exit;
}
$id = $_GET['data'];
$userPoint = getPoint();
function access($userPoint, $point){
    if ($userPoint >= $point){
        return true;
    } else {
        return false;
    }
}
function getSVG($type){
    switch ($type){
        case "file":
            $type = "/assets/svg/file.svg";
            break;
        case "pdf":
            $type = "/assets/svg/pdf.svg";
            break;
        case "link":
            $type = "/assets/svg/link.svg";
            break;
        case "zip":
            $type = "/assets/svg/zip.svg";
            break;
        case "video":
            $type = "/assets/svg/video.svg";
            break;
        case "audio":
            $type = "/assets/svg/audio.svg";
            break;
        default:
            $type = "/assets/svg/file.svg";
    }
    return $type;
}
function getSVGLocked($type){
    switch ($type){
        case "file":
            $type = "/assets/svg/file-locked.svg";
            break;
        case "pdf":
            $type = "/assets/svg/pdf-locked.svg";
            break;
        case "link":
            $type = "/assets/svg/link-locked.svg";
            break;
        case "zip":
            $type = "/assets/svg/zip-locked.svg";
            break;
        case "video":
            $type = "/assets/svg/video-locked.svg";
            break;
        case "audio":
            $type = "/assets/svg/audio-locked.svg";
            break;
        default:
            $type = "/assets/svg/file-locked.svg";
    }
    return $type;
}
if ($stmt = $conn->prepare("SELECT * FROM rewards WHERE no = ?")) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //check if it's a file or a folder
            $type = $row['type'];
            $directory = $row['directory'];
            $name = $row['name'];
            $point = $row['point'];
            if ($type == "folder" && access($userPoint, $point)){
                //case if admin:
                if (userType() == 1){
                    $isAdmin = true;
                } else if(userType() == 3){
                    $isContributor = true;
                } else {
                    $isAdmin = false;
                }
                //case if admin end
                //get all file/folder that their directory == $id
                $children = $conn->prepare("SELECT * FROM rewards WHERE directory = ? ORDER BY `point` ASC");
                $children->bind_param("i", $id);
                $children->execute();
                $childrenResult = $children->get_result();
                ?>
                    <div class="d-flex justify-content-center align-items-center">
                        <?
                        if ($directory != -1){
                            ?>
                            <a href="#<? echo $directory; ?>">
                                <button type="button" class="btn btn-outline-light">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </button>
                            </a>&nbsp; &nbsp;
                            <?
                        }
                        ?>
                        <h1 style="text-align: center;"> <span class="coloredtext">Rewards</span>
                        <? 
                        if ($directory != -1){
                            ?>
                             - <span style="color: #cecfd0;"><? echo $name; ?></span></h1>
                            <?
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="row">
                    <?
                if ($childrenResult->num_rows > 0) {
                    while ($childrenRow = $childrenResult->fetch_assoc()) {
                        $childrenType = $childrenRow['type'];
                        $childrenId = $childrenRow['no'];
                        $childrenTitle = $childrenRow['name'];
                        $childrenPoint = $childrenRow['point'];
                        ?>
                        <div class="col-6 col-md-4 col-lg-3" style="padding: 5px; margin-top: 10px; margin-bottom: 5px;">
                            <?
                            if ($isAdmin || $isContributor){
                            ?>
                            <i class="fa-solid fa-ellipsis" onclick="editIcon(this)" data-value="<? echo $childrenId; ?>" ></i><br>
                            <?
                            }
                            if ($childrenType == 'folder'){
                                if (access($userPoint, $childrenPoint)){
                                ?>
                                    <a href="#<? echo $childrenId; ?>" id="loadDataButton">
                                        <img src="/assets/svg/folder.svg" alt="Folder" style="width: 5em;">
                                        <br>
                                        <b class="two-line-text"><? echo $childrenTitle; ?></b>
                                    </a>
                                <?
                                } else {
                                ?>
                                    <img src="/assets/svg/folder-locked.svg" alt="Folder Locked" style="width: 5em;">
                                    <br>
                                    <small><? echo "<span style='color: tomato;'>".$userPoint."</span> / ".$childrenPoint; ?></small><br>
                                    <b class="two-line-text"><? echo $childrenTitle; ?></b>
                                <?
                                }
                            } else {
                                if (access($userPoint, $childrenPoint)){
                                ?>
                                <a href="rewardFile/<? echo $childrenId; ?>">
                                    <img src="<? echo getSVG($childrenType); ?>" alt="file" style="width: 5em;">
                                    <br>
                                    <b class="two-line-text"><? echo $childrenTitle; ?></b>
                                </a>
                                <?
                                } else {
                                ?>
                                    <img src="<? echo getSVGLocked($childrenType); ?>" alt="file locked" style="width: 5em;">
                                    <br>
                                    <small><? echo "<span style='color: tomato;'>".$userPoint."</span> / ".$childrenPoint; ?></small><br>
                                    <b class="two-line-text"><? echo $childrenTitle; ?></b>
                                <?
                                }
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
                echo "Are you missing?";
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