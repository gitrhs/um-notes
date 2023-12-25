<?php
include 'core/conf.php';
if (!isLogin()){
    header("location: ../login");
    exit;
}
$id = $_GET['data'];
$userPoint = getPoint();
if (empty(userType())){
    header("location: userinformation");
    exit;
}
$isAdmin = false;
if (userType() == 1){
    $isAdmin = true;
}
function access($userPoint, $point){
    if ($userPoint >= $point){
        return true;
    } else {
        return false;
    }
}
function fileSVG($type){
    switch ($type){
        case "pdf":
            $return = "/assets/svg/pdf.svg";
            break;
        case "ppt":
            $return = "/assets/svg/ppt.svg";
            break;
        case "word":
            $return = "/assets/svg/word.svg";
            break;
        case "video":
            $return = "/assets/svg/video.svg";
            break;
        case "audio":
            $return = "/assets/svg/audio.svg";
            break;
        case "link":
            $return = "/assets/svg/link.svg";
            break;
        default:
            $return = "/assets/svg/file.svg";
    }
    return $return;
}
if ($stmt = $conn->prepare("SELECT * FROM `rewards` WHERE `no` = ?")) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //check if it's a file or a folder
            //no 	name 	description 	type 	directory 	link 	point	isAPI 	kontributor 	time 	
            $type = $row['type'];
            if ($type != "folder"){
                $directory = $row['directory'];
                $name = $row['name'];
                $description = nl2br($row['description']);
                $link = $row['link'];
                $point = $row['point'];
                $isAPI = $row['isAPI'];
                $kontributor = $row['kontributor'];
                $time = $row['time'];
                $isAllowed = access($userPoint, $point);
            } else {
                echo "this is not a file";
                $stmt->close();
                $conn->close();
                exit;
            }
        }
    } else {
        echo "file not found";
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();
} else {
    echo "something went wrong on the database part";
    $conn->close();
    exit;
}
function timeDate($timestamp){
    return date("d-m-Y", $timestamp);
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
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
                        <li><a class="dropdown-item" href="../admin/index.php">Admin Page</a></li>
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
        <div style="text-align: right;">
            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#reportToogle"><i class="fa-solid fa-triangle-exclamation"></i> Report</button>
        </div>
        <div id="successAlert" style="display: none;">
            <br>
            <div class="alert alert-success" role="alert" style="text-align: center;">
            Thank you for your report! we will check it as soon as possible!
            </div>
        </div>
        <div class="card  transparent-card">
            <div class="card-body">
                <div class="d-none d-lg-block">
                    <div class="row">
                        <div class="col-12 col-lg-5">
                            <div class="d-flex justify-content-center align-items-center" style="min-height: 65vh;">
                                <div>
                                    <div class="text-center">
                                        <img style="max-width: 40%;" src="<? echo fileSVG($type); ?>">
                                    </div><br>
                                    <h1 style="text-align: center;"><? echo $name; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="d-none d-lg-block col-lg-1">
                            <div class="d-flex justify-content-center align-items-center" style="min-height: 76vh;">
                                <div class="vr"></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="d-flex justify-content-center align-items-center" style="min-height: 76vh;">
                                <div>
                                    <?
                                    if ($isAPI){
                                        ?>
                                        <div class="card modal-card shadow-lg" style="margin-bottom: 10px;">
                                            <div class="card-body">
                                                <h5><b>Rewards Key</b></h5>
                                                <a id="rewardsKey" class="text-break"><?php if ($isAllowed) {echo createRewardsAPIKey($id);} else {echo "<span style='color: red;'>xxxxxxxxxxxxxxx</span>";} ?></a>
                                                <button class="btn btn-outline-secondary mx-2" id="copyButton" data-clipboard-target="#rewardsKey">
                                                    <i class="fa fa-copy"></i> Copy
                                                </button>
                                            </div>
                                        </div>
                                        <?
                                    }
                                    ?>
                                    <div class="card modal-card shadow-lg">
                                        <div class="card-body">
                                            <h3><b>Type:</b> <? echo $type; ?></h3>
                                            <h3><b>Contributor:</b> <? echo getNamebyUserID($kontributor); ?></h3>
                                            <? if ($time != 0){
                                               ?>
                                               <h3><b>Created time:</b> <? echo timeDate($time); ?></h3><h5>
                                               <?
                                            }?>
                                            <? if (!empty($description)){
                                               ?>
                                                <br>
                                                <h3><b>Description:</b></h3>
                                                <p><? echo $description; ?></p>
                                               <?
                                            }?>
                                            <br>
                                            <button type="button" onclick="history.back()" class="btn btn-secondary">Back</button>
                                            <? if (access($userPoint, $point)){
                                            ?>
                                            <a type="button" href="<? echo $link; ?>" target="_blank" class="btn btn-news">Open</a>
                                            <?
                                            } else {
                                                ?>
                                                <a type="button" class="btn btn-secondary" disabled>Open</a>
                                                <br><br>
                                                <h5 style="color: red;"><i class="fa-solid fa-lock"></i> <? echo "$userPoint / $point"; ?></h5>
                                                <?
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-block d-lg-none">
                    <div class="text-center">
                        <img style="max-width: 30%;" src="<? echo fileSVG($type); ?>">
                    </div><br>
                    <h1 style="text-align: center;"><? echo $name; ?></h1>
                    <br><br>
                    <?
                                    if ($isAPI){
                                        ?>
                                        <div class="card modal-card shadow-lg" style="margin-bottom: 10px;">
                                            <div class="card-body">
                                                <h5><b>Rewards Key</b></h5>
                                                <a id="rewardsKey2" class="text-break"><?php if ($isAllowed) {echo createRewardsAPIKey($id);} else {echo "<span style='color: red;'>xxxxxxxxxxxxxxx</span>";} ?></a>
                                                <button class="btn btn-outline-secondary mx-2" id="copyButton2" data-clipboard-target="#rewardsKey2">
                                                    <i class="fa fa-copy"></i> Copy
                                                </button>
                                            </div>
                                        </div>
                                        <?
                                    }
                                    ?>
                    <div class="card modal-card shadow-lg">
                        <div class="card-body">
                            <h3><b>Type:</b> <? echo $type; ?></h3>
                            <h3><b>Contributor:</b> <? echo $kontributor; ?></h3>
                            <? if ($time != 0){
                            ?>
                            <h3><b>Created time:</b> <? echo timeDate($time); ?></h3><h5>
                            <?
                            }?>
                            <? if (!empty($description)){
                            ?>
                                <br>
                                <h3><b>Description:</b></h3>
                                <p><? echo $description; ?></p>
                            <?
                            }?>
                            <br>
                            <button type="button" onclick="history.back()" class="btn btn-secondary">Back</button>
                            <? if (access($userPoint, $point)){
                                        ?>
                                        <a type="button" href="<? echo $link; ?>" target="_blank" class="btn btn-news">Open</a>
                                        <?
                                        } else {
                                            ?>
                                            <a type="button" class="btn btn-secondary" disabled>Open</a>
                                            <br><br>
                                            <h5 style="color: red;"><i class="fa-solid fa-lock"></i> <? echo "$userPoint / $point"; ?></h5>
                                            <?
                                        }
                                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Report modal -->
                <div class="modal fade" id="reportToogle" tabindex="-1" aria-labelledby="reportToogleLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-card">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="reportToogleLabel">Report File</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
                      </div>
                      <form id="folderForm" method="POST" action="https://notes.ppiunimalaya.id/action/report.php?file=<?php echo $id; ?>">
                          <div class="modal-body">
                            <!-- Alert -->
                            <div class="alert alert-warning" role="alert">
                              <small>Please Report us if there is something wrong with the file.</small>
                            </div>
                            <!-- Radio Button -->
                            <p>Tell us what happened?</p>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="problem" id="problem1" value="Expired Link" checked>
                              <label class="form-check-label" for="problem1">
                                Expired Link
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="problem" id="problem2" value="Inappropriate Content">
                              <label class="form-check-label" for="problem2">
                                Inappropriate Content
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="problem" id="problem3" value="Others">
                              <label class="form-check-label" for="problem3">
                                Others
                              </label>
                            </div>
                            <br>
                            <!-- Explanation -->
                            <div class="mb-3">
                                <label for="reportExplanation" class="form-label">Explanation (Optional)</label>
                                <textarea class="form-control" id="reportExplanation" name="reportExplanation" rows="3"></textarea>
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
    <!-- Report modal end -->
    <script>
        // Check if the URL contains the specified fragment identifier
        if (window.location.hash === "#report=successful") {
            // Show the success alert
            document.getElementById("successAlert").style.display = "block";
        } else {
            // Hide the success alert
            document.getElementById("successAlert").style.display = "none";
        }
    </script>
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
        new ClipboardJS('#copyButton2');
    
        // Handle success and error events
        document.getElementById('copyButton2').addEventListener('click', function() {
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