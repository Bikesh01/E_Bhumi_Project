<?php
session_start();
include('include/db_connection.php');
if (isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
    $posted_by_id = $_SESSION['_id'];
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST["subject"]);
    $messsage = htmlspecialchars($_POST["message"]);
    $query = "INSERT INTO feedbacks (email, subject, message, posted_by_id) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $email, $subject, $messsage, $posted_by_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (print_r($result)) {
        http_response_code(200);
        echo json_encode(['success' => true]);
        $conn->close();
        exit;
    } else {
        http_response_code(400);
        echo json_encode(['success' => false]);
        $conn->close();
        exit;
    }
} else {
    http_response_code(400);
    echo json_encode(['success' => false]);
    $conn->close();
    exit;
}
$conn->close();
?>