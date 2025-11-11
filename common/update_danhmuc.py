import mysql.connector
from mysql.connector import Error

from ketnoidv.ketnoi_mysql import connect_mysql


def update_danhmuc(ma_dm, ten_moi=None, mo_ta_moi=None, trang_thai_moi=None):
    """Hàm cập nhật thông tin danh mục"""
    try:
        conn = connect_mysql()
        if conn is None:
            return

        cursor = conn.cursor()

        # Xây dựng câu SQL động (chỉ cập nhật trường có giá trị mới)
        fields = []
        values = []

        if ten_moi:
            fields.append("TenDM = %s")
            values.append(ten_moi)
        if mo_ta_moi:
            fields.append("MoTa = %s")
            values.append(mo_ta_moi)
        if trang_thai_moi is not None:
            fields.append("TrangThai = %s")
            values.append(trang_thai_moi)

        if not fields:
            print("⚠️ Không có dữ liệu mới để cập nhật.")
            return

        sql = f"UPDATE DanhMuc SET {', '.join(fields)} WHERE MaDM = %s"
        values.append(ma_dm)

        cursor.execute(sql, tuple(values))
        conn.commit()

        if cursor.rowcount > 0:
            print(f"✅ Đã cập nhật danh mục có MaDM = {ma_dm}")
        else:
            print(f"⚠️ Không tìm thấy danh mục có MaDM = {ma_dm}")

    except Error as e:
        print("❌ Lỗi khi cập nhật danh mục:", e)

    finally:
        if conn.is_connected():
            cursor.close()
            conn.close()


# --- Kiểm tra thử ---
if __name__ == "__main__":
    update_danhmuc(
        ma_dm=2,
        ten_moi="Dược phẩm & Thiết bị y tế",
        mo_ta_moi="Danh mục bao gồm thuốc và thiết bị y tế gia đình",
        trang_thai_moi=1
    )
