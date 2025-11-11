<?php
header("Content-Type: application/json; charset=UTF-8");
include "db.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['MaDM'])) {
            $MaDM = $_GET['MaDM'];
            $sql = "SELECT * FROM DanhMuc WHERE MaDM=$MaDM";
            $result = $conn->query($sql);
            echo json_encode($result->fetch_assoc());
        } else {
            $sql = "SELECT * FROM DanhMuc";
            $result = $conn->query($sql);
            $rows = [];
            while ($row = $result->fetch_assoc()) $rows[] = $row;
            echo json_encode($rows);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $sql = "INSERT INTO DanhMuc (TenDM) VALUES ('$data->TenDM')";
        echo $conn->query($sql)
            ? json_encode(["message" => "Thêm danh mục thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    case 'PUT':
        $MaDM = $_GET['MaDM'];
        $data = json_decode(file_get_contents("php://input"));
        $sql = "UPDATE DanhMuc SET TenDM='$data->TenDM' WHERE MaDM=$MaDM";
        echo $conn->query($sql)
            ? json_encode(["message" => "Cập nhật danh mục thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    case 'DELETE':
        $MaDM = $_GET['MaDM'];
        $sql = "DELETE FROM DanhMuc WHERE MaDM=$MaDM";
        echo $conn->query($sql)
            ? json_encode(["message" => "Xóa danh mục thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    default:
        echo json_encode(["error" => "Phương thức không hợp lệ"]);
}

$conn->close();
?>
