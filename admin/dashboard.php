<?php
include "../includes/auth.php";
include "../includes/db.php";

$pageCount = $conn->query("SELECT COUNT(*) as c FROM pages")->fetch_assoc()['c'];
$postCount = $conn->query("SELECT COUNT(*) as c FROM posts")->fetch_assoc()['c'];
$catCount  = $conn->query("SELECT COUNT(*) as c FROM categories")->fetch_assoc()['c'];
?>

<!DOCTYPE html>

<html>
<head>
    <title>CMS Dashboard</title>
<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Segoe UI',sans-serif;
    }

    body{
        background:#f4f6f9;
    }

    .sidebar{
        width:250px;
        height:100vh;
        background:#1f2937;
        position:fixed;
        left:0;
        top:0;
        padding-top:20px;
    }

    .sidebar h2{
        color:white;
        text-align:center;
        margin-bottom:30px;
    }

    .sidebar a{
        display:block;
        color:white;
        text-decoration:none;
        padding:15px 20px;
        transition:.3s;
    }

    .sidebar a:hover{
        background:#374151;
    }

    .main{
        margin-left:250px;
        padding:25px;
    }

    .topbar{
        background:white;
        padding:20px;
        border-radius:10px;
        box-shadow:0 2px 10px rgba(0,0,0,.1);
        margin-bottom:25px;
    }

    .topbar h1{
        color:#333;
    }

    .cards{
        display:flex;
        gap:20px;
        flex-wrap:wrap;
    }

    .card{
        flex:1;
        min-width:220px;
        color:white;
        padding:25px;
        border-radius:12px;
        box-shadow:0 4px 10px rgba(0,0,0,.1);
    }

    .pages{
        background:#2563eb;
    }

    .posts{
        background:#16a34a;
    }

    .categories{
        background:#dc2626;
    }

    .card h3{
        font-size:18px;
        margin-bottom:10px;
    }

    .card p{
        font-size:35px;
        font-weight:bold;
    }

    .actions{
        margin-top:30px;
        background:white;
        padding:20px;
        border-radius:10px;
        box-shadow:0 2px 10px rgba(0,0,0,.1);
    }

    .actions h3{
        margin-bottom:15px;
    }

    .btn{
        display:inline-block;
        text-decoration:none;
        color:white;
        padding:12px 18px;
        border-radius:6px;
        margin-right:10px;
        margin-top:10px;
    }

    .btn-page{
        background:#2563eb;
    }

    .btn-post{
        background:#16a34a;
    }

    .btn-cat{
        background:#dc2626;
    }

    .activity{
        margin-top:30px;
        background:white;
        padding:20px;
        border-radius:10px;
        box-shadow:0 2px 10px rgba(0,0,0,.1);
    }

    .activity ul{
        margin-top:10px;
        padding-left:20px;
    }

    .activity li{
        margin-bottom:8px;
    }
</style>

</head>

<body>

<div class="sidebar">

<h2>CMS Panel</h2>

<a href="dashboard.php">📊 Dashboard</a>
<a href="pages.php">📄 Pages</a>
<a href="categories.php">📁 Categories</a>
<a href="posts.php">📝 Posts</a>
<a href="logout.php">🚪 Logout</a>

</div>

<div class="main">

<div class="topbar">
    <h1>Welcome, <?= $_SESSION['admin']; ?> 👋</h1>
    <p>Manage your website content from here.</p>
</div>

<div class="cards">

    <div class="card pages">
        <h3>Total Pages</h3>
        <p><?= $pageCount; ?></p>
    </div>

    <div class="card posts">
        <h3>Total Posts</h3>
        <p><?= $postCount; ?></p>
    </div>

    <div class="card categories">
        <h3>Total Categories</h3>
        <p><?= $catCount; ?></p>
    </div>

</div>

<div class="actions">

    <h3>Quick Actions</h3>

    <a href="add-page.php" class="btn btn-page">
        + Add Page
    </a>

    <a href="add-post.php" class="btn btn-post">
        + Add Post
    </a>

    <a href="add-category.php" class="btn btn-cat">
        + Add Category
    </a>

</div>

<div class="activity">

    <h3>System Summary</h3>

    <ul>
        <li>Total Pages: <?= $pageCount; ?></li>
        <li>Total Posts: <?= $postCount; ?></li>
        <li>Total Categories: <?= $catCount; ?></li>
        <li>Logged in as: <?= $_SESSION['admin']; ?></li>
    </ul>

</div>

</div>

</body>
</html>
