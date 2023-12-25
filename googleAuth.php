<?php
include 'core/conf.php';
$clientID = 'xxxxxxx.apps.googleusercontent.com'; //xxxxx
$clientSecret = 'xxxxxxx-xxxxxxx'; //xxxxx
$redirectUri = 'https://notes.ppiunimalaya.id/googleAuth.php';
$tokenRevoke = "https://oauth.googleapis.com/revoke";
if (!isset($_GET['code'])){
    $authorizationUrl = 'https://accounts.google.com/o/oauth2/v2/auth';
    
    // OAuth parameters
    $params = array(
        'response_type' => 'code',
        'client_id' => $clientID,
        'redirect_uri' => $redirectUri,
        'scope' => 'https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email',
    );
    
    // Redirect to Google OAuth authorization URL
    $redirectUrl = $authorizationUrl . '?' . http_build_query($params);
    header('Location: ' . $redirectUrl);
    exit();
}
$tokenUrl = 'https://oauth2.googleapis.com/token';
$code = $_GET['code'];

    $tokenParams = array(
        'code' => $code,
        'client_id' => $clientID,
        'client_secret' => $clientSecret,
        'redirect_uri' => $redirectUri,
        'grant_type' => 'authorization_code',
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($tokenParams));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $tokenResult = curl_exec($ch);
    curl_close($ch);
    $tokenData = json_decode($tokenResult, true);
    
    $userInfoUrl = 'https://www.googleapis.com/oauth2/v2/userinfo';
    $userInfoParams = array(
        'access_token' => $tokenData['access_token'],
    );

    $userInfoUrl .= '?' . http_build_query($userInfoParams);
    $userInfoResult = file_get_contents($userInfoUrl);
    $userInfoData = json_decode($userInfoResult, true);

    // Print user's email
    if (isset($userInfoData['email'])) {
        $email = $userInfoData['email'];
        //check if the email contains "siswa.um.edu.my";
        if (strpos($email, "@siswa.um.edu.my") == true) {
            createUser($email);
            session_regenerate_id();
            $_SESSION['email'] = $email;
            $_SESSION['is_login'] = true;
            setSecureCookie();
            //create APIKey
            
            header("location: dashboard");
        } else {
            //back to login
            header("location: login");
        }
    } else {
        echo 'Unable to fetch user email, please use "login with email" option instead!';
    }
?>