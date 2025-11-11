<?php
header("Content-Type: application/json; charset=UTF-8");
include "db.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['SoDH']) && isset($_GET['MaSP'])) {
            $SoDH = $_GET['SoDH'];
            $MaSP = $_GET['MaSP'];
            $sql = "SELECT * FROM ChiTietDH WHERE SoDH=$SoDH AND MaSP=$MaSP";
            $result = $conn->query($sql);
            echo json_encode($result->fetch_assoc());
        } else {
            $sql = "SELECT * FROM ChiTietDH";
            $result = $conn->query($sql);
            $rows = [];
            while ($row = $result->fetch_assoc()) $rows[] = $row;
            echo json_encode($rows);
        }
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"));
        $sql = "INSERT INTO ChiTietDH (SoDH, MaSP, SL, Gia)
                VALUES ('$data->SoDH', '$data->MaSP', '$data->SL', '$data->Gia')";
        echo $conn->query($sql)
            ? json_encode(["message" => "Thêm chi tiết đơn hàng thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    case 'PUT':
        $SoDH = $_GET['SoDH'];
        $MaSP = $_GET['MaSP'];
        $data = json_decode(file_get_contents("php://input"));
        $sql = "UPDATE ChiTietDH 
                SET SL='$data->SL', Gia='$data->Gia'
                WHERE SoDH=$SoDH AND MaSP=$MaSP";
        echo $conn->query($sql)
            ? json_encode(["message" => "Cập nhật thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    case 'DELETE':
        $SoDH = $_GET['SoDH'];
        $MaSP = $_GET['MaSP'];
        $sql = "DELETE FROM ChiTietDH WHERE SoDH=$SoDH AND MaSP=$MaSP";
        echo $conn->query($sql)
            ? json_encode(["message" => "Xóa chi tiết đơn hàng thành công"])
            : json_encode(["error" => $conn->error]);
        break;

    default:
        echo json_encode(["error" => "Phương thức không hợp lệ"]);
}

$conn->close();
?>
