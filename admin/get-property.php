<?php
session_start();
if (!isset($_SESSION['_id'])) {
    header("Location: login.php");
    exit();
} else {
    include('../include/db_connection.php');
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET['id'];
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
            $data = array(
                'title' => $title,
                'type' => $type,
                'status' => $status,
                'bhk' => $bhk,
                'description' => $description,
                'num_bedroom' => $num_bedroom,
                'num_bathroom' => $num_bathroom,
                'num_kitchen' => $num_kitchen,
                'land_area' => $land_area,
                'land_unit' => $land_unit,
                'price' => $price,
                'year_build' => $year_build,
                'view' => $view,
                'province' => $province,
                'municipality' => $municipality,
                'district' => $district,
                'tole' => $tole,
                'ward_no' => $ward_no
            );
            $response = array('success'=>true, 'data'=>$data);
        } else {
            $data = array(
                'title' => '',
                'type' => '',
                'status' => '',
                'bhk' => '',
                'description' => '',
                'num_bedroom' => '',
                'num_bathroom' => '',
                'num_kitchen' => '',
                'land_area' => '',
                'land_unit' => '',
                'price' => '',
                'year_build' => '',
                'view' => '',
                'province' => '',
                'municipality' => '',
                'district' => '',
                'tole' => '',
                'ward_no' => ''
            );
            $response = array('success'=>false, 'data'=>$data);
        }
    }
}
header('Content-Type: application/json');
echo json_encode($response);
$conn->close();
