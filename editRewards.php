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
//get data that have the id
if ($stmt = $conn->prepare("SELECT * FROM `rewards` WHERE `no` = ?")) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //no 	name 	description 	type 	directory 	link 	point isAPI 	kontributor 	time
            $name = $row['name'];
            $description = $row['description'];
            $type = $row['type'];
            $directory = $row['directory'];
            $link = $row['link'];
            $point = $row['point'];
            $isAPI = $row['isAPI'];
            $kontributor = $row['kontributor'];
            //if file
            if ($type != "folder"){
            //print the form
            ?>
            <a href="action/admin/deleteRewards.php?id=<? echo $id; ?>" type="button" class="btn btn-danger">Delete file</a>
            <br><hr>
            <form method="POST" action="action/admin/editFileRewards.php?id=<? echo $id; ?>">
                <div class="mb-3">
                    <label for="fileName" class="form-label">File Name</label>
                    <input type="text" class="form-control" id="fileName" name="fileName" value="<? echo $name; ?>" required>
                </div>
                <!-- File URL -->
                <div class="mb-3">
                    <label for="fileURL" class="form-label">File URL (Link of the file stored).</label>
                    <input type="url" class="form-control" id="fileURL" name="fileURL" value="<? echo $link; ?>" required>
                </div>
                <!-- File Description -->
                <div class="mb-3">
                    <label for="fileDesc" class="form-label">File Description</label>
                    <textarea class="form-control" id="fileDesc" name="fileDesc" maxlength="1000" rows="3"><? echo $description; ?></textarea>
                </div>
                <!-- File Type -->
                <div class="mb-3">
                    <label for="fileType" class="form-label">File Type</label>
                    <select class="form-select" name="fileType" aria-label="type">
                        <option value="1" selected>Other</option>
                        <option value="2">PDF</option>
                        <option value="3">Website Link</option>
                        <option value="4">Zip</option>
                        <option value="5">Video</option>
                        <option value="6">Audio</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="filePoint" class="form-label">Minimum point to access</label>
                    <input type="number" class="form-control" id="filePoint" name="filePoint" value="<? echo $point; ?>" required>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" name="apiswitcher" type="checkbox" role="switch" id="apiswitcher" <? if ($isAPI){echo "checked";}?>>
                    <label class="form-check-label" for="apiswitcher">Use API for Verification</label>
                    <br><a href="api" style="color: tomato;">*Learn how to use the API here</a>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            <?
            } else {
            ?>
            <a href="action/admin/deleteRewards.php?id=<? echo $id; ?>" type="button" class="btn btn-danger">Delete folder</a>
            <br><hr>
            <form method="POST" action="action/admin/editFolderRewards.php?id=<? echo $id; ?>">
                <div class="mb-3">
                    <label for="folderName" class="form-label">Folder Name</label>
                    <input type="text" class="form-control" id="folderName" name="folderName" value="<? echo $name; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="folderName" class="form-label">Minimum point to access</label>
                    <input type="number" class="form-control" id="folderName" name="folderPoint" value="<? echo $point; ?>" required>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
            <?
            }
        }
    } else {
        echo "file not found!";
    }
    $stmt->close();
} else {
    echo "something went wrong in the server side";
}
$conn->close();
?>