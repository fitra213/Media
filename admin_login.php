<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-title">Login Admin</div>
        <form class="book-form" action="admin_auth.php" method="POST">
            <div class="form-item">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-item">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-item">
                <input type="submit" class="btn" value="Login">
            </div>
        </form>
    </div>
</body>
</html>