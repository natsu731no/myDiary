<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <title>Log in</title>
</head>
<body class="bg-dark">
    <div style="height: 100vh">
        <div class="row h-100 m-0">
            <div class="card w-25 mx-auto my-auto">
                <div class="card-header bg-light border-0">
                    <h1 class="text-center text-dark">LOGIN</h1>
                </div>
                <div class="card-body bg-light">
                    <form action="../actions/login.php" method="post">
                        <input type="text" name="username" placeholder="USERNAME" class="form-control mb-2" required autofocus>
                        <input type="password" name="password" placeholder="PASSWORD" class="form-control mb-25">
                        <!-- <button type="submit" class="btn btn-light btn-block">Log in</button> -->
                    
                        <div class="py-3">
                            <button type="submit" name="btn_mainPage" value="login" class="btn btn-success btn-block">Log in</button>
                        </div>
                    </form>
                    <p class="text-center mt-3 small"><a href="register.php">Create Account</a></p>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script src="../script/bootstrap.bundle.js"></script>
</html>