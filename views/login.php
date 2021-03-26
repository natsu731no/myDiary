<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <script src="https://kit.fontawesome.com/f3d03e8132.js" crossorigin="anonymous"></script>
    <title>LOGIN</title>
</head>
<body class="bg-info">
    <div style="height: 100vh">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto my-auto">
                <div class="card-header bg-warning border-0">
                    <h1 class="text-center text-dark">LOGIN</h1>
                </div>
                <div class="card-body bg-warning">
                    <form action="../actions/login.php" method="post">
                    <div class="">
                        <input type="text" name="username" placeholder="USERNAME" class="form-control mb-2" maxlength="14" required autofocus>
                        <input type="password" name="password" placeholder="PASSWORD" id="password" class="form-control" minlength="8" required>
                        <input type="checkbox" name="checkbox" id="password-check" class="text-right mb-4" aria-label="Checkbox for following text input">You're able to check your password.
                        <!-- <button type="submit" class="btn btn-light btn-block">Log in</button> -->
                        </div>
                        <script>
                            var pw = document.getElementById('password');
                            var pwCheck = document.getElementById('password-check');
                            pwCheck.addEventListener('change', function() {
                                if(pwCheck.checked) {
                                    pw.setAttribute('type', 'text');
                                } else {
                                    pw.setAttribute('type', 'password');
                                }
                            }, false);
                        </script>

                        <div class="py-3">
                            <button type="submit" name="btn_mainPage" value="login" class="btn btn-dark btn-block">Log in &thinsp;<i class="fas fa-sign-in-alt"></i></button>
                        </div>
                    </form>
                    <p class="text-center mt-3 small text-dark"><a href="register.php" class="text-dark"><i class="fas fa-plus"></i> &thinsp; Create Account</a></p>
                </div>
            </div>
        </div>
    </div>
    
</body>

<script src="../script/bootstrap.bundle.js"></script>
</html>