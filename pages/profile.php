<?php
if (!$auth) {
    header('Location: /');
    exit;
}
?>
<style>
.form-control {
    background: #164872;
    border-radius: 11px;
    border: 0;
    color: #fff;
    padding: 10px 15px;
}

.form-control:focus {
    background: #164872;
    outline: 0;
    color: #fff;
    box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
}
</style>
<div class="nera-page-header"
    style="display: flex; align-items: center; justify-content: center; height: 120px; text-align: center; background: #0D1232;">
    <video autoplay muted loop class="background-video">
        <source src="template/video/main_bg_top.webm" type="video/webm">
        <source src="template/video/main_bg_top.mp4" type="video/mp4">
    </video>
    <div
        style="position: absolute; display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; z-index: 100; background: linear-gradient(180deg, transparent, #172057 99%);">
        <!-- <a href="/" style="position: stiky; z-index: 9999;">
            <img style="height: 100px;" src="template/img/main-logo.svg" alt="">
        </a> -->
    </div>
</div>
<div class="nera-page-content" style="background: #172057;">
    <div class="container-xxl">
        <div class="nera-profile-flex">
            <div class="nera-profile-navigation">
                <a href="#" class="navigation-page active">
                    <img src="template/img/profile-home.svg" class="icon active">
                </a>
                <a href="#" class="navigation-page">
                    <img src="template/img/profile-buy.svg" class="icon active">
                </a>
                <a href="#" class="navigation-page">
                    <img src="template/img/profile-history.svg" class="icon active">
                </a>
                <a href="#" class="navigation-page">
                    <img src="template/img/profile-chat.svg" class="icon active">
                </a>
                <a href="#" class="navigation-page">
                    <img src="template/img/profile-exit.svg" class="icon active">
                </a>
            </div>
            <div class="nera-profile-content">
                <div class="nera-profile-card" style="border: 2px solid #49DEFF; margin-bottom: 15px;">
                    <div class="nera-profile-card-title">Settings</div>
                    <!-- <p>To fully use our service, set a password</p> -->

                    <div class="mb-3">
                        <label for="input_1" class="form-label">Username</label>
                        <input type="text" class="form-control" name="password_1">
                    </div>

                    <div class="mb-3">
                        <label for="input_1" class="form-label">First name</label>
                        <input type="text" class="form-control" name="password_1">
                    </div>

                    <div class="mb-3">
                        <label for="input_1" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="password_1">
                    </div>

                    <div class="mb-3">
                        <label for="input_1" class="form-label">Discord</label>
                        <input type="text" class="form-control" name="password_1">
                    </div>

                    <div class="mb-3">
                        <label for="input_1" class="form-label">Country</label>
                        <input type="text" class="form-control" name="password_1">
                    </div>

                    <div class="nera-profile-card-title">Update password</div>

                    <div class="mb-3">
                        <label for="input_1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password_1">
                        <div style="font-size: 14px; margin-top: 10px; display: none;"
                            id="profile_updatepassword_alerts">

                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="input_2" class="form-label">Repeat Password</label>
                        <input type="password" class="form-control" name="password_2">
                    </div>
                    <button id="update_settings"
                        style="display: inline-block; width: auto; padding: 5px 30px; margin-top: 15px; font-size: 18px; background: transparent; border: 2px solid #49DEFF;"
                        class="nera-modal-button" id="modal_open_create">
                        Edit
                    </button>
                </div>

                <?php
                if ($unset_password) { ?>
                <div class="nera-profile-card" style="border: 2px solid #49DEFF; margin-bottom: 15px;">
                    <div class="nera-profile-card-title">Set Password</div>
                    <p>To fully use our service, set a password</p>

                    <div class="mb-3">
                        <label for="input_1" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password_1">
                        <div style="font-size: 14px; margin-top: 10px; display: none;"
                            id="profile_updatepassword_alerts">

                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="input_2" class="form-label">Repeat Password</label>
                        <input type="password" class="form-control" name="password_2">
                    </div>
                    <button id="update_password"
                        style="display: inline-block; width: auto; padding: 5px 30px; margin-top: 15px; font-size: 18px; background: transparent; border: 2px solid #49DEFF;"
                        class="nera-modal-button" id="modal_open_create">
                        Create Password
                    </button>
                </div>
                <?php } ?>

                <div class="nera-profile-topmenu">
                    <div class="nera-profile-neworder">
                        <div class="circle">
                            <img src="img/profile-plus.svg">
                        </div>
                        NEW ORDER
                    </div>

                    <a href="/auth/exit.php" style="text-decoration: none; color: #fff;" class="nera-profile-userinfo">
                        <div class="welcome">
                            Welcome
                            <div class="user"><?= $login ?></div>
                        </div>
                        <div class="circle">
                            <img src="template/img/profile-user.svg">
                        </div>
                    </a>
                </div>
                <div class="nera-profile-card">
                    <div class="nera-profile-card-title">Active Orders</div>

                    <table class="nera-profile-table">
                        <thead>
                            <tr>
                                <th>Game</th>
                                <th>Purchase</th>
                                <th>ID</th>
                                <th>Employee</th>
                                <th>Cost</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>
                                    <img style="height: 36px;" src="img/main-icon-lol.svg" alt="">
                                </td>
                                <td>Iron I to Master</td>
                                <td>000000</td>
                                <td>
                                    <span class="booster-name">
                                        <img style="height: 12px; margin-right: px;" src="img/profile-user.svg">
                                        Booster name
                                    </span>
                                </td>
                                <td>20$</td>
                                <td>
                                    <span class="green">Performed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm action-button">
                                        Details
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img style="height: 36px;" src="img/main-icon-lol.svg" alt="">
                                </td>
                                <td>Iron I to Master</td>
                                <td>000000</td>
                                <td>
                                    <span class="booster-name">
                                        <img style="height: 12px; margin-right: px;" src="template/img/profile-user.svg">
                                        Booster name
                                    </span>
                                </td>
                                <td>20$</td>
                                <td>
                                    <span class="green">Performed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm action-button">
                                        Details
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img style="height: 36px;" src="img/main-icon-lol.svg" alt="">
                                </td>
                                <td>Iron I to Master</td>
                                <td>000000</td>
                                <td>
                                    <span class="booster-name">
                                        <img style="height: 12px; margin-right: px;" src="template/img/profile-user.svg">
                                        Booster name
                                    </span>
                                </td>
                                <td>20$</td>
                                <td>
                                    <span class="green">Performed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm action-button">
                                        Details
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img style="height: 36px;" src="img/main-icon-lol.svg" alt="">
                                </td>
                                <td>Iron I to Master</td>
                                <td>000000</td>
                                <td>
                                    <span class="booster-name">
                                        <img style="height: 12px; margin-right: px;" src="template/img/profile-user.svg">
                                        Booster name
                                    </span>
                                </td>
                                <td>20$</td>
                                <td>
                                    <span class="red">Unpaid</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm action-button">
                                        Pay
                                        <img style="height: 14px; margin-left: 6px;" src="template/img/icon-wallet.svg">
                                    </button>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>

                    <div>
                        no data
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>