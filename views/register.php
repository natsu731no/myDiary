<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <title>Register</title>
</head>
<body>
    <div class="bg-warning">
        <div style="height: 100vh;">
            <div class="row h-100 m-0">
                <div class="card w-25 my-auto mx-auto">
                    <div class="card-header card-header bg-info border-8">
                        <h1 class="text-center">REGISTER</h1>
                    </div>
                    <div class="card-body bg-info">
                        <form action="../actions/register.php" method="POST">
                        
                        
                        <div class="">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control mb-2 font-weight-bold" minlength="4" maxlength="14" required>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" minlength="8" required>
                            <input type="checkbox" name="checkbox" id="password-check" class="text-right mb-5" aria-label="Checkbox for following text input">You're able to check your password.
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
                        <div class="">
                        <button type="submit" name="btn_register" value="register" class="w-100 btn btn-dark btn_block">Register</button>
                            <p class="text-center mt-3 text-dark">Registered already?<a href="../views/login.php" class="text-dark">Log in.</a></p>
                        
                        </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="../script/bootstrap.bundle.js"></script>
</html>