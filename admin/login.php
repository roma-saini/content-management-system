<?php
session_start();
include "../includes/db.php";

$error = "";
$entered_username = "";

if(isset($_POST['login']))
{
    $entered_username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM admins
            WHERE username='$entered_username'
            AND password='$password'";

    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        $_SESSION['admin'] = $entered_username;

        header("Location: dashboard.php");
        exit;
    }
    else
    {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Admin Login</title>

```
<style>
    *{
        box-sizing:border-box;
        margin:0;
        padding:0;
        font-family:'Segoe UI',sans-serif;
    }

    body{
        height:100vh;
        background:
        linear-gradient(
            rgba(0,0,0,0.3),
            rgba(0,0,0,0.3)
        ),
        url('https://img.magnific.com/free-vector/abstract-low-poly-connections-background_1048-10316.jpg?semt=ais_hybrid&w=740&q=80')
        no-repeat center center/cover;

        display:flex;
        justify-content:center;
        align-items:center;
    }

    .login-container{
        width:350px;
        background:rgba(255,255,255,0.95);
        padding:40px;
        border-radius:12px;
        box-shadow:0 10px 25px rgba(0,0,0,0.25);
    }

    .login-container h2{
        text-align:center;
        margin-bottom:25px;
        color:#333;
    }

    .login-container input[type="text"],
    .login-container input[type="password"]{
        width:100%;
        padding:12px;
        margin-bottom:15px;
        border:1px solid #ccc;
        border-radius:6px;
        font-size:15px;
    }

    .login-container input[type="submit"]{
        width:100%;
        background:#2c3e50;
        color:#fff;
        border:none;
        padding:12px;
        border-radius:6px;
        font-size:16px;
        cursor:pointer;
    }

    .login-container input[type="submit"]:hover{
        background:#1a252f;
    }

    .message{
        text-align:center;
        color:red;
        margin-top:10px;
        font-size:14px;
    }

    .note{
        text-align:center;
        margin-top:12px;
        color:#555;
        font-size:12px;
    }
</style>
```

</head>
<body>

<div class="login-container">

```
<h2>Admin Login</h2>

<form method="POST">

    <input type="text"
           name="username"
           placeholder="Admin Username"
           required
           value="<?= htmlspecialchars($entered_username) ?>">

    <input type="password"
           name="password"
           placeholder="Password"
           required>

    <input type="submit"
           name="login"
           value="Login">

    <?php if(!empty($error)) { ?>
        <div class="message">
            <?= $error ?>
        </div>
    <?php } ?>

    <div class="note">
        Only authorized users can access this panel.
    </div>

</form>
```

</div>

</body>
</html>
