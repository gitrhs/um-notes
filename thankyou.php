<?php
include 'core/conf.php';
$isAdmin = false;
if (!isLogin()){
    header("location: ../login");
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
$userName = getName();
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
    <style>
        .modal-card{
            background-color: #181b21;
            color: white;
            border-radius:20px;
            border: 1px solid black;
        }
        .list-group-item{
            background-color: #111317;
            color: #c4c5c5;
        }
        .highlight{
            color: #00d69f;
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
        <div class="card transparent-card">
            <div class="card-body">
                <div style="display: flex; justify-content: center; align-items: center; height: 78vh;">
                    <div class="text-center" style="max-width: 1000px"> 
                        <h1><span class="highlight">Thank you</span> for Your Contribution!</h1>
                        <h4>
                            Hello <span class="highlight"><?php echo $userName; ?></span>! <br><br>
                            🎉 Big kudos to you for contributing to UM Notes! 🚀 Your file has been <span class="highlight">successfully added</span>, and we're thrilled to have your valuable input.<br><br>
                            🔍 Please note that our team <span class="highlight">will review your file shortly</span> to ensure its quality and relevance. Once checked and approved, it will be available for the entire UM Notes community.<br><br>
                            🌐 Want to explore more? Dive into UM Notes to discover other incredible contributions or add more files yourself. Your participation is shaping UM Notes into a fantastic resource for everyone.<br><br>
                            Thanks a bunch for being part of the UM Notes journey. Your patience during the review process is highly appreciated, and your input helps make UM Notes a go-to hub for knowledge-sharing among UM students.<br><br>
                            Cheers,<br>
                            UM Notes Team
                        </h4>
                        <a href="dashboard"><button class="btn btn-news">Back to dashboard</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>
<?php
closeConn();
?>