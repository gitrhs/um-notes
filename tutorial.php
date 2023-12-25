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
    <link rel="stylesheet" href="wizard/assets/css/bd-wizard.css?10">
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
        .highlight-border{
            border: 2px solid #00d69f;
            border-radius: 20px;
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
        
        <div class="container">
          <div id="wizard">
            <h3>
              <div class="media">
                <div class="bd-wizard-step-icon">&#x1F44B;</div>
                <div class="media-body">
                  <div class="bd-wizard-step-title">Welcome</div>
                  <div class="bd-wizard-step-subtitle">Welcome to UM Notes</div>
                </div>
              </div>
            </h3>
            <section>
              <div class="content-wrapper">
                <h1 class="section-heading">Welcome to <span class="highlight">UM Notes</span></h1>
                <h4 style="line-height: 1.4;"><i>“<span class="highlight">UM Notes</span>”</i>, a place for UM students to <span class="highlight">share their notes and lecture slides</span>. But guess what? UM Notes isn't just for the usual uni stuff; you can share any file, <span class="highlight">literaly anything!</span></h4>
                <small>*As long as it's helpful to others ya...</small>
              </div>
            </section>
            <h3>
              <div class="media">
                <div class="bd-wizard-step-icon"><i class="fa-solid fa-upload"></i></div>
                <div class="media-body">
                  <div class="bd-wizard-step-title">Upload file</div>
                  <div class="bd-wizard-step-subtitle">How to Upload</div>
                </div>
              </div>
            </h3>
            <section>
              <div class="content-wrapper">
                <h1 class="section-heading">Here's how you can <span class="highlight">upload the file</span></h1>
                <ol>
                    <h5 style="margin-bottom: -3px;"><li>Upload your file to your favorite <span class="highlight">cloud storage</span></li></h5>
                    <small style="color: #c8c8c8;">(Google Drive, OneDrive, Mega, DropBox, etc.)</small><br><br>
                    <h5 style="margin-bottom: -3px;"><li><span class="highlight">Copy the Link</span> of the file</li></h5><br>
                    <img class="highlight-border" src="//notes.ppiunimalaya.id/assets/images/tutorial/t1.png" width="100%">
                    <small style="color: #c8c8c8;">*Don't forget to make the link public</small><br><br>
                    <h5 style="margin-bottom: -3px;"><li>Go to UM Notes Dashboard and click "<span class="highlight">Add file</span>" button</li></h5><br>
                    <img class="highlight-border" src="//notes.ppiunimalaya.id/assets/images/tutorial/t2.png" width="100%"><br><br>
                    <h5 style="margin-bottom: -3px;"><li><span class="highlight">Fill the form</span> and click "contribute" button</li></h5><br>
                    <img class="highlight-border" src="//notes.ppiunimalaya.id/assets/images/tutorial/t3.png" width="100%"><br><br>
                    <h5 style="margin-bottom: -3px;"><li><span class="highlight">Done!</span> your file will be added after admin/contributor verify the file.</li></h5>
                </ol>
              </div>
            </section>
            <h3>
              <div class="media">
                <div class="bd-wizard-step-icon"><i class="fa-solid fa-coins"></i></div>
                <div class="media-body">
                  <div class="bd-wizard-step-title">Rewards</div>
                  <div class="bd-wizard-step-subtitle">Claim a rewards</div>
                </div>
              </div>
            </h3>
            <section>
              <div class="content-wrapper">
                <h1 class="section-heading"><span class="highlight">Rewards</span> for user that contribute</h1>
                <h4 style="line-height: 1.4;"><span class="highlight">We appreciate your contributions</span> big time! For <span class="highlight">every file</span> you share on the platform, you <span class="highlight">get 7 points</span>. Collect these points and swap them for some cool rewards on our <span class="highlight">Rewards Page</span>. It's our way of saying thanks for helping us build this awesome knowledge-sharing community.</h4>
              </div>
            </section>
            <h3>
              <div class="media">
                <div class="bd-wizard-step-icon"><i class="fa-solid fa-users"></i></div>
                <div class="media-body">
                  <div class="bd-wizard-step-title">Contributor</div>
                  <div class="bd-wizard-step-subtitle">Become a contributor</div>
                </div>
              </div>
            </h3>
            <section>
              <div class="content-wrapper">
                <h1 class="section-heading"><span class="highlight">What is</span> a Contributor?</h1>
                <h4 style="line-height: 1.4;">Ever thought about being the driving force behind UM Notes? That's where our <span class="highlight">Contributor role</span> comes in! As a Contributor, you're <span class="highlight">not just a student</span>; you're a superhero dedicated to <span class="highlight">maintaining the UM Notes platform</span> and keeping it as sleek as possible.</h4><br>
                <h1 class="section-heading">What does a <span class="highlight">Contributor do</span>?</h1>
                <h4 style="line-height: 1.4;">
                    You're the unsung hero making sure UM Notes is a smooth sail for everyone. Your tasks include: <br>
                    <ul>
                        <li><span class="highlight">Approving pending files</span> with a keen eye for quality.</li>
                        <li><span class="highlight">Creating new files and folders</span> freely, no waiting required!</li>
                    </ul>
                </h4><br>
                <h1 class="section-heading"><span class="highlight">Why</span> be a Contributor?</h1>
                <h4 style="line-height: 1.4;">
                    <ul>
                        <li><span class="highlight">Contribute</span> to the awesome UM community.</li>
                        <li><span class="highlight">Get known</span> among fellow students – your name appears on the file pages for your contributions!</li>
                        <li>Join the <span class="highlight">leaderboard</span> as one of the top contributors!</li>
                    </ul>
                </h4><br>
                <h1 class="section-heading"><span class="highlight">How to</span> join as a Contributor:</h1>
                <h4 style="line-height: 1.4;">
                    Contact the admin via <a class="highlight" href="//wa.me/+60102022377">Whatsapp</a>
                </h4>
              </div>  
            </section>
          </div>
        </div>
        
        
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="wizard/assets/js/jquery.steps.min.js"></script>
    <script src="wizard/assets/js/bd-wizard.js?123433"></script>
</body>
</html>
<?php
closeConn();
?>