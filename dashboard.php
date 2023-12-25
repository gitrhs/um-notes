<?php
include 'core/conf.php';
$isAdmin = false;
if (!isLogin()){
    header("location: login");
    exit;
}
if (empty(userType())){
    header("location: userinformation");
    exit;
}
$userType = userType();
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
    <link rel="stylesheet" href="core/css/main.css#522"/>
    <link rel="icon" type="image/x-icon" href="/core/img/favicon.ico">
    <link rel="stylesheet" href="core/css/zTreeStyle.css" type="text/css">
    <style>
        .modal-card{
            background-color: #181b21;
            color: white;
        }
        .two-line-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-top: 7px;
        }
        .list-group-item{
            background-color: #111317;
            color: #c4c5c5;
        }
        #searchResults {
            position: absolute;
            top: 100px; /* Adjust as needed based on your navbar height */
            left: 50%;
            transform: translateX(-50%);
            overflow-y: auto;
            width: 80%;
            background-color: #171a1f;
            padding: 10px;
            border: 2px solid #111317;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1;
        }
        .blur-background {
            filter: blur(5px);
        }
        .searchbar{
            width: 100%;
            margin-top: -10px;
            padding: 8px;
            font-size: 20px;
            height: 55px !important;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;
            border-bottom: 1px solid #000;
            
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="second-container">
            <div class="card nav shadow">
                <div id="searchInputContainer" style="display:none;">
                    <div class="form-group has-feedback">
                     <input class="searchbar" style="position:relative;" id="searchInput" type="text" placeholder="Search..."><span type="button" style="position:absolute; right:20px;top:8px; font-size: 40px;" id="searchCloseButton" class="fa-solid fa-xmark"></span>
                    </div>
                </div>
                <div id="main-navbar">
                    <div class="d-flex justify-content-between justify-content-end align-items-center">
                        <a href="<? $_SERVER['REQUEST_URI']; ?>"><img src="core/img/logo.png" height="45"/></a>
                        <div class="d-flex justify-content-end align-items-center">
                            <div class="mx-2">
                                <i type="button" id="searchButton" style="font-size: 30px;" class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <div class="mx-2">
                                <div class="dropdown">
                              <a type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="menuButton fa-solid fa-bars"></i>
                              </a>
                              <ul class="dropdown-menu">
                                <?php
                                if ($isAdmin){
                                ?>
                                <li><a class="dropdown-item" href="admin/index.php">Admin Page</a></li>
                                <?php
                                }
                                ?>
                                <li><a class="dropdown-item active" href="dashboard"><i class="fa-solid fa-pager"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="account"><i class="fa-regular fa-user"></i> Account</a></li>
                                <li><a class="dropdown-item" href="api">{ API }</a></li>
                                <li><a class="dropdown-item" href="faq"><i class="fa-regular fa-circle-question"></i> FAQ</a></li>
                                <li><a class="dropdown-item" href="tutorial"><i class="fa-regular fa-lightbulb"></i> Tutorial</a></li>
                                <li><a class="dropdown-item" href="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
                              </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="searchResults"></div>
    </div>
    <div class="container-fluid" style="padding: 10px; max-width: 98%">
        <div class="row">
            <div class="d-none d-md-block col-md-3">
                <div class="card shadow transparent-card">
                    <div class="card-body" style="min-height: 80vh;">
                        <!-- Tree -->
                        <ul id="tree" class="ztree" style="width:100%; overflow:auto;"></ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9">
                <!-- File content -->
                <?
                if ($isAdmin || $isContributor){
                ?>
                <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#addFileToogle">
                    <i class="fa-solid fa-file-circle-plus"></i>
                </button>
                &nbsp;<button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#addFolderToogle">
                    <i class="fa-solid fa-folder-plus"></i>
                </button>
                &nbsp;<button class="btn btn-secondary" type="button" onclick="pendingButton()">
                    <i class="fa-solid fa-clock"></i>
                </button>
                <!-- add file modal -->
                <div class="modal fade" id="addFileToogle" tabindex="-1" aria-labelledby="addFileToogleLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-card">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addFileToogleLabel">Contribute File</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
                      </div>
                      <form id="fileform" method="POST" action="action/admin/post.php">
                          <div class="modal-body">
                            <!-- Alert -->
                            <div class="alert alert-primary" role="alert">
                              The file will be save on this folder
                            </div>
                                <!-- File Name -->
                                <div class="mb-3">
                                    <label for="fileName" class="form-label">File Name</label>
                                    <input type="text" class="form-control" id="fileName" name="fileName" placeholder="Lecture Slide Week 1" required>
                                </div>
                                <!-- File URL -->
                                <div class="mb-3">
                                    <label for="fileURL" class="form-label">File URL (Link of the file stored).</label>
                                    <input type="url" class="form-control" id="fileURL" name="fileURL" placeholder="https://docs.google.com/document/d/12345/view?usp=drive_link" required>
                                </div>
                                <!-- File Description -->
                                <div class="mb-3">
                                    <label for="fileDesc" class="form-label">File Description</label>
                                    <textarea class="form-control" id="fileDesc" name="fileDesc" maxlength="200" rows="3"></textarea>
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
                                <input type="hidden" id="folderID" name="folderID" value="">
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
                      <form id="folderForm" method="POST" action="action/admin/create.php">
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
                <!-- Pending modal -->
                <div class="modal" id="pendingModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-card">
                      <div class="modal-header">
                        <h5 class="modal-title">Pending File</h5>
                      </div>
                      <div class="alert alert-warning" role="alert">
                        <small>Note: The file will be saved in the folder you are in now.</small>
                      </div>
                      <div class="modal-body" id="pendingBody"></div>
                    </div>
                  </div>
                </div>
                <?
                } else {
                ?>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addFileToogle"><b><i class="fa-solid fa-plus"></i></b> Add file</button>
                <!-- add file modal -->
                <div class="modal fade" id="addFileToogle" tabindex="-1" aria-labelledby="addFileToogleLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-card">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addFileToogleLabel">Contribute File</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
                      </div>
                      <form method="POST" action="action/post.php">
                          <div class="modal-body">
                            <!-- File Name -->
                            <div class="mb-3">
                                <label for="fileName" class="form-label">File Name</label>
                                <input type="text" class="form-control" id="fileName" name="fileName" placeholder="Lecture Slide Week 1" required>
                            </div>
                            <!-- File URL -->
                            <div class="mb-3">
                                <label for="fileURL" class="form-label">File URL (Link of the file stored).</label>
                                <input type="url" class="form-control" id="fileURL" name="fileURL" placeholder="https://docs.google.com/document/d/12345/view?usp=drive_link" required>
                            </div>
                            <!-- File Description -->
                            <div class="mb-3">
                                <label for="fileDesc" class="form-label">File Description</label>
                                <textarea class="form-control" id="fileDesc" name="fileDesc" rows="3"></textarea>
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
                            <!-- Faculty -->
                            <div class="mb-3">
                                <label for="FacultyName" class="form-label">Faculty</label>
                                <select class="form-select" name="FacultyName" aria-label="faculty">
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
                                </select>
                            </div>
                            <!-- Course -->
                            <div class="mb-3">
                            <label for="courseName" class="form-label">Course Name (put "-" if it's not a course)</label>
                            <input type="text" class="form-control" name="courseName" id="courseName" placeholder="WIA2003 - Probability And Statistics" required>
                            </div>
                            <!-- Additional Information (Week of) -->
                            <div class="input-group mb-3">
                            <label class="input-group-text " for="weekOF">Week of (put "-" if no)</label>
                            <select class="form-select" name="weekOF" id="weekOF">
                                <option value="0" selected>-</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                            </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Contribute</button>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- add file modal end -->
                <?
                }
                ?>
                &nbsp;<a href="rank"><button class="btn btn-news" type="button"><i class="fa-solid fa-list-ol"></i></button></a>
                &nbsp;<a href="rewards"><button class="btn btn-primary" type="button"><i class="fa-solid fa-award"></i></button></a>
                <div class="text-center">
                    <div class="card shadow transparent-card">
                        <div class="card-body" style="min-height: 76vh;">
                            <div id="htmlContainer"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="core/js/jquery.ztree.core.js"></script>
    <script type="text/javascript" src="core/js/dashboard.js"></script>

    <?
    if ($isAdmin || $isContributor){
    ?>
    <script>
        function editIcon(icon) {
            // Get the value from the data-value attribute
            const editIconValue = icon.getAttribute("data-value");
            const modalBody = document.getElementById("modalBody");
            $.ajax({
                url: `edit/${editIconValue}`,
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
        function pendingButton(){
            if (hasHash(window.location.href)) {
                var pendingCurrentFolderhash = window.location.hash;
                pendingCurrentFolder = pendingCurrentFolderhash.substring(1);
            } else {
                pendingCurrentFolder = 0;
            }
            const pendingBody = document.getElementById("pendingBody");
            $.ajax({
                url: `pending/${pendingCurrentFolder}`,
                method: "GET",
                success: function (data) {
                    // Update the modal body with the fetched content
                    console.log("fetch pending data");
                    pendingBody.innerHTML = data;
    
                    // Trigger the modal to be shown
                    $('#pendingModal').modal('show');
                },
                error: function () {
                    console.error("Error loading modal content");
                }
            });
            
        }
        document.querySelector('#fileform').addEventListener('submit', function () {
            const folderIDInput = document.getElementById("folderID");
            folderIDInput.value = folderID;
        });
        document.querySelector('#folderForm').addEventListener('submit', function () {
            const folderIDInput2 = document.getElementById("folderID2");
            folderIDInput2.value = folderID2;
        });
    </script>
    <?
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>
<?php
closeConn();
?>