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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
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
                        <li><a class="dropdown-item active" href="api">{ API }</a></li>
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
        <div style="padding: 10px; max-width: 98%; width: 1000px;">
        <button class="btn btn-secondary" type="button"><i class="fa-solid fa-circle-question"></i></button>
        &nbsp;<a href="dashboard"><button class="btn btn-secondary" type="button"><i class="fa-solid fa-home"></i></button></a>
        <br>
        <div class="card shadow transparent-card">
            <div class="card-body">
                <h1 class="text-center coloredtext">{ API }</h1>
                <hr>
                <form action="" method="POST">
                    <h3>Your Private APIKey&nbsp;&nbsp;<button type="submit" class="btn btn-warning" name="submit">Recreate</button></h3>
                </form>
                <?php
                if (isset($_POST['submit'])){
                    createApiKey();
                    header("Location: api");
                    exit();
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <a id="privateKey" class="text-break"><?php echo getPrivateKey(); ?></a>
                            <button class="btn btn-outline-secondary" id="copyButton" data-clipboard-target="#privateKey">
                                <i class="fa fa-copy"></i> Copy
                            </button>
                        </div>
                    </div>
                </div>
                <small style="color: #f42d16;">*Note:<br>- Don't share your Private APIKey to anyone! having Private APIKey means have full access of your account!<br>- Recreate Private ApiKey also recreate the public ApiKey.</small>
                <hr>
                <h3>API for All User</h3>
                <h5>-</h5>
                <hr>
                <h3>API for Contributor & Admin</h3><br>
                <h5>1. Get User Point by user Matric Number</h5>
                <small>This API is to verify is the user already have the required amount of point or not.</small><br><br>
                <div class="card">
                    <div class="card-body">
                        https://notes.ppiunimalaya.id/core/api/point.php?matric=s123456
                    </div>
                </div><br>
                <div class="table-responsive">
                    <table class="table table-bordered border-primary">
                        <thead>
                            <tr>
                              <th scope="col">Queries</th>
                              <th scope="col">Value</th>
                              <th scope="col">Type</th>
                              <th scope="col">Required</th>
                              <th scope"col">Return</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <th scope="row">matric</th>
                              <td>Student matric number</td>
                              <td>String</td>
                              <td>true</td>
                              <td>{"email":"xxx@siswa.um.edu.my", "point":0}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br><br>
                <h5>2. Get isReached by user API</h5>
                <small>If you tick "use API for verification" option, when user go to the file page, user will get the APIKey. The APIKey is to verify is the user point is reached the minimum ammount or not.</small><br><br>
                <div class="card">
                    <div class="card-body">
                        https://notes.ppiunimalaya.id/core/api/checker.php?apikey=xxxx
                    </div>
                </div><br>
                <div class="table-responsive">
                    <table class="table table-bordered border-primary table-responsive">
                        <thead>
                            <tr>
                              <th scope="col">Queries</th>
                              <th scope="col">Value</th>
                              <th scope="col">Type</th>
                              <th scope="col">Required</th>
                              <th scope"col">Return</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <th scope="row">APIKey</th>
                              <td>User Page APIKey</td>
                              <td>String</td>
                              <td>true</td>
                              <td>{"isReached":0/1}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <!-- Content End -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script>
        // Initialize Clipboard.js
        new ClipboardJS('#copyButton');
    
        // Handle success and error events
        document.getElementById('copyButton').addEventListener('click', function() {
            var copyButton = this;
            copyButton.innerText = 'Copied!';
    
            // Reset button text after a short delay
            setTimeout(function() {
                copyButton.innerText = 'Copy';
            }, 2000);
        });
    </script>
</body>
</html>
<?php
closeConn();
?>