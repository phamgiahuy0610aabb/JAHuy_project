from zoneinfo._common import load_data
from common.deletedanhmuc import delete_danhmuc
from common.insertdanhmuc import insert_danhmuc
from common.update_danhmuc import update_danhmuc
import tkinter as tk
from tkinter import messagebox, ttk
import mysql.connector
from mysql.connector import Error

# ==================== KẾT NỐI CSDL ====================
def connect_mysql():
    try:
        connection = mysql.connector.connect(
            host='localhost',
            user='root',
            password='',
            database='qlnhathuoc'
        )
        return connection
    except Error as e:
        messagebox.showerror("Lỗi", f"Lỗi kết nối CSDL: {e}")
        return None

# ==================== CÁC HÀM XỬ LÝ CRUD ====================
def load_data():
    """Hiển thị danh sách DanhMuc"""
    for i in tree.get_children():
        tree.delete(i)

    conn = connect_mysql()
    if conn:
        cursor = conn.cursor()
        cursor.execute("SELECT MaDM, TenDM, MoTa, TrangThai FROM DanhMuc")
        for row in cursor.fetchall():
            tree.insert("", tk.END, values=row)
        cursor.close()
        conn.close()

def add_danhmuc():
    """Thêm danh mục mới"""
    ten = entry_ten.get().strip()
    mota = entry_mota.get().strip()
    trangthai = var_trangthai.get()

    if ten == "":
        messagebox.showwarning("Thiếu thông tin", "Vui lòng nhập tên danh mục!")
        return

    conn = connect_mysql()
    if conn:
        cursor = conn.cursor()
        sql = "INSERT INTO DanhMuc (TenDM, MoTa, TrangThai) VALUES (%s, %s, %s)"
        cursor.execute(sql, (ten, mota, trangthai))
        conn.commit()
        cursor.close()
        conn.close()
        messagebox.showinfo("Thành công", f"Đã thêm danh mục: {ten}")
        load_data()
        clear_fields()

def delete_danhmuc():
    """Xóa danh mục được chọn"""
    selected = tree.focus()
    if not selected:
        messagebox.showwarning("Chưa chọn", "Hãy chọn một danh mục để xóa!")
        return
    data = tree.item(selected)['values']
    ma_dm = data[0]

    conn = connect_mysql()
    if conn:
        cursor = conn.cursor()
        cursor.execute("DELETE FROM DanhMuc WHERE MaDM = %s", (ma_dm,))
        conn.commit()
        cursor.close()
        conn.close()
        messagebox.showinfo("Đã xóa", f"Đã xóa danh mục có mã: {ma_dm}")
        load_data()

def update_danhmuc():
    """Cập nhật danh mục được chọn"""
    selected = tree.focus()
    if not selected:
        messagebox.showwarning("Chưa chọn", "Hãy chọn một danh mục để sửa!")
        return
    data = tree.item(selected)['values']
    ma_dm = data[0]

    ten = entry_ten.get().strip()
    mota = entry_mota.get().strip()
    trangthai = var_trangthai.get()

    if ten == "":
        messagebox.showwarning("Thiếu thông tin", "Vui lòng nhập tên danh mục!")
        return

    conn = connect_mysql()
    if conn:
        cursor = conn.cursor()
        sql = "UPDATE DanhMuc SET TenDM=%s, MoTa=%s, TrangThai=%s WHERE MaDM=%s"
        cursor.execute(sql, (ten, mota, trangthai, ma_dm))
        conn.commit()
        cursor.close()
        conn.close()
        messagebox.showinfo("Cập nhật", f"Đã sửa danh mục có mã: {ma_dm}")
        load_data()
        clear_fields()

def clear_fields():
    """Xóa nội dung ô nhập"""
    entry_ten.delete(0, tk.END)
    entry_mota.delete(0, tk.END)
    var_trangthai.set(1)

def on_select(event):
    """Khi chọn 1 hàng trong bảng"""
    selected = tree.focus()
    if selected:
        data = tree.item(selected)['values']
        entry_ten.delete(0, tk.END)
        entry_ten.insert(0, data[1])
        entry_mota.delete(0, tk.END)
        entry_mota.insert(0, data[2])
        var_trangthai.set(data[3])

# ==================== GIAO DIỆN CHÍNH ====================
root = tk.Tk()
root.title("Quản lý Danh Mục - Nhà Thuốc")
root.geometry("700x500")

# --- Form nhập ---
frame_form = tk.LabelFrame(root, text="Thông tin danh mục", padx=10, pady=10)
frame_form.pack(fill="x", padx=10, pady=5)

tk.Label(frame_form, text="Tên danh mục:").grid(row=0, column=0, sticky="w")
entry_ten = tk.Entry(frame_form, width=40)
entry_ten.grid(row=0, column=1, padx=5, pady=5)

tk.Label(frame_form, text="Mô tả:").grid(row=1, column=0, sticky="w")
entry_mota = tk.Entry(frame_form, width=40)
entry_mota.grid(row=1, column=1, padx=5, pady=5)

tk.Label(frame_form, text="Trạng thái:").grid(row=2, column=0, sticky="w")
var_trangthai = tk.IntVar(value=1)
tk.Radiobutton(frame_form, text="Hiển thị", variable=var_trangthai, value=1).grid(row=2, column=1, sticky="w")
tk.Radiobutton(frame_form, text="Ẩn", variable=var_trangthai, value=0).grid(row=2, column=1, sticky="e")

# --- Nút chức năng ---
frame_btn = tk.Frame(root)
frame_btn.pack(pady=5)
tk.Button(frame_btn, text="Thêm", width=10, command=add_danhmuc).grid(row=0, column=0, padx=5)
tk.Button(frame_btn, text="Sửa", width=10, command=update_danhmuc).grid(row=0, column=1, padx=5)
tk.Button(frame_btn, text="Xóa", width=10, command=delete_danhmuc).grid(row=0, column=2, padx=5)
tk.Button(frame_btn, text="Làm mới", width=10, command=clear_fields).grid(row=0, column=3, padx=5)

# --- Bảng hiển thị ---
frame_table = tk.Frame(root)
frame_table.pack(fill="both", expand=True, padx=10, pady=5)

columns = ("MaDM", "TenDM", "MoTa", "TrangThai")
tree = ttk.Treeview(frame_table, columns=columns, show="headings")
for col in columns:
    tree.heading(col, text=col)
    tree.column(col, width=150)

tree.pack(fill="both", expand=True)
tree.bind("<<TreeviewSelect>>", on_select)

# --- Khởi tạo dữ liệu ---
load_data()

root.mainloop()
