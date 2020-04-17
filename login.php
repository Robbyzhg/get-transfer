<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootstrap.min.js.map"></script>
</head>
<style>
    body{
        background-color: #2ecc71;
    }
    .card {
        margin-left: 400px;
        box-shadow: 10px 10px 10px rgba(0,0,0,0.8);
        border-radius: 10px;
    }
</style>
<body>
    <br><br><br><br><br><br><br><br>
    <div class="container">
        <div class="card text-center" style="width: 20rem">
            <h2 class="text-center card-title">Login</h2>
            <form action="" method="post">
                <div class="form-group">
                    <input placeholder="Username" type="text" name="username" class="form-control rounded-pill">
                </div>
                <div class="form-group">
                    <input placeholder="Password" type="password" name="password" class="form-control rounded-pill">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Login" class="form-control btn btn-success rounded-pill">
                </div>
                <a href="register.php">Belum punya akun?</a>
            </form>
        </div>
    </div>
</body>
</html>