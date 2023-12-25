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
if ($stmt = $conn->prepare("SELECT * FROM `archive` WHERE `no` = ?")) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //name 	description 	type 	directory 	link 	kontributor 	time
            $name = $row['name'];
            $description = $row['description'];
            $type = $row['type'];
            $directory = $row['directory'];
            $link = $row['link'];
            $kontributor = $row['kontributor'];
            //if file
            if ($type != "folder"){
            //print the form
            ?>
            <a href="action/admin/delete.php?id=<? echo $id; ?>" type="button" class="btn btn-danger">Delete file</a>
            <br><hr>
            <form method="POST" action="action/admin/editFile.php?id=<? echo $id; ?>">
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
                    <textarea class="form-control" id="fileDesc" name="fileDesc" maxlength="200" rows="3"><? echo $description; ?></textarea>
                </div>
                <!-- File Type -->
                <div class="mb-3">
                    <label for="fileType" class="form-label">File Type</label>
                    <select class="form-select" name="fileType" aria-label="type">
                        <option value="1" selected>Other</option>
                        <option value="2">PDF</option>
                        <option value="3">PPT</option>
                        <option value="4">Word</option>
                        <option value="5">Video</option>
                        <option value="6 ">Audio</option>
                    </select>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
            <?
            } else {
            ?>
            <a href="action/admin/delete.php?id=<? echo $id; ?>" type="button" class="btn btn-danger">Delete folder</a>
            <br><hr>
            <form method="POST" action="action/admin/editFolder.php?id=<? echo $id; ?>">
                <div class="mb-3">
                    <label for="folderName" class="form-label">Folder Name</label>
                    <input type="text" class="form-control" id="folderName" name="folderName" value="<? echo $name; ?>" required>
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