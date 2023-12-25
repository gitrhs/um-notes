<?php
include 'core/conf.php';
if (isLogin()){
    //redirect to dashboard
    header("location: dashboard");
}
if (!isset($_SESSION['email']) || !checkOtpExp()){
    resetOTP();
    header("location: login");
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
    <link rel="stylesheet" href="core/css/main.css?6"/>
</head>
<body>
    <div class="container-xl">
        <div class="second-container">
            <div class="card nav">
                <div class="d-flex justify-content-between">
                    <a href="<? $_SERVER['REQUEST_URI']; ?>"><img src="core/img/logo.png" height="45"/></a>
                    <a href="<? $_SERVER['REQUEST_URI']; ?>/login"><button type="button" class="btn btn-login">Log In</button></a>
                </div>
            </div>
            <div class="container-fluid d-flex justify-content-center align-items-center" style="height:85vh;">
                <div class="card transparent-card2" style="width: 95%; max-width: 800px;position: relative;">
                    <div class="card-body">
                        <h3>One Time Password</h3>
                        We sent a OTP code to your email. Enter the code from the email in the field below.
                        </p>
                        <p class="text-start mb-4">
                        If you didn't get the code. please check spam or promotion section on email.
                        <br>
                        Note: Email was sent to <? echo $_SESSION['email'];?>
                        <form action="action/otp-auth.php" method="POST">
                            <div class="mb-3">
                            <div class="d-flex justify-content-center align-items-center" id="authcode-input-group">
                            <div class="authcode-input-container">
                            <input type="tel" class="form-control authcode-input" maxlength="1" name="otp[]" style="font-size: 2rem;" autofocus required>
                            </div>
                            <div class="authcode-input-container">
                            <input type="tel" class="form-control authcode-input" maxlength="1" name="otp[]" style="font-size: 2rem;" required>
                            </div>
                            <div class="authcode-input-container">
                            <input type="tel" class="form-control authcode-input" maxlength="1" name="otp[]" style="font-size: 2rem;" required>
                            </div>
                            <div class="authcode-input-container">
                            <input type="tel" class="form-control authcode-input" maxlength="1" name="otp[]" style="font-size: 2rem;" required>
                            </div>
                            <div class="authcode-input-container">
                            <input type="tel" class="form-control authcode-input" maxlength="1" name="otp[]" style="font-size: 2rem;" required>
                            </div>
                            <div class="authcode-input-container">
                            <input type="tel" class="form-control authcode-input" maxlength="1" name="otp[]" style="font-size: 2rem;" required>
                            </div>
                            </div>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                            <button class="btn btn-news" style="width: 24rem" type="submit">Verify</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
                const authcodeInputs = document.querySelectorAll('.authcode-input');
                authcodeInputs.forEach((input, index) => {
                  input.addEventListener('keydown', (event) => {
                    if (event.key !== 'Backspace') {
                      if (!/^\d$/.test(event.key)) {
                        event.preventDefault();
                      }
                    } else if (index > 0 && input.value === '') {
                      authcodeInputs[index - 1].focus();
                    }
                  });
                
                  input.addEventListener('input', () => {
                    if (/^\d$/.test(input.value)) {
                      if (index < authcodeInputs.length - 1) {
                        authcodeInputs[index + 1].focus();
                        if (authcodeInputs[index + 1].value !== '') {
                          authcodeInputs[index + 1].value = '';
                        }
                      }
                    }
                  });
                
                  input.addEventListener('click', () => {
                    if (input.value !== '') {
                      input.select();
                    }
                  });
                });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>       
</body>
</html>
<?php
closeConn();
?>