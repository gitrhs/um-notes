<?php
include '../core/conf.php';
if (!isLogin()){
    header("location: login");
    exit;
}
if (empty(userType())){
    header("location: userinformation");
    exit;
}
$userType = userType();
if ($userType != 1){
    echo "unauthorized access!";
    exit;
}
$userID = getUserID();
$isAdmin = true;
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UM Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../core/css/main.css?2"/>
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
                        <li><a class="dropdown-item active" href="#">Admin Page</a></li>
                        <?php
                        }
                        ?>
                        <li><a class="dropdown-item" href="../dashboard"><i class="fa-solid fa-pager"></i> Dashboard</a></li>
                        <li><a class="dropdown-item" href="../account"><i class="fa-regular fa-user"></i> Account</a></li>
                        <li><a class="dropdown-item" href="../api">{ API }</a></li>
                        <li><a class="dropdown-item" href="../faq"><i class="fa-regular fa-circle-question"></i> FAQ</a></li>
                        <li><a class="dropdown-item" href="../logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="padding: 10px; max-width: 98%">
        <!-- Menu Start -->
        <div class="d-flex justify-content-center flex-wrap">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked>
            <label class="btn btn-outline-info admin-btn" for="btnradio1">User</label>
            
            <input type="radio" class="btn-check btn-outline-info admin-btn" name="btnradio" id="btnradio3">
            <label class="btn btn-outline-info admin-btn" for="btnradio3">Report</label>
        </div>
        <br>
        <div class="text-center" id="userList">
            <h1>User Datatable</h1>
            <table id="user" class="table table-striped" style="max-width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>email</th>
                        <th>type</th>
                        <th>Status</th>
                        <th>point</th>
                        <th>edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                    //get data from db
                    $getdata = "SELECT * FROM `user`";
                    $result = $conn->query($getdata);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $type = $row['type'];
                            $noUserID = $row['no'];
                            $userStatus = $row['status'];
                            $point = $row['point'];
                            if ($type == 1){
                                //it's admin
                                $typeuser = '<span class="badge text-bg-success">Admin</span>';
                            } else if ($type == 3){
                                //it's Contributor
                                $typeuser = '<span class="badge text-bg-primary">Contributor</span>';
                            } else {
                                //it's user
                                $typeuser = '<span class="badge text-bg-secondary">User</span>';
                            }
                    ?>
                    <tr>
                        <td><? echo htmlspecialchars($row['name']); ?></td>
                        <td><? echo htmlspecialchars($row['email']); ?></td>
                        <td><? echo $typeuser; ?></td>
                        <td>
                            <? if ($userStatus == 0){
                                echo '<span class="badge text-bg-success">Active</span>';
                            } else if ($userStatus == 1){
                                echo '<span class="badge text-bg-warning">Banned</span>';
                            } else {
                                echo '<span class="badge text-bg-danger">Suspended</span>';
                            }
                            ?>
                        </td>
                        <td><? echo $point; ?></td>
                        <td>
                            <? if ($userID != $noUserID){
                                ?>
                                <button type="button" class="btn btn-secondary" onclick="editIcon(this)" data-value="<? echo $noUserID; ?>"><i class="fa-solid fa-pen-to-square"></i></button>&nbsp;&nbsp;
                                <button type="button" class="btn btn-warning" onclick="editUserStatus(this)" data-value="<? echo $noUserID; ?>"><i class="fa-solid fa-triangle-exclamation"></i></button>
                                <?
                            } else {
                            ?>
                            You can't edit yourself!
                            <?
                            }?>
                        </td>
                    </tr>
                    <?
                        }
                    }
                    ?>
                    </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>email</th>
                        <th>type</th>
                        <th>Status</th>
                        <th>point</th>
                        <th>edit</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-center" id="SettingList" style="display:none;">
            <div class="card shadow transparent-card">
                <div class="card-body" style="text-align: left;">
                    <h3># Report</h3>
                    <table id="reportcard" class="table table-striped" style="max-width:100%">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>Problem</th>
                                <th>Explanation</th>
                                <th>Reporter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?
                            //get data from db
                            $getdata2 = "SELECT * FROM `report`";
                            $result2 = $conn->query($getdata2);
                            if ($result2->num_rows > 0) {
                                while ($row = $result2->fetch_assoc()) {
                                    //no 	fileID 	userID 	problem 	reportExplanation 	
                                    $fileID = $row['fileID'];
                                    $userID = $row['userID'];
                                    $problem = $row['problem'];
                                    $reportExplanation = $row['reportExplanation'];
                            ?>
                            <tr>
                                <td>
                                    <a href="../file/<? echo $fileID; ?>"><button type="btn" class="btn btn-news">File <? echo $fileID; ?></button></a>
                                </td>
                                <td><? echo $problem; ?></td>
                                <td><? echo $reportExplanation; ?></td>
                                <td><? echo getNamebyUserID($userID); ?></td>
                                <td>
                                    <button type="button" class="btn btn-success" style="color: white; ">&#10003;</button>
                                </td>
                            </tr>
                            <?
                                }
                            }
                            ?>
                            </tbody>
                        <tfoot>
                            <tr>
                                 <th>File</th>
                                <th>Problem</th>
                                <th>Explanation</th>
                                <th>Reporter</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="card shadow transparent-card">
                <div class="card-body" style="text-align: left;">
                    <h3>Analytics</h3>
                </div>
            </div>
        </div>
        <!-- edit modal -->
                <div class="modal" id="editModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-card">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                      </div>
                      <div class="modal-body" id="modalBody"></div>
                    </div>
                  </div>
                </div>
                <div class="modal" id="statusModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-card">
                      <div class="modal-header">
                        <h5 class="modal-title">Edit User Status</h5>
                      </div>
                      <div class="modal-body" id="modalBody2"></div>
                    </div>
                  </div>
                </div>
                <!-- edit modal end -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script>
        new DataTable('#user');
        new DataTable('#reportcard');
    </script>
    <script>
        function editIcon(icon) {
            // Get the value from the data-value attribute
            const editIconValue = icon.getAttribute("data-value");
            const modalBody = document.getElementById("modalBody");
            $.ajax({
                url: `editUser/${editIconValue}`,
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
        function editUserStatus(status) {
            // Get the value from the data-value attribute
            const editIconValue2 = status.getAttribute("data-value");
            const modalBody2 = document.getElementById("modalBody2");
            $.ajax({
                url: `editUserStatus/${editIconValue2}`,
                method: "GET",
                success: function (data) {
                    // Update the modal body with the fetched content
                    modalBody2.innerHTML = data;
    
                    // Trigger the modal to be shown
                    $('#statusModal').modal('show');
                },
                error: function () {
                    console.error("Error loading modal content");
                }
            });
        }
        // Use jQuery to handle radio button click event
        $(document).ready(function () {
            // Initial state
            $("#userList").show();
            $("#SettingList").hide();
    
            // Toggle visibility based on radio button click
            $("input[name='btnradio']").change(function () {
                if ($("#btnradio1").prop("checked")) {
                    $("#userList").show();
                    $("#SettingList").hide();
                } else if ($("#btnradio3").prop("checked")) {
                    $("#userList").hide();
                    $("#SettingList").show();
                }
            });
        });
    </script>
</body>
</html>
<?php
closeConn();
?>