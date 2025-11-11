from ketnoidv.ketnoi_mysql import connect_mysql
from mysql.connector import Error


def insert_danhmuc(ten_dm, mo_ta=None, trang_thai=1):
    """Hàm thêm danh mục mới vào bảng DanhMuc"""
    try:
        conn = connect_mysql()
        if conn is None:
            return

        cursor = conn.cursor()

        sql = """
            INSERT INTO DanhMuc (TenDM, MoTa, TrangThai)
            VALUES (%s, %s, %s)
        """
        data = (ten_dm, mo_ta, trang_thai)

        cursor.execute(sql, data)
        conn.commit()

        print(f"✅ Đã thêm danh mục mới: {ten_dm}")

    except Error as e:
        print("❌ Lỗi khi thêm danh mục:", e)

    finally:
        if conn.is_connected():
            cursor.close()
            conn.close()


