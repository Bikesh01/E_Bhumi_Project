<?php
include('../include/db_connection.php');
if (isset($_POST['table']) && isset($_POST['id'])) {
    $table = mysqli_real_escape_string($conn, $_POST['table']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    
    $query = "UPDATE $table SET is_active=0, is_deleted=1 WHERE _id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo True;
    } else {
        // Deletion failed
        echo False;
    }
} else {
    // If user ID is not set, return an error message
    echo "User ID not provided";
}
$conn->close();
?>
