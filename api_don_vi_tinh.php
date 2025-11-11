<?php
header("Content-Type: application/json; charset=UTF-8");
include "db.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['MaDV'])) {
            $MaDV = $_GET['MaDV'];
            $sql = "SELECT * FROM DonViTinh WHERE MaDV=$MaDV";
            $result = $conn->query($sql);
            echo json_encode($result->fetch_assoc());
        } else {
            $sql = "SELECT * FROM DonViTinh";
            $result = $conn->query($sql);
            $rows = [];
            while ($row = $result->fetch_assoc()) $rows[] = $row;
            echo json_encode($rows);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $sql = "INSERT INTO DonViTinh (TenDVT) VALUES ('$data->TenDVT')";
        echo $conn->query($sql)
            ? json_encode(["message" => "Thêm đơn vị tính thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    case 'PUT':
        $MaDV = $_GET['MaDV'];
        $data = json_decode(file_get_contents("php://input"));
        $sql = "UPDATE DonViTinh SET TenDVT='$data->TenDVT' WHERE MaDV=$MaDV";
        echo $conn->query($sql)
            ? json_encode(["message" => "Cập nhật đơn vị tính thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    case 'DELETE':
        $MaDV = $_GET['MaDV'];
        $sql = "DELETE FROM DonViTinh WHERE MaDV=$MaDV";
        echo $conn->query($sql)
            ? json_encode(["message" => "Xóa đơn vị tính thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    default:
        echo json_encode(["error" => "Phương thức không hợp lệ"]);
}

$conn->close();
?>
