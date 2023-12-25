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
$data = $_GET['data'];
$thatUserType = userTypebyID($data);
?>
<form method="POST" action="../action/admin/editUser.php?id=<? echo $data; ?>">
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" value="name@example.com" disabled>
    </div>
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo getNamebyUserID($data); ?>">
    </div>
    <div class="mb-3">
        <label for="point" class="form-label">Point</label>
      <input type="number" class="form-control" id="point" name="point" value="<?php echo getPointbyID($data); ?>">
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="userType" id="userType1" value="2" <?php if ($thatUserType == 2) { echo "checked"; } ?>>
      <label class="form-check-label" for="userType1">User</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="userType" id="userType2" value="3" <?php if ($thatUserType == 3) { echo "checked"; } ?>>
      <label class="form-check-label" for="userType2">Contributor</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="userType" id="userType3" value="1" <?php if ($thatUserType == 1) { echo "checked"; } ?>>
      <label class="form-check-label" for="userType3">Admin</label>
    </div>
    <br><br>
    <div style="text-align: right">
        <button type="submit" class="btn btn-news">Save</button>
    </div>
</form>