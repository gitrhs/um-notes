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
$userType = userType();
$userID = getUserID();
$userName = getName();
$userEmail = getEmail();
$userPoint = getPoint(); 
if ($userType == 1){
    $isAdmin = true;
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
        <div style="padding: 10px; max-width: 98%; width: 800px;">
        <button class="btn btn-secondary" type="button"><i class="fa-solid fa-circle-question"></i></button>
        &nbsp;<a href="dashboard"><button class="btn btn-secondary" type="button"><i class="fa-solid fa-home"></i></button></a>
        &nbsp;<a href="rewards"><button class="btn btn-primary" type="button"><i class="fa-solid fa-award"></i></button></a>
        <br>
        <div class="card shadow transparent-card">
            <div class="card-body">
                <h1 class="coloredtext" style="text-align: center;"><i class="fa-solid fa-trophy" style="color: #fcc201;"></i> Contributor Rank (#20)</h1>
 
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Point</th>
                        </tr>
                    </thead>
                    <tbody class="table-striped">
                        <?php
                        $sql = "SELECT * FROM user WHERE point >= 1 ORDER BY point DESC LIMIT 20";
                        $result = $conn->query($sql);
                        
                        if ($result) {
                            // Check if there are any rows returned
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                $count = 1;
                                while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                          <th scope="row"><? echo $count; ?></th>
                          <td><? echo htmlspecialchars($row['name']); ?></td>
                          <td><? echo $row['point']; ?></td>
                        </tr>
                        <?
                                    $count++;
                                }
                            } else {
                                echo "No rows found.";
                            }
                        
                            // Free the result set
                            $result->free();
                        } else {
                            echo "Error executing query: " . $conn->error;
                        }
                        ?>
                    </tbody>   
                </table>
            </div>
        </div>
        </div>
        <!-- Content End -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>
<?php
closeConn();
?>