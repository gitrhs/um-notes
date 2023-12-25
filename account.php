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
function accType($type){
    switch ($type) {
  case 1:
    return "Admin";
    break;
  case 2:
    return "User";
    break;
  case 3:
    return "Contributor";
    break;
  case 4:
    return "Banned";
    break;
  case 5:
    return "Suspended";
    break;
  default:
    return "User";
}
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
        .circle {
          width: 150px;
          height: 150px;
          max-width: 100%;
          max-height: 100%;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 30px;
          font-weight: bold;
          color: #fff;
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
                        <li><a class="dropdown-item active" href="account"><i class="fa-regular fa-user"></i> Account</a></li>
                        <li><a class="dropdown-item" href="api"><i class="fa-regular fa-circle-question"></i> API</a></li>
                        <li><a class="dropdown-item" href="faq"><i class="fa-regular fa-circle-question"></i> FAQ</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex justify-content-center" style="padding: 10px; max-width: 98%">
        <!-- Menu Start -->
        <div class="card nav" style="max-width: 550px; width: 100%">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="circle" id="initialsCircle"></div>
                </div>
                <br><br>
                <form action="action/account.php" method="POST">
                    <div class="d-flex justify-content-center">
                        <div class="row" style="padding: 10px;">
                            <div class="col-md-6 col-12">
                                <h4>Name:</h4>
                            </div>
                            <div class="col-md-6 col-12">
                                <input type="text" name="username" value="<?php echo $userName; ?>">
                            </div>
                            <div class="col-md-6 col-12">
                                <h4>Email:</h4>
                            </div>
                            <div class="col-md-6 col-12">
                                <?php echo $userEmail; ?>
                            </div>
                            <div class="col-md-6 col-12">
                                <h4>Account Type:</h4>
                            </div>
                            <div class="col-md-6 col-12">
                                <?php echo accType($userType); ?>
                            </div>
                            <div class="col-md-6 col-12">
                                <h4>Point:</h4>
                            </div>
                            <div class="col-md-6 col-12">
                                <?php echo $userPoint; ?>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button onclick="window.history.go(-1)" class="btn btn-secondary">Cancel</button>&nbsp;<button type="submit" class="btn btn-news">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Menu end -->
        <!-- Content Start -->
        <div id="htmlContainer"></div>
        <!-- Content End -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script>
        // Get the full name
        const fullName = "<? echo $userName; ?>";
    
        // Extract initials (maximum 2 characters, minimum 1 character)
        const initials = fullName
          .split(' ')
          .map(word => word[0])
          .slice(0, 2) // Take the first 2 characters
          .join('');
    
        // Get a random color
        function getRandomColor() {
          const letters = '0123456789ABCDEF';
          let color = '#';
          for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
          }
          return color;
        }
        //CREDIT FOR HARISHANKAR VINOD X CHATGPT
        // Determine if the background color is too bright
        function isBright(color) {
          const brightness = ( // calculate the brightness of the color
            0.299 * parseInt(color.slice(1, 3), 16) +
            0.587 * parseInt(color.slice(3, 5), 16) +
            0.114 * parseInt(color.slice(5, 7), 16)
          ) / 255;
          return brightness > 0.5; // you can adjust the threshold as needed
        }
    
        // Set the initials, background color, and text color
        const circle = document.getElementById('initialsCircle');
        const bgColor = getRandomColor();
        circle.textContent = initials;
        circle.style.backgroundColor = bgColor;
        circle.style.color = isBright(bgColor) ? '#000' : '#fff';
</script>
</body>
</html>
<?php
closeConn();
?>