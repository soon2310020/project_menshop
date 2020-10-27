<?php
//echo "<pre>";
//print_r($user);
//echo "</pre>";
$username=$user['username'];
$password=$user['password'];
$email=$user['email'];

?>
<div style="text-align: center; "><h1>user profile</h1></div>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username"
               value="<?php echo isset($user['username']) ? $user['username'] : '' ?>" class="form-control" readonly/>
    </div>
    <div class="form-group">
        <label for="password">old Password </label>
        <input type="password" name="old_password" id="password" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="password_confirm">new password </label>
        <input type="password" name="new_password" id="password_new" value="" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="first_name">First_name</label>
        <input type="text" name="first_name" id="first_name"
               value="<?php echo isset($user['first_name'])? $user['first_name'] :'' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="last_name">Last_name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo isset($user['last_name']) ? $user['last_name'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="number" name="phone" id="phone" value="<?php echo isset($user['phone']) ? $user['phone'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo isset($user['email']) ? $user['email'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="<?php echo isset($user['address']) ? $user['address'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" id="avatar" class="form-control"/>
        <img src="#" id="img-preview" style="display: none" width="100" height="100"/>
        <img src="<?php echo isset($user['avatar'])?'assets/uploads/user_avatars/'.$user['avatar']:''?>" class="img-thumbnail" style="display: block" width="200px">
    </div>
    <div class="form-group">
        <label for="jobs">Jobs</label>
        <input type="text" name="jobs" id="jobs" value="<?php echo isset($user['jobs']) ? $user['jobs'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="facebook">Facebook</label>
        <input type="text" name="facebook" id="facebook" value="<?php echo isset($user['facebook']) ? $user['facebook'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" class="form-control" id="status">
            <?php
            $selected_active = '';
            $selected_disabled = '';
            if (isset($user['status'])) {
                switch ($user['status']) {
                    case 0:
                        $selected_disabled = 'selected';
                        break;
                    case 1:
                        $selected_active = 'selected';
                        break;
                }
            }
            ?>
            <option value="0" <?php echo $selected_disabled; ?>>Disabled</option>
            <option value="1" <?php echo $selected_active ?>>Active</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" style="background: #44BEC7" class="btn btn-primary"/>
        <a href="index.php?controller=user&action=index" class="btn btn-default">Back</a>
    </div>
</form>


