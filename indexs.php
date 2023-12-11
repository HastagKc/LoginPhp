<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="UTF-8">

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
        background-color: #4d40bba8;
    }

    .main {
        padding: 30px 10px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 500px;
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
        background: #573B8A;
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

    span {
        font-size: 22px;
        font-weight: bold;
    }

    a {
        text-decoration: none;
        color: #fff;
    }
    </style>
</head>

<body>

    <div class="main">

        <h1>Welcome To Dashboard</h1>

        <?php if (isset($user)): ?>


        <h3>
            <span>Hello,</span> <?= htmlspecialchars($user["name"]) ?>
        </h3>

        <button><a href="logout.php">Log Out</a></button>
    </div>


    <!-- else  -->

    <?php else: ?>

    <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>

    <?php endif; ?>

</body>

</html>