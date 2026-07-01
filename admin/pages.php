<?php
include "../includes/auth.php";
include "../includes/db.php";

// Delete Page
if(isset($_GET['delete']))
{
    $id = (int)$_GET['delete'];

    $conn->query("DELETE FROM pages WHERE id=$id");

    echo "<script>
            alert('Page Deleted Successfully');
            window.location='pages.php';
          </script>";
    exit;
}

$result = $conn->query("SELECT * FROM pages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Pages</title>

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
            overflow-x:auto;
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
            vertical-align:middle;
        }

        table tr:hover{
            background:#f8f9fa;
        }

        img{
            border-radius:5px;
            object-fit:cover;
        }

        .action-buttons{
            display:flex;
            gap:10px;
            align-items:center;
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
        <h2>📄 Manage Pages</h2>

        <a href="add-page.php" class="add-btn">
            + Add New Page
        </a>
    </div>

    <div class="table-box">

        <?php if($result->num_rows > 0) { ?>

            <table>

                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>

                <?php while($row = $result->fetch_assoc()) { ?>

                <tr>

                    <td><?= $row['id']; ?></td>

                    <td><?= htmlspecialchars($row['title']); ?></td>

                    <td>
                        <?= substr(strip_tags($row['content']), 0, 60); ?>
                    </td>

                    <td>

                        <?php if(!empty($row['image'])) { ?>

                            <img
                                src="../uploads/images/<?= $row['image']; ?>"
                                width="80"
                                height="60"
                            >

                        <?php } else { ?>

                            No Image

                        <?php } ?>

                    </td>

                    <td>

                        <div class="action-buttons">

                            <a href="edit-page.php?id=<?= $row['id']; ?>"
                               class="edit-btn">
                               Edit
                            </a>

                            <a href="pages.php?delete=<?= $row['id']; ?>"
                               class="delete-btn"
                               onclick="return confirm('Are you sure you want to delete this page?')">
                               Delete
                            </a>

                        </div>

                    </td>

                </tr>

                <?php } ?>

            </table>

        <?php } else { ?>

            <div class="no-data">
                No Pages Found
            </div>

        <?php } ?>

    </div>

</div>

</body>
</html>
