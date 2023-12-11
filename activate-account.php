<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM user
        WHERE account_activation_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

$sql = "UPDATE user
        SET account_activation_hash = NULL
        WHERE id = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $user["id"]);

$stmt->execute();

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

    button {
        width: 60%;
        height: 40px;
        margin: 10px auto;
        justify-content: center;
        display: block;
        color: #fff;
        background: #573b8a;
        font-size: 1em;
        font-weight: bold;
        margin-top: 20px;
        outline: none;
        border: none;
        border-radius: 5px;
        transition: 0.2s ease-in;
        cursor: pointer;
    }

    button:hover {
        background: #6d44b8;
    }

    a {
        text-decoration: none;
        font-size: 18px;
        color: #fff;
    }
    </style>
</head>

<body>
    <div class="main">
        <h1>Account Activated</h1>

        <p>Account activated successfully. You can now</p>
        <button><a href="login.php">log in</a></button>
    </div>
</body>

</html>