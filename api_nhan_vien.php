<?php
header("Content-Type: application/json; charset=UTF-8");
include "db.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['MaNV'])) {
            // Lấy 1 nhân viên
            $MaNV = $_GET['MaNV'];
            $sql = "SELECT * FROM NhanVien WHERE MaNV = $MaNV";
            $result = $conn->query($sql);
            echo json_encode($result->fetch_assoc());
        } else {
            // Lấy tất cả nhân viên
            $sql = "SELECT * FROM NhanVien";
            $result = $conn->query($sql);
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            echo json_encode($rows);
        }
        break;

    case 'POST':
        // Thêm nhân viên
        $data = json_decode(file_get_contents("php://input"));
        $sql = "INSERT INTO NhanVien (HoTen, GioiTinh, NgaySinh, NgayVL)
                VALUES ('$data->HoTen', '$data->GioiTinh', '$data->NgaySinh', '$data->NgayVL')";
        if ($conn->query($sql)) {
            echo json_encode(["message" => "Thêm nhân viên thành công"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'PUT':
        // Cập nhật nhân viên
        $MaNV = $_GET['MaNV'];
        $data = json_decode(file_get_contents("php://input"));
        $sql = "UPDATE NhanVien 
                SET HoTen='$data->HoTen', GioiTinh='$data->GioiTinh', 
                    NgaySinh='$data->NgaySinh', NgayVL='$data->NgayVL'
                WHERE MaNV=$MaNV";
        if ($conn->query($sql)) {
            echo json_encode(["message" => "Cập nhật thành công"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'DELETE':
        // Xóa nhân viên
        $MaNV = $_GET['MaNV'];
        $sql = "DELETE FROM NhanVien WHERE MaNV=$MaNV";
        if ($conn->query($sql)) {
            echo json_encode(["message" => "Xóa nhân viên thành công"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    default:
        echo json_encode(["error" => "Phương thức không hợp lệ"]);
        break;
}

$conn->close();
?>
