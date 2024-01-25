<!DOCTYPE html>
<html lang="th">

<head>
    <title>WAREHOUSE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= base_url("") ?>static/login/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url("") ?>static/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url("") ?>static/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url("") ?>static/login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url("") ?>static/login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url("") ?>static/login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url("") ?>static/login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url("") ?>static/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url("") ?>static/login/css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100 bg-light" >
            <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
                <form class="login100-form validate-form flex-sb flex-w" action="<?= base_url("auth/submitLogin") ?>"
                    method="post">
                    <input type="hidden" name="type" value="0">

                    <span class="login100-form-title p-b-53">
                        เข้าสู่ระบบผู้ดูแล
                    </span>

                    <div class="p-t-31 p-b-9">
                        <span class="txt1">
                            Username
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="text" name="AD_USERNAME" value="ADMIN">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="p-t-13 p-b-9">
                        <span class="txt1">
                            Password
                        </span>

                        <a href="<?= base_url("auth/loginEm") ?>" class="txt2 bo1 m-l-5">
                            สำหรับพนักงาน
                        </a>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="AD_PASSWORD" value="ADMIN">
                        <span class="focus-input100"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-17">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="<?= base_url("static/login/vendor/jquery/jquery-3.2.1.min.js") ?>"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url("static/login/vendor/animsition/js/animsition.min.js") ?>"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url("static/login/vendor/bootstrap/js/popper.js") ?>"></script>
    <script src="<?= base_url("static/login/vendor/bootstrap/js/bootstrap.min.js") ?>"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url("static/login/vendor/select2/select2.min.js") ?>"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url("static/login/vendor/daterangepicker/moment.min.js") ?>"></script>
    <script src="<?= base_url("static/login/vendor/daterangepicker/daterangepicker.js") ?>"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url("static/login/vendor/countdowntime/countdowntime.js") ?>"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url("static/login/js/main.js") ?>"></script>

</body>

</html>