<?php

$email = $_POST["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

$mysqli = require __DIR__ . "/database.php";

$sql = "UPDATE user
        SET reset_token_hash = ?,
            reset_token_expires_at = ?
        WHERE email = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($mysqli->affected_rows) {

    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("chaudharykshittiz950@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="localhost/login/reset-password.php?token=$token">here</a> 
    to reset your password.

    END;

    try {

        $mail->send();

    } catch (Exception $e) {

        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

    }

}



?>


<!DOCTYPE html>
<html>

<head>
    <title>Account Activated</title>
    <meta charset="UTF-8" />
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet" />

    <style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        font-family: "Jost", sans-serif;
        /* background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e); */
        background-color: #4d40bba8;
    }

    .main {
        padding: 20px;
        text-align: center;
        width: 350px;
        height: auto;
        background: red;
        overflow: hidden;
        background: linear-gradient(to bottom, #6a5ed3, #6259c2, #464688);
        border-radius: 10px;
        box-shadow: 5px 5px 20px #534c4c;
    }

    p {
        font-size: 22px;
    }
    </style>
</head>

<body>
    <div class="main">
        <p>Message sent, please check your inbox</p>

    </div>
</body>

</html>