<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM user
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="reset-password.css">
</head>

<body>
    <!-- code  -->

    <div class="main">
        <div class="resetpass">
            <form method="post" action="process-reset-password.php">
                <div class="label">
                    <label for="chk" aria-hidden="true">RESET</label><br />
                    <label for="chk" aria-hidden="true">PASSWORD</label>
                </div>

                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <!-- <label for="password">New password</label> -->
                <input type="password" id="password" name="password" placeholder="New Password" required="">

                <!-- <label for="password_confirmation">Repeat password</label> -->
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Repeat Password" required="">

                <button>Send</button>
            </form>

        </div>
    </div>

</body>

</html>