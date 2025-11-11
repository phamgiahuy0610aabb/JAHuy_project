import mysql.connector
from mysql.connector import Error

from ketnoidv.ketnoi_mysql import connect_mysql


def get_all_danhmuc():
    """Hàm lấy danh sách tất cả danh mục"""
    try:
        conn = connect_mysql()
        if conn is None:
            return

        cursor = conn.cursor(dictionary=True)  # Trả kết quả dạng dict thay vì tuple
        cursor.execute("SELECT MaDM, TenDM, MoTa, TrangThai FROM DanhMuc")

        results = cursor.fetchall()

        if results:
            print("📋 Danh sách danh mục:")
            for dm in results:
                print(f"- [{dm['MaDM']}] {dm['TenDM']} | Trạng thái: {dm['TrangThai']}")
        else:
            print("⚠️ Chưa có danh mục nào trong cơ sở dữ liệu.")

        return results

    except Error as e:
        print("❌ Lỗi khi lấy danh sách danh mục:", e)
        return None

    finally:
        if conn.is_connected():
            cursor.close()
            conn.close()


# --- Kiểm tra thử ---
if __name__ == "__main__":
    danh_sach = get_all_danhmuc()
