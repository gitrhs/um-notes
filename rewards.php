<?php
include 'core/conf.php';
if (!isLogin()){
    header("location: login");
    exit;
}
if (empty(userType())){
    header("location: userinformation");
    exit;
}
$userID = getUserID();
$userName = getName();
$userEmail = getEmail();
$userPoint = getPoint(); 
$userType = userType();https://notes.ppiunimalaya.id/
if ($userType == 1){
    $isAdmin = true;
} else if($userType == 3){
    $isContributor = true;
}
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UM Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../core/css/main.css"/>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
    <style>
        .modal-card{
            background-color: #181b21;
            color: white;
        }
        .admin-btn{
            border-radius: 20px;
            margin: 5px;
            color: #39a193 !important;
            border-color: #39a193;
            
        }
        .admin-btn:hover{
            background-color: #39a193;
            color: white;
        }
        .admin-btn.active{
            background-color: #39a193 !important;
            color: white !important;
        }
        .admin-btn.checked{
            background-color: #39a193 !important;
            color: white !important;
        }
        .btn-check:checked + .btn-outline-info.admin-btn {
            border-color: #39a193;
            background-color: #39a193;
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="second-container">
            <div class="card nav">
                <div class="d-flex justify-content-between">
                    <a href="<? $_SERVER['REQUEST_URI']; ?>"><img src="../core/img/logo.png" height="45"/></a>
                    <div class="dropdown">
                      <a type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="menuButton fas fa-bars" style="color: #ffffff;"></i>
                      </a>
                      <ul class="dropdown-menu">
                        <?php
                        if ($isAdmin){
                        ?>
                        <li><a class="dropdown-item" href="admin/index.php">Admin Page</a></li>
                        <?php
                        }
                        ?>
                        <li><a class="dropdown-item" href="dashboard"><i class="fa-solid fa-pager"></i> Dashboard</a></li>
                        <li><a class="dropdown-item" href="account"><i class="fa-regular fa-user"></i> Account</a></li>
                        <li><a class="dropdown-item" href="api"><i class="fa-regular fa-circle-question"></i> API</a></li>
                        <li><a class="dropdown-item" href="faq"><i class="fa-regular fa-circle-question"></i> FAQ</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-center">
        <!-- Content Start -->
        <div style="padding: 10px; max-width: 98%; width: 1700px;">
            <?
            if ($isAdmin || $isContributor){
                ?>
            <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#addFileToogle">
                <div class="d-none d-md-block">
                        <b><i class="fa-solid fa-plus"></i></b> file
                    </div>
                    <div class="d-block d-md-none">
                        <i class="fa-regular fa-file"></i>
                    </div>
                </button>
            &nbsp;<button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#addFolderToogle">
                <div class="d-none d-md-block">
                        <b><i class="fa-solid fa-plus"></i></b> folder
                    </div>
                    <div class="d-block d-md-none">
                        <i class="fa-regular fa-folder"></i>
                    </div>
                </button>
            &nbsp;<div class="vr" style="height: 23px;"></div>&nbsp;
                <?
            }
            ?>
            <button class="btn btn-secondary" type="button"><i class="fa-solid fa-circle-question"></i></button>
            &nbsp;<a href="dashboard"><button class="btn btn-secondary" type="button"><i class="fa-solid fa-home"></i></button></a>
            &nbsp;<a href="rank"><button class="btn btn-news" type="button"><i class="fa-solid fa-list-ol"></i></button></a>
            <div class="text-center">
            <div class="card shadow transparent-card">
                <div class="card-body" style="min-height: 73vh;"> 
                    <div id="htmlContainer"></div>
                </div>
            </div>
            </div>
        </div>
        <!-- Content End -->
        
        <!-- Modal Start -->
        <!-- add file modal -->
                <div class="modal fade" id="addFileToogle" tabindex="-1" aria-labelledby="addFileToogleLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-card">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addFileToogleLabel">Contribute File</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
                      </div>
                      <form id="fileform" method="POST" action="action/admin/createRewardsPost.php">
                        <input type="hidden" id="folderID" name="folderID" value="">
                          <div class="modal-body">
                            <!-- Alert -->
                            <div class="alert alert-primary" role="alert">
                              The file will be save on this folder
                            </div>
                                <!-- File Name -->
                                <div class="mb-3">
                                    <label for="fileName" class="form-label">File Name</label>
                                    <input type="text" class="form-control" id="fileName" name="fileName" placeholder="xxxx Reward" required>
                                </div>
                                <!-- File URL -->
                                <div class="mb-3">
                                    <label for="fileURL" class="form-label">File URL (Link of the file stored).</label>
                                    <input type="url" class="form-control" id="fileURL" name="fileURL" placeholder="https://docs.google.com/document/d/12345/view?usp=drive_link" required>
                                </div>
                                <!-- File Description -->
                                <div class="mb-3">
                                    <label for="fileDesc" class="form-label">Rewards Description</label>
                                    <textarea class="form-control" id="fileDesc" name="fileDesc" maxlength="1000" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="filePoint" class="form-label">Minimum Point to access</label>
                                    <input type="number" class="form-control" id="filePoint" name="filePoint" placeholder="70" required>
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
                                <!-- API Switcher -->
                                <div class="form-check form-switch">
                                  <input class="form-check-input" name="apiswitcher" type="checkbox" role="switch" id="apiswitcher">
                                  <label class="form-check-label" for="apiswitcher">Use API for Verification</label>
                                  <br><a href="api" style="color: tomato;">*Learn how to use the API here</a>
                                </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- add file modal end -->
                
        <!-- add folder modal -->
        <div class="modal fade" id="addFolderToogle" tabindex="-1" aria-labelledby="addFolderToogleLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-card">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addFolderToogleLabel">Contribute File</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
                    </div>
                    <form id="folderForm" method="POST" action="action/admin/createRewardsFolder.php">
                        <input type="hidden" id="folderID2" name="folderID2" value="">
                        <div class="modal-body">
                            <!-- Alert -->
                            <div class="alert alert-primary" role="alert">
                              The folder will be create on this folder.
                            </div>
                            <!-- Folder Name -->
                            <div class="mb-3">
                                <label for="folderName" class="form-label">Folder Name</label>
                                <input type="text" class="form-control" id="folderName" name="folderName" placeholder="Machine Learning" required>
                            </div>
                            <div class="mb-3">
                                <label for="folderPoint" class="form-label">Minimum Point to access</label>
                                <input type="number" class="form-control" id="folderPoint" name="folderPoint" placeholder="70" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- add folder modal end -->
        <!-- edit modal -->
                <div class="modal" id="editModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-card">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit Content</h5>
                      </div>
                      <div class="modal-body" id="modalBody"></div>
                    </div>
                  </div>
                </div>
                <!-- edit modal end -->
        <!-- Modal End -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script>
        function editIcon(icon) {
            // Get the value from the data-value attribute
            const editIconValue = icon.getAttribute("data-value");
            const modalBody = document.getElementById("modalBody");
            $.ajax({
                url: `editRewards/${editIconValue}`,
                method: "GET",
                success: function (data) {
                    // Update the modal body with the fetched content
                    modalBody.innerHTML = data;
    
                    // Trigger the modal to be shown
                    $('#editModal').modal('show');
                },
                error: function () {
                    console.error("Error loading modal content");
                }
            });
        }
        var htmlContainer;
        $(document).ready(function () {
            htmlContainer = $("#htmlContainer"); // Specify the HTML container ID here
            var folderID = 0;
            var folderID2 = 0;
            // Check if the initial URL has a hash
            if (hasHash(window.location.href)) {
              handleHashChange();
            } else {
                loadHTMLData('rewardsFolder/0');
            }
        });
        function loadHTMLData(htmlURL) {
            // Fetch HTML data and insert it into the container
            fetch(htmlURL)
              .then(response => response.text())
              .then(htmlData => {
                htmlContainer.html(htmlData);
              })
              .catch(error => {
                console.error('Error fetching HTML data:', error);
              });
        }
        function hasHash(link) {
          return link.includes('#');
        }
        function handleHashChange() {
          var currentHash = window.location.hash;
        
          // Do something with the current hash value
          console.log('Hash changed to:', currentHash);
          currentHash = currentHash.substring(1);
          if (currentHash.length > 0){
              folderID = parseInt(currentHash);
              folderID2 = parseInt(currentHash);
              console.log("change to ", folderID);
              loadHTMLData('rewardsFolder/' + currentHash);
          } else {
              loadHTMLData('rewardsFolder/0');
          }
        }
        window.addEventListener('hashchange', handleHashChange);
        <?php
        if ($isAdmin || $isContributor){
            ?>
            document.querySelector('#fileform').addEventListener('submit', function () {
            const folderIDInput = document.getElementById("folderID");
            folderIDInput.value = folderID;
        });
        document.querySelector('#folderForm').addEventListener('submit', function () {
            const folderIDInput2 = document.getElementById("folderID2");
            folderIDInput2.value = folderID2;
        });
            <?php
        }
        ?>
    </script>
</body>
</html>
<?php
closeConn();
?>