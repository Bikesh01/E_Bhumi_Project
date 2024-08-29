<?php
session_start();
include('../include/db_connection.php');
if (!isset($_SESSION['_id']) || $_SESSION['role'] == 'user' || $_SESSION['role'] == 'agent') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['status']) && !isset($_GET['filter']) && !isset($_GET['type'])) {
    $response = "<tbody id='table-body'> <tr> <td colspan='6'>Invalid Parameters</td> </tr> </tbody>";
    echo $response;
    exit();
}

$filter = $_GET['filter'];

if (!isset($_GET['status']) && !isset($_GET['type']) && isset($_GET['filter'])) {
    $query = "SELECT * FROM properties LIMIT $filter";
} else if (isset($_GET['status']) && isset($_GET['filter'])) {
    $ref = $_GET['status'];
    $query = "SELECT * FROM properties WHERE status = ? LIMIT $filter";
} else if (isset($_GET['type']) && isset($_GET['filter'])) {
    $ref = $_GET['type'];
    $query = "SELECT * FROM properties WHERE type = ? LIMIT $filter";
}

try {
    $stmt = mysqli_prepare($conn, $query);
} catch (Exception) {
    header("Location: 404.php");
    die("Database Query Failed.");
}
$response = "<tbody id='table-body'>";
if ($stmt) {
    if (isset($ref)) {
        mysqli_stmt_bind_param($stmt, "s", $ref);
    }
    mysqli_stmt_execute($stmt);
    if ($result = mysqli_stmt_get_result($stmt)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $response .= "<tr><td  class='collapsible-row gap-1'><button class='toggle-btn'>+</button></td>";
                $response .= "<td>" . ucfirst($row['_id']) . "</td>";
                $response .= "<td>" . ucfirst($row['title']) . "</td>";
                $response .= "<td>" . ucfirst($row['description']) . "</td>";
                $response .= "<td>" . ucfirst($row['type']) . "</td>";
                $response .= "<td>" . ucfirst($row['bhk']) . "</td>";
                $response .= "<td>" . ucfirst($row['status']) . "</td>";
                $response .= "<td>" . $row['num_bedroom'] . "</td>";
                $response .= "<td>" . $row['num_bathroom'] . "</td>";
                $response .= "<td>" . $row['num_kitchen'] . "</td>";
                $response .= "<td>" . $row['land_area'] . "</td>";
                $response .= "<td>" . ucfirst($row['land_unit']) . "</td>";
                $response .= "<td>" . $row['price'] . "</td>";
                $response .= "</tr>";
                $response .= "<tr class='collapsible-content'>";
                $response .= "<td colsp='12'><ul>";
                $response .= "<li><label>Year Build: </label>" . $row['year_build'] . "</li>";
                $response .= "<li><label>View: " . "</label>". $row['view'] . "</li>";
                $response .= "<li><label>Province: " . "</label>" . $row['province'] . "</li>";
                $response .= "<li><label>Municipality: " . "</label>" . $row['municipality'] . "</li>";
                $response .= "<li><label>District: " . "</label>" . $row['district'] . "</li>";
                $response .= "<li><label>Tole: " . "</label>" . $row['tole'] . "</li>";
                $response .= "<li><label>Ward No: " . "</label>" . $row['ward_no'] . "</li>";
                $property_id = $row['_id'];
                $query = "SELECT * FROM property_images WHERE property_id=$property_id and is_deleted=0";
                $image_result = mysqli_query($conn, $query);
                if ($image_result && mysqli_num_rows($image_result) > 0) {
                    $property_images = mysqli_fetch_all($image_result, MYSQLI_ASSOC);
                    foreach ($property_images as $key => $property_image) {
                    $response .= "<li><label>Image " . $key . ": </label><img src='" . $property_image['file_path']."'></li>";
                    }
                }
                $response .= "<li><label><a href=''>Edit</a></label></li>";
                $response .= "<li><button type='button' class='btn btn-lg delete-users btn-danger' data-bs-toggle='modal' data-bs-target='#confirmDelete' value='Delete'  data-propertyid='" . $row['_id'] ."' data-table='properties'>";
                $response .= "Delete</button></li>";
                $response .= "</ul></td></tr>";
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