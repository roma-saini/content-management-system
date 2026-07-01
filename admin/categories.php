<?php
include "../includes/auth.php";
include "../includes/db.php";

// Delete Category
if(isset($_GET['delete']))
{
    $id = (int)$_GET['delete'];

    $conn->query("DELETE FROM categories WHERE id=$id");

    echo "<script>
            alert('Category Deleted Successfully');
            window.location='categories.php';
          </script>";
    exit;
}

$result = $conn->query("SELECT * FROM categories ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Categories</title>

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
            width:95%;
            margin:30px auto;
        }

        .back-btn{
            display:inline-block;
            margin-bottom:20px;
            text-decoration:none;
            color:#2563eb;
            font-weight:bold;
        }

        .top-bar{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .top-bar h2{
            color:#333;
        }

        .add-btn{
            background:#2563eb;
            color:white;
            padding:10px 18px;
            text-decoration:none;
            border-radius:6px;
        }

        .add-btn:hover{
            background:#1d4ed8;
        }

        .table-box{
            background:white;
            padding:20px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,.1);
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:#1f2937;
            color:white;
            padding:12px;
            text-align:left;
        }

        table td{
            padding:12px;
            border-bottom:1px solid #ddd;
        }

        table tr:hover{
            background:#f8f9fa;
        }

        .action-buttons{
            display:flex;
            gap:10px;
        }

        .edit-btn,
        .delete-btn{
            display:inline-block;
            min-width:70px;
            text-align:center;
            color:white;
            padding:8px 12px;
            text-decoration:none;
            border-radius:5px;
        }

        .edit-btn{
            background:#16a34a;
        }

        .delete-btn{
            background:#dc2626;
        }

        .edit-btn:hover{
            background:#15803d;
        }

        .delete-btn:hover{
            background:#b91c1c;
        }

        .no-data{
            text-align:center;
            padding:30px;
            font-size:18px;
            color:#666;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="dashboard.php" class="back-btn">
        ← Back to Dashboard
    </a>

    <div class="top-bar">
        <h2>📁 Manage Categories</h2>

        <a href="add-category.php" class="add-btn">
            + Add Category
        </a>
    </div>

    <div class="table-box">

        <?php if($result->num_rows > 0) { ?>

            <table>

                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>

                <?php while($row = $result->fetch_assoc()) { ?>

                <tr>

                    <td><?= $row['id']; ?></td>

                    <td><?= htmlspecialchars($row['name']); ?></td>

                    <td>
                        <div class="action-buttons">

                            <a href="edit-category.php?id=<?= $row['id']; ?>"
                               class="edit-btn">
                               Edit
                            </a>

                            <a href="categories.php?delete=<?= $row['id']; ?>"
                               class="delete-btn"
                               onclick="return confirm('Are you sure you want to delete this category?')">
                               Delete
                            </a>

                        </div>
                    </td>

                </tr>

                <?php } ?>

            </table>

        <?php } else { ?>

            <div class="no-data">
                No Categories Found
            </div>

        <?php } ?>

    </div>

</div>

</body>
</html>