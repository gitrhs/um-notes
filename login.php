<?php
include 'core/conf.php';
if (isLogin()){
    //redirect to dashboard
    header("location: dashboard");
} else if (verifyLoginCookie()){
    header("location: dashboard");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UM Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="core/css/main.css?2"/>
    <link rel="icon" type="image/x-icon" href="/core/img/favicon.ico">
    <style>
        .gsi-material-button {
  -moz-user-select: none;
  -webkit-user-select: none;
  -ms-user-select: none;
  -webkit-appearance: none;
  background-color: WHITE;
  background-image: none;
  border: 1px solid #747775;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  color: #1f1f1f;
  cursor: pointer;
  font-family: 'Roboto', arial, sans-serif;
  font-size: 14px;
  height: 40px;
  letter-spacing: 0.25px;
  outline: none;
  overflow: hidden;
  padding: 0 12px;
  position: relative;
  text-align: center;
  -webkit-transition: background-color .218s, border-color .218s, box-shadow .218s;
  transition: background-color .218s, border-color .218s, box-shadow .218s;
  vertical-align: middle;
  white-space: nowrap;
  width: auto;
  max-width: 400px;
  min-width: min-content;
}

.gsi-material-button .gsi-material-button-icon {
  height: 20px;
  margin-right: 12px;
  min-width: 20px;
  width: 20px;
}

.gsi-material-button .gsi-material-button-content-wrapper {
  -webkit-align-items: center;
  align-items: center;
  display: flex;
  -webkit-flex-direction: row;
  flex-direction: row;
  -webkit-flex-wrap: nowrap;
  flex-wrap: nowrap;
  height: 100%;
  justify-content: space-between;
  position: relative;
  width: 100%;
}

.gsi-material-button .gsi-material-button-contents {
  -webkit-flex-grow: 1;
  flex-grow: 1;
  font-family: 'Roboto', arial, sans-serif;
  font-weight: 500;
  overflow: hidden;
  text-overflow: ellipsis;
  vertical-align: top;
}

.gsi-material-button .gsi-material-button-state {
  -webkit-transition: opacity .218s;
  transition: opacity .218s;
  bottom: 0;
  left: 0;
  opacity: 0;
  position: absolute;
  right: 0;
  top: 0;
}

.gsi-material-button:disabled {
  cursor: default;
  background-color: #ffffff61;
  border-color: #1f1f1f1f;
}

.gsi-material-button:disabled .gsi-material-button-contents {
  opacity: 38%;
}

.gsi-material-button:disabled .gsi-material-button-icon {
  opacity: 38%;
}

.gsi-material-button:not(:disabled):active .gsi-material-button-state, 
.gsi-material-button:not(:disabled):focus .gsi-material-button-state {
  background-color: #303030;
  opacity: 12%;
}

.gsi-material-button:not(:disabled):hover {
  -webkit-box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
  box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
}

.gsi-material-button:not(:disabled):hover .gsi-material-button-state {
  background-color: #303030;
  opacity: 8%;
}

    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="second-container">
            <div class="card nav shadow">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="index"><img src="core/img/logo.png" height="45"/></a>
                    <div>
                        <a href="index" class="mx-2"><b>Home</b></a>
                        <a href="privacyPolice" class="mx-2"><b>Privacy Police</b></a>
                        <a href="tos" class="mx-2"><b>ToS</b></a>
                        </div>
                </div>
            </div>
            <div class="container-fluid d-flex justify-content-center align-items-center" style="height:85vh;">
                <div class="card transparent-card2" style="width: 95%; max-width: 800px;position: relative;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-block d-md-none">
                                <img src="core/img/mobile.jpg" style="border-top-left-radius: 6px; border-top-right-radius: 6px;" width="100%" height="auto">
                            </div>
                            <div class="card-body">
                                <br>
                                <h1><b>Welcome to<br><span class="coloredtext">UM Notes.</span></b></h1>
                                <p>Use your university mail (@siswa.um.edu.my) to login.</p>
                                <div class="text-center">
                                    <form method="POST" action="action/loginAuth.php" class="minus10top">
                                        <div class="input-group mb-3">
                                            <input type="text" name="matricID" class="form-control searchbar" placeholder="matricID" aria-label="matricID" aria-describedby="matricID" oninput="validateInput(this)" required>
                                            <span class="input-group-text searchbar" id="matricID">@siswa.um.edu.my</span>
                                        </div>
                                        <button type="submit" class="btn btn-news" style="width: 100%; height: auto;">Log In</button>
                                    </form>
                                    <br><p>or</p>
                                    <div class="d-flex justify-content-center">
                                        <a href="googleAuth.php">
                                            <button class="gsi-material-button">
                                              <div class="gsi-material-button-state"></div>
                                              <div class="gsi-material-button-content-wrapper">
                                                <div class="gsi-material-button-icon">
                                                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: block;">
                                                    <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path>
                                                    <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"></path>
                                                    <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path>
                                                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path>
                                                    <path fill="none" d="M0 0h48v48H0z"></path>
                                                  </svg>
                                                </div>
                                                <span class="gsi-material-button-contents">Continue with Google</span>
                                                <span style="display: none;">Continue with Google</span>
                                              </div>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="col-md-6 d-none d-md-block" style="position: relative;">
                            <img src="core/img/pc.jpg" style="border-radius: 6px; position: absolute; top: 0; bottom: 0; left: 0; right: 0; width: 100%; height: 100%; object-fit: cover;" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>   
</body>
</html>
<?php
closeConn();
?>