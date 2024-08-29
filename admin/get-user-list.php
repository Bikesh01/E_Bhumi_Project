<?php
session_start();
include('../include/db_connection.php');
if (!isset($_SESSION['_id']) || $_SESSION['role'] == 'user' || $_SESSION['role'] == 'agent') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['role']) || !isset($_GET['filter'])) {
    $response = "<tbody id='table-body'> <tr> <td colspan='6'>Invalid Parameters</td> </tr> </tbody>";
    echo $response;
    exit();
}

if($_SESSION['role'] == 'admin') {
    header("Location: 404.php");
    die("Database Query Failed.");
    exit();
}

$filter = $_GET['filter'];

if (!isset($_GET['role'])) {
    $role = "";
    $query = "SELECT * FROM $table LIMIT $filter";
} else {
    $role = $_GET['role'];
    $query = "SELECT * FROM $table WHERE role = ? LIMIT $filter";
}

try {
    $stmt = mysqli_prepare($conn, $query);
} catch (Exception) {
    header("Location: 404.php");
    die("Database Query Failed.");
}
$response = "<tbody id='table-body'>";
if ($stmt) {
    if ($role) {
        mysqli_stmt_bind_param($stmt, "s", $role);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $response .= "<tr>";
                $response .= "<td>" . $row['_id'] . "</td>";
                $response .= "<td>" . $row['first_name'] . ' ' . $row['last_name'] . "</td>";
                $response .= "<td>" . $row['email'] . "</td>";
                $response .= "<td>" . $row['country_code'] . $row['phone_number'] . "</td>";
                $response .= "<td><img src='" . $row['file_path'] . "' alt=''></td>";
                $response .= "<td class='text-primary fw-normal'><a href='#'>Delete</a></td>";
                $response .= "</tr>";
            }
        } else {
            $response .= "<tr><td colspan='6'>No records found</td></tr>";
        }
    } else {
        $response .= "<tr><td colspan='6'>No records found</td></tr>";
    }
} else {
    $response .= "<tr><td colspan='6'>No records found</td></tr>";
}

$response .= "</tbody>";

echo $response;
?>