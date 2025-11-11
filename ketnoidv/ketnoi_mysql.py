import mysql.connector
from mysql.connector import Error

def connect_mysql():
    """Hàm kết nối đến MySQL"""
    try:
        connection = mysql.connector.connect(
            host='localhost',      # địa chỉ máy chủ MySQL (VD: 127.0.0.1)
            user='root',           # tên tài khoản MySQL
            password='',     # mật khẩu MySQL
            database='qlnhathuoc'    # tên database bạn muốn làm việc
        )

        if connection.is_connected():
            print("✅ Kết nối MySQL thành công!")
            return connection

    except Error as e:
        print("❌ Lỗi kết nối MySQL:", e)
        return None

# --- Kiểm tra thử ---
if __name__ == "__main__":
    conn = connect_mysql()
    if conn:
        cursor = conn.cursor()
        cursor.execute("SHOW TABLES;")
        for table in cursor.fetchall():
            print("🧱 Bảng:", table[0])
        conn.close()
