<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/booster-dashboard/config.php');

    if ($isBooster) {
        header("Location: /booster-dashboard/panel.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neraboost Booster Dashboard Login</title>

    <link rel="stylesheet" href="/template/css/bootstrap.min.css">
    <script src="/template/js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <style>
    body {
        /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
        color: #333;
        /* background-color: #f5f5f5; */
    }

    .booster-login-container {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .booster-login-card {
        display: inline-block;
        /* box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .25); */
        /* border-radius: 30px; */
        margin: 20px;
        position: relative;
        /* margin-bottom: 50px; */
        /* transition: all .2s ease-in-out; */
        padding: 30px;
        width: 100%;
        max-width: 560px;
    }

    .booster-input {
        border-radius: 30px;
        font-size: 20px;
        margin: 15px 0;
        padding: 10px 25px;
    }

    .booster-login-button {
        width: 100%;
        border-radius: 30px;
        min-height: 60px;
        position: relative;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        /* color: rgba(255, 255, 255, .95); */
        font-size: 20px;
        background: #140c54;
        font-weight: 700;
    }

    .booster-login-button:hover,
    .booster-login-button:focus,
    .booster-login-button:active {
        background: #1d1463;
    }
    </style>

</head>

<body>
    <div
        style="position: fixed; top: 0px; left: 0px; height: 200px; width: 100%; background: linear-gradient(to top, transparent, rgb(23 32 87 / 55%));">

    </div>
    <div class="booster-login-container">
        <div class="booster-login-card">
            <div style="text-align: center; font-size: 50px; color: #0D1232; font-weight: 800;">
                Signin
            </div>

            <div class="d-flex justify-content-center">
                <div
                    style="width: 50%; height: 4px; border-radius: 4px; background: linear-gradient(90deg, #070070, #300045); margin-top: 20px; margin-bottom: 5px;">

                </div>
            </div>

            <!-- <div style="opacity: 0.75; text-align: center; margin-top: 10px; font-size: 22px;">
                <i class="bi bi-person-vcard-fill"></i> Enter your email and password sent by the moderator to your
                email or
                <i class="bi bi-discord"></i> discord
            </div> -->

            <?php
                if(isset($_GET['error'])){
                    echo '
                    <div onclick="$(this).fadeOut(500);" class="alert alert-warning" role="alert" style="border-radius: 30px; margin-top: 30px;">
                        Invalid password or email. Try again or write to the moderator or support
                    </div>
                    ';
                }
            ?>

            <form action="/booster-dashboard/api/v1/login.class.php" method="POST" style="margin: 30px 0;">
                <input type="email" name="email" class="form-control booster-input" placeholder="Email">
                <input type="password" name="password" class="form-control booster-input" placeholder="Password">

                <div style="margin-left: 10px; margin-top: 20px; margin-bottom: -10px;">
                    <div class="form-check" style="font-size: 18px;">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                        <label class="form-check-label" for="flexCheckChecked">
                            Remember me
                        </label>
                    </div>
                </div>

                <div style="margin-top: 30px;">
                    <button type="submit" class="btn btn-dark booster-login-button">
                        <img style="position: absolute; height: 200px; opacity: 0.33;"
                            src="https://neraboost.com/template/img/main-logo.svg" alt="">
                        Lets Boost
                    </button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>