<?php
include "../includes/auth.php";
include "../includes/db.php";

$cats = $conn->query("SELECT * FROM categories ORDER BY name ASC");

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $content = $_POST['content'];

    $image = "";

    if(!empty($_FILES['image']['name']))
    {
        $image = time() . "_" . $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file(
            $tmp,
            "../uploads/images/" . $image
        );
    }

    $conn->query("
        INSERT INTO posts(title, category_id, content, image)
        VALUES('$title','$category_id','$content','$image')
    ");

    echo "<script>
            alert('Post Added Successfully');
            window.location='posts.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Post</title>

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

        .container{
            width:70%;
            margin:40px auto;
        }

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

        h2{
            margin-bottom:20px;
            color:#333;
        }

        .form-group{
            margin-bottom:15px;
        }

        label{
            display:block;
            margin-bottom:5px;
            font-weight:bold;
            color:#444;
        }

        input[type="text"],
        select,
        textarea,
        input[type="file"]{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:6px;
        }

        textarea{
            height:200px;
            resize:vertical;
        }

        .save-btn{
            background:#16a34a;
            color:white;
            border:none;
            padding:12px 20px;
            border-radius:6px;
            cursor:pointer;
            font-size:16px;
        }

        .save-btn:hover{
            background:#15803d;
        }
    </style>
</head>
<body>

<div class="container">

    <a href="posts.php" class="back-btn">
        ← Back to Posts
    </a>

    <div class="form-box">

        <h2>📝 Add New Post</h2>

        <form method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label>Post Title</label>

                <input
                    type="text"
                    name="title"
                    required
                >
            </div>

            <div class="form-group">
                <label>Select Category</label>

                <select name="category_id" required>

                    <option value="">
                        -- Select Category --
                    </option>

                    <?php while($c = $cats->fetch_assoc()) { ?>

                        <option value="<?= $c['id']; ?>">
                            <?= htmlspecialchars($c['name']); ?>
                        </option>

                    <?php } ?>

                </select>
            </div>

            <div class="form-group">
                <label>Post Content</label>

                <textarea
                    name="content"
                    required
                ></textarea>
            </div>

            <div class="form-group">
                <label>Upload Image</label>

                <input
                    type="file"
                    name="image"
                    accept="image/*"
                >
            </div>

            <button
                type="submit"
                name="submit"
                class="save-btn">
                Save Post
            </button>

        </form>

    </div>

</div>

</body>
</html>