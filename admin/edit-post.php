<?php
include "../includes/auth.php";
include "../includes/db.php";

$id = $_GET['id'] ?? 0;

$post = $conn->query("SELECT * FROM posts WHERE id=$id");
$data = $post->fetch_assoc();

if(!$data)
{
    echo "<h2>Post Not Found!</h2>";
    echo "<a href='posts.php'>Back to Posts</a>";
    exit;
}

$cats = $conn->query("SELECT * FROM categories");

if(isset($_POST['update']))
{
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $content = $_POST['content'];

    $image = $data['image'];

    if(!empty($_FILES['image']['name']))
    {
        $image = time()."_".$_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../uploads/images/".$image
        );
    }

    $conn->query("
        UPDATE posts
        SET title='$title',
            category_id='$category_id',
            content='$content',
            image='$image'
        WHERE id=$id
    ");

    echo "<script>
            alert('Post Updated Successfully');
            window.location='posts.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Post</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Segoe UI',sans-serif;}
body{background:#f4f6f9;}
.container{width:70%;margin:40px auto;}
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
.form-group{margin-bottom:15px;}
input[type=text],select,textarea,input[type=file]{
width:100%;
padding:12px;
border:1px solid #ccc;
border-radius:6px;
}
textarea{
height:200px;
resize:vertical;
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

<a href="posts.php" class="back-btn">
← Back to Posts
</a>

<div class="form-box">

<h2>📝 Edit Post</h2>

<form method="POST" enctype="multipart/form-data">

<div class="form-group">
<label>Post Title</label>
<input type="text"
       name="title"
       value="<?= htmlspecialchars($data['title']) ?>"
       required>
</div>

<div class="form-group">
<label>Category</label>

<select name="category_id">

<?php while($c = $cats->fetch_assoc()) { ?>

<option value="<?= $c['id'] ?>"
<?php if($c['id'] == $data['category_id']) echo "selected"; ?>>

<?= htmlspecialchars($c['name']) ?>

</option>

<?php } ?>

</select>

</div>

<div class="form-group">
<label>Content</label>
<textarea name="content"><?= htmlspecialchars($data['content']) ?></textarea>
</div>

<div class="form-group">

<label>Current Image</label><br><br>

<?php if(!empty($data['image'])) { ?>

<img src="../uploads/images/<?= $data['image'] ?>"
     width="150">

<?php } else { ?>

No Image Uploaded

<?php } ?>

</div>

<div class="form-group">
<label>Change Image</label>
<input type="file" name="image">
</div>

<button type="submit"
        name="update"
        class="update-btn">
Update Post
</button>

</form>

</div>

</div>

</body>
</html>