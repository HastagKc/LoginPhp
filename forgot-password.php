<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="forgot-password.css">
</head>

<body>
    <div class="main">
        <label for="title">Forget Password</label>
        <form method="post" action="send-password-reset.php">
            <input type="email" name="email" placeholder="Email" required="" />
            <button>Send</button>
        </form>
    </div>

</body>

</html>