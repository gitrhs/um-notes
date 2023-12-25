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
$userStatus = userStatusbyID($data);
?>
<form method="POST" action="../action/admin/editUser.php?id=<? echo $data; ?>">
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo getNamebyUserID($data); ?>" disabled>
    </div>
    <button type="button" class="btn btn-success" <? if ($userStatus == 0){echo "disabled";} ?>>ReActive</button>
    <button type="button" class="btn btn-secondary" <? if ($userStatus == 1){echo "disabled";} ?>>Ban</button>
    <button type="button" class="btn btn-warning" <? if ($userStatus == 2){echo "disabled";} ?>>Suspend</button>
    <button type="button" class="btn btn-danger">Delete</button>
</form>