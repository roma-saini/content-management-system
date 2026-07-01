<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../includes/db.php";

$action = $_GET['action'] ?? '';

if($action == "read"){

    $search = $_GET['search'] ?? '';

    $query = "SELECT * FROM pages WHERE title LIKE '%$search%'";
    $result = $conn->query($query);

    if(!$result){
        die("DB Error: " . $conn->error);
    }

    echo "<table border='1' width='100%'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Action</th>
            </tr>";

    while($row = $result->fetch_assoc()){
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['title']}</td>
                <td>
                    <button onclick='deletePage({$row['id']})'>Delete</button>
                </td>
              </tr>";
    }

    echo "</table>";
    exit;
}

if($action == "delete"){

    $id = $_GET['id'] ?? 0;

    if($conn->query("DELETE FROM pages WHERE id=$id")){
        echo "Deleted successfully";
    } else {
        echo "Delete failed";
    }

    exit;
}

echo "Invalid action";
?>