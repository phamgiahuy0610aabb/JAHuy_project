<?php
header("Content-Type: application/json; charset=UTF-8");
include "db.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['MaSP'])) {
            $MaSP = $_GET['MaSP'];
            $sql = "SELECT * FROM SanPham WHERE MaSP=$MaSP";
            $result = $conn->query($sql);
            echo json_encode($result->fetch_assoc());
        } else {
            $sql = "SELECT * FROM SanPham";
            $result = $conn->query($sql);
            $rows = [];
            while ($row = $result->fetch_assoc()) $rows[] = $row;
            echo json_encode($rows);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $sql = "INSERT INTO SanPham (TenSP, NgaySX, HSD, GiaBan, GiaGiam, MaDV, MaDM, CongDung, CachDung)
                VALUES ('$data->TenSP', '$data->NgaySX', '$data->HSD', '$data->GiaBan', '$data->GiaGiam', 
                        '$data->MaDV', '$data->MaDM', '$data->CongDung', '$data->CachDung')";
        echo $conn->query($sql)
            ? json_encode(["message" => "Thêm sản phẩm thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    case 'PUT':
        $MaSP = $_GET['MaSP'];
        $data = json_decode(file_get_contents("php://input"));
        $sql = "UPDATE SanPham SET 
                    TenSP='$data->TenSP',
                    NgaySX='$data->NgaySX',
                    HSD='$data->HSD',
                    GiaBan='$data->GiaBan',
                    GiaGiam='$data->GiaGiam',
                    MaDV='$data->MaDV',
                    MaDM='$data->MaDM',
                    CongDung='$data->CongDung',
                    CachDung='$data->CachDung'
                WHERE MaSP=$MaSP";
        echo $conn->query($sql)
            ? json_encode(["message" => "Cập nhật sản phẩm thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    case 'DELETE':
        $MaSP = $_GET['MaSP'];
        $sql = "DELETE FROM SanPham WHERE MaSP=$MaSP";
        echo $conn->query($sql)
            ? json_encode(["message" => "Xóa sản phẩm thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    default:
        echo json_encode(["error" => "Phương thức không hợp lệ"]);
}

$conn->close();
?>
