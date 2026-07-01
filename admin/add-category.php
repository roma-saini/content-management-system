<?php
include "../includes/auth.php";
include "../includes/db.php";

if(isset($_POST['submit']))
{
    $name = trim($_POST['name']);

    $conn->query("
        INSERT INTO categories(name)
        VALUES('$name')
    ");

    echo "<script>
            alert('Category Added Successfully');
            window.location='categories.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>

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
            width:60%;
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
            margin-bottom:20px;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:bold;
            color:#444;
        }

        input[type="text"]{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:6px;
            font-size:15px;
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

    <a href="categories.php" class="back-btn">
        ← Back to Categories
    </a>

    <div class="form-box">

        <h2>📁 Add New Category</h2>

        <form method="POST">

            <div class="form-group">

                <label>Category Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter Category Name"
                    required
                >

            </div>

            <button
                type="submit"
                name="submit"
                class="save-btn">
                Add Category
            </button>

        </form>

    </div>

</div>

</body>
</html>