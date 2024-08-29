<?php
session_start();
if (!isset($_SESSION['_id'])) {
    header("Location: login.php");
    exit();
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include('../include/db_connection.php');
        $max_images = 5;
        $max_file_size = 25 * 1024 * 1024;

        $title = $_POST["title"];
        $type = $_POST["type"];
        $bhk = $_POST["bhk"] ?? null;
        $status = $_POST["status"];
        $land_area = $_POST["land_area"] ?? null;
        $land_unit = $_POST["land_unit"] ?? null;
        $num_bathroom = $_POST["bathroom"] ?? null;
        $num_bedroom = $_POST["bedroom"] ?? null;
        $num_kitchen = $_POST["kitchen"] ?? null;
        $year_build = $_POST["year_build"] ?? null;
        $price = $_POST["price"];
        $view = $_POST["view"];
        $province = $_POST["province"];
        $municipality = $_POST["municipality"];
        $district = $_POST["district"];
        $tole = $_POST["tole"];
        $ward_no = $_POST["ward_no"];
        $description = $_POST["description"];
        $posted_by_id = $_SESSION['_id'];
        $images_dir = "images/property/";
        $upload_dir = "../images/property/";
        if (isset($_GET['ref'])) {
            if ($_GET['ref'] == 'update') {
                $method = $_GET['ref'] ?? null;
                $id = $_GET['id'] ?? null;
            }
        }
        if (!isset($method)) {
            $registered_date = (new DateTime())->format('Y-m-d\TH:i:s\Z');
            $query = "INSERT INTO properties (title, type, status, bhk, description, num_bedroom, num_bathroom, num_kitchen, land_area, land_unit, price, year_build, view, province, municipality, district, tole, ward_no, registered_date, posted_by_id) VALUES (?, ? , ?, ? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssssssssssssssssssi", $title, $type, $status, $bhk, $description, $num_bedroom, $num_bathroom, $num_kitchen, $land_area, $land_unit, $price, $year_build, $view, $province, $municipality, $district, $tole, $ward_no, $registered_date, $posted_by_id);
            if (mysqli_stmt_execute($stmt)) {
                $property_id = mysqli_insert_id($conn);
                if ($_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
                    if ($_FILES['thumbnail']['size'] <= $max_file_size) {
                        $tmp_file_path = $_FILES['thumbnail']['tmp_name'];
                        if ($tmp_file_path !== "") {
                            $file_name = uniqid() . '_' . $_FILES['thumbnail']['name'];
                            $upload_path = $upload_dir . $file_name;
                            $file_path = $images_dir . $file_name;
                            if (move_uploaded_file($tmp_file_path, $upload_path)) {
                                $image = $upload_path;
                                if ($image) {
                                    $image_hash = hash_file('sha256', $image);
                                    $is_thumbnail = 1;
                                    $query = "INSERT INTO property_images (file_name, file_path, image_hash, property_id, is_thumbnail) VALUES (?,?,?,?,?)";
                                    $stmt = mysqli_prepare($conn, $query);
                                    mysqli_stmt_bind_param($stmt, "sssii", $file_name, $file_path, $image_hash, $property_id, $is_thumbnail);
                                    mysqli_stmt_execute($stmt);
                                }
                            }
                        }
                    }
                }
                $total_count = count($_FILES['other_image']['name']);
                $files_moved = 0;
                for ($i = 0; $i < $total_count; $i++) {
                    if ($_FILES['other_image']['error'][$i] === UPLOAD_ERR_OK) {
                        if ($_FILES['other_image']['size'][$i] <= $max_file_size) {
                            $tmp_file_path = $_FILES['other_image']['tmp_name'][$i];
                            if ($tmp_file_path !== "") {
                                $file_name = uniqid() . '_' . $_FILES['other_image']['name'][$i];
                                $upload_path = $upload_dir . $file_name;
                                $file_path = $images_dir . $file_name;
                                if ($files_moved < 5) {
                                    if (move_uploaded_file($tmp_file_path, $upload_path)) {
                                        $image = $upload_path;
                                        if ($image) {
                                            $image_hash = hash_file('sha256', $image);
                                            $query = "INSERT INTO property_images (file_name, file_path, image_hash, property_id) VALUES (?, ?, ?, ?)";
                                            $stmt = mysqli_prepare($conn, $query);
                                            mysqli_stmt_bind_param($stmt, "sssi", $file_name, $file_path, $image_hash, $property_id);
                                            if (mysqli_stmt_execute($stmt)) {
                                                $files_moved += 1;
                                            }
                                        }
                                    }
                                } else {
                                    break;
                                }
                            }
                        }
                    }
                }
                // header("Location: submitproperty.php");
                $response = array('success' => true, 'method' => 'created');
            } else {
                $response = array('success' => false, 'method' => '');
            }
        } else {
            $query = "UPDATE properties SET title=?, type=?, status=?, bhk=?, description=?, num_bedroom=?, num_bathroom=?, num_kitchen=?, land_area=?, land_unit=?, price=?, year_build=?, view=?, province=?, municipality=?, district=?, tole=?, ward_no=? WHERE _id=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $title, $type, $status, $bhk, $description, $num_bedroom, $num_bathroom, $num_kitchen, $land_area, $land_unit, $price, $year_build, $view, $province, $municipality, $district, $tole, $ward_no, $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (print_r($result)) {
                $response = array('success' => true, 'method' => 'updated');
            } else {
                $response = array('success' => false, 'method' => '');
            }
        }
        // Close Statement
        mysqli_stmt_close($stmt);
        // Close the database connection
        mysqli_close($conn);
        // header('Content-Type: application/json');
        echo json_encode($response);
    }
}
