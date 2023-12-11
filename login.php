<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user && $user["account_activation_hash"] === null) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: indexs.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <div class="login">

        <h1>LOGIN</h1>

        <?php if ($is_invalid): ?>
        <em>Warning!! Invalid login</em>
        <?php endif; ?>

        <form method="post">

            <!-- Email  -->

            <input type="email" autocomplete="off" placeholder="Email" name="email" id="email"
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            <!-- Password -->
            <input type="password" placeholder="Password" name="password" id="password">

            <button>Log in</button>
        </form>

        <a href="forgot-password.php">Forgot password?</a>
        <a href="signup.html">Sign Up</a>

    </div>

</body>

</html>