import mysql.connector
from mysql.connector import Error

def delete_danhmuc_safe(ma_dm):
    """Xóa tất cả SanPham thuộc MaDM rồi xóa DanhMuc trong 1 transaction"""
    try:
        conn = mysql.connector.connect(
            host='localhost', user='root', password='123456', database='nhathuoc'
        )
        conn.start_transaction()
        cursor = conn.cursor()

        # 1) Xóa sản phẩm con
        cursor.execute("DELETE FROM SanPham WHERE MaDM = %s", (ma_dm,))
        deleted_products = cursor.rowcount

        # 2) Xóa danh mục
        cursor.execute("DELETE FROM DanhMuc WHERE MaDM = %s", (ma_dm,))
        deleted_danhmuc = cursor.rowcount

        if deleted_danhmuc == 0:
            # Không tìm thấy danh mục -> rollback
            conn.rollback()
            print(f"⚠️ Không tìm thấy DanhMuc MaDM={ma_dm}. Không xóa gì.")
        else:
            conn.commit()
            print(f"✅ Đã xóa DanhMuc MaDM={ma_dm} và {deleted_products} sản phẩm liên quan.")

    except Error as e:
        if conn and conn.is_connected():
            conn.rollback()
        print("❌ Lỗi khi xóa:", e)

    finally:
        if 'cursor' in locals():
            cursor.close()
        if 'conn' in locals() and conn.is_connected():
            conn.close()


def deletedanhmuc():
    return None