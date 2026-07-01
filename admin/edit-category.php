<?php
include "../includes/auth.php";
include "../includes/db.php";

$id = $_GET['id'] ?? 0;

$result = $conn->query("SELECT * FROM categories WHERE id=$id");
$data = $result->fetch_assoc();

if(!$data)
{
    echo "<h2>Category Not Found!</h2>";
    echo "<a href='categories.php'>Back to Categories</a>";
    exit;
}

if(isset($_POST['update']))
{
    $name = $_POST['name'];

    $conn->query("
        UPDATE categories
        SET name='$name'
        WHERE id=$id
    ");

    echo "<script>
            alert('Category Updated Successfully');
            window.location='categories.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Category</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',sans-serif;}
body{background:#f4f6f9;}
.container{width:60%;margin:40px auto;}
.back-btn{
display:inline-block;
margin-bottom:20px;
text-decoration:none;
color:#2563eb;
font-weight:bold;
}
.form-box{
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 2px 10px rgba(0,0,0,.1);
}
h2{margin-bottom:20px;}
label{
display:block;
margin-bottom:8px;
font-weight:bold;
}
input[type=text]{
width:100%;
padding:12px;
border:1px solid #ccc;
border-radius:6px;
}
.update-btn{
background:#16a34a;
color:white;
border:none;
padding:12px 20px;
border-radius:6px;
cursor:pointer;
}
</style>
</head>
<body>

<div class="container">

<a href="categories.php" class="back-btn">
← Back to Categories
</a>

<div class="form-box">

<h2>✏️ Edit Category</h2>

<form method="POST">

<label>Category Name</label>

<input type="text"
       name="name"
       value="<?= htmlspecialchars($data['name']) ?>"
       required>

<br><br>

<button type="submit"
        name="update"
        class="update-btn">
Update Category
</button>

</form>

</div>

</div>

</body>
</html>