<?php
session_start();
if (!isset($_SESSION['_id']) || $_SESSION['role'] == 'user' || $_SESSION['role'] == 'agent') {
    header("Location: login.php");
    exit();
} else {
    $title = $type = $status = $bhk = $description = $num_bedroom = $num_bathroom = $num_kitchen = $land_area = $land_unit = $price = $year_build = $view = $province = $municipality = $district = $tole = $ward_no = $registered_date = "";
    if (isset($_GET['ref']) && isset($_GET['id'])) {
        if ($_GET['ref'] == 'update') {
            $method = $_GET['ref'];
            $id = $_GET['id'];
        }
    }
    if (isset($method) && isset($id)) {
        $query = "SELECT * FROM properties WHERE _id=$id";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $title = ucfirst($row['title']);
            $type = ucfirst($row['type']);
            $status = ucfirst($row['status']);
            $bhk = $row['bhk'];
            $description = ucfirst($row['description']);
            $num_bedroom = $row['num_bedroom'];
            $num_bathroom = $row['num_bathroom'];
            $num_kitchen = $row['num_kitchen'];
            $land_area = $row['land_area'];
            $land_unit = ucfirst($row['land_unit']);
            $price = $row['price'];
            $year_build = $row['year_build'];
            $view = ucfirst($row['view']);
            $province = ucfirst($row['province']);
            $municipality = ucfirst($row['municipality']);
            $district = ucfirst($row['district']);
            $tole = ucfirst($row['tole']);
            $ward_no = $row['ward_no'];
            $registered_date = $row['registered_date'];
        }
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $max_images = 5;
    $max_file_size = 25 * 1024 * 1024;
    // Retrieve form data
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
    $upload_dir = "images/property/";
    $method = $_POST['method'] ?? null;
    $id = $_POST['id'] ?? null;
    if (!isset($method)) {
        $registered_date = (new DateTime())->format('Y-m-d\TH:i:s\Z');
        $total_count = count($_FILES['other_image']['name']);
        // SQL query to insert user data into the database
        $query = "INSERT INTO properties (title, type, status, bhk, description, num_bedroom, num_bathroom, num_kitchen, land_area, land_unit, price, year_build, view, province, municipality, district, tole, ward_no, registered_date, posted_by_id) VALUES (?, ? , ?, ? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $title, $type, $status, $bhk, $description, $num_bedroom, $num_bathroom, $num_kitchen, $land_area, $land_unit, $price, $year_build, $view, $province, $municipality, $district, $tole, $ward_no, $registered_date, $posted_by_id);
    } else {
        $query = "UPDATE properties SET title=?, type=?, status=?, bhk=?, description=?, num_bedroom=?, num_bathroom=?, num_kitchen=?, land_area=?, land_unit=?, price=?, year_build=?, view=?, province=?, municipality=?, district=?, tole=?, ward_no=? WHERE _id=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssssssssssssssssss", $title, $type, $status, $bhk, $description, $num_bedroom, $num_bathroom, $num_kitchen, $land_area, $land_unit, $price, $year_build, $view, $province, $municipality, $district, $tole, $ward_no, $id);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (print_r($result)) {
        if (!isset($method)) {
            $property_id = mysqli_insert_id($conn);
            // Handle file Upload
            if ($_FILES['thumbnail']['error']) {
                if ($_FILES['thumbnail']['size'] <= $max_file_size) {
                    $tmp_file_path = $_FILES['thumbnail']['tmp_name'];
                    if ($tmp_file_path !== "") {
                        $file_name = uniqid() . '_' . $_FILES['thumbnail']['name'];
                        $file_path = $upload_dir . $file_name;
                        if (move_uploaded_file($tmp_thumbnail_path, $file_path)) {
                            $image = $file_path;
                            if ($image) {
                                $image_hash = hash_file('sha256', $image);
                                $sql = "INSERT INTO property_images (file_name, file_path, image_hash, property_id, is_thumbnail) VALUES ('$file_name', '$file_path', '$image_hash', '$property_id', '1')";
                                if ($conn->query($sql)) {
                                    $files_moved += 1;
                                }
                            }
                        }
                    }
                }
            }
            if ($_FILES['other_image']['error']) {
                $files_moved = 0;
                for ($i = 0; $i < $total_count; $i++) {
                    if ($_FILES['other_image']['size'][$i] <= $max_file_size) {
                        $tmp_file_path = $_FILES['other_image']['tmp_name'][$i];
                    }
                    if ($tmp_file_path !== "") {
                        $file_name = uniqid() . '_' . $_FILES['other_image']['name'][$i];
                        $file_path = $upload_dir . $file_name;
                        if ($files_moved < 5) {
                            if (move_uploaded_file($tmp_file_path, $file_path)) {
                                $image = $file_path;
                                if ($image) {
                                    $image_hash = hash_file('sha256', $image);
                                    $sql = "INSERT INTO property_images (file_name, file_path, image_hash, property_id) VALUES ('$file_name', '$file_path', '$image_hash', '$property_id')";
                                    if ($conn->query($sql)) {
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
            header("Location: submitproperty.php");
        }
    }
    // Close Statement
    mysqli_stmt_close($stmt);
    // Close the database connection
    mysqli_close($conn);
}