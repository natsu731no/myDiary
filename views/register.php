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
    <div class="bg-dark">
        <div style="height: 100vh;">
            <div class="row h-100 m-0">
                <div class="card w-25 my-auto mx-auto">
                    <div class="card-header card-header bg-white border-8">
                        <h1 class="text-center">REGISTER</h1>
                    </div>
                    <div class="card-body">
                        <form action="../actions/register.php" method="POST">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control mb-2 font-weight-bold" maxlength="15" required>
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control mb-5" minlength="8" required>
                            <button type="submit" name="btn_register" value="register" class="w-100 btn btn-success btn_block">Register</button>
                            <p class="text-center mt-3">Registered already?<a href="../views/login.php">Log in.</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="../script/bootstrap.bundle.js"></script>
</html>