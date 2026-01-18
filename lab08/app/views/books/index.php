<h2 class="text-center text-success mb-4">QUẢN LÝ THƯ VIỆN (SÁCH)</h2>

<div class="mb-3">
    <a href="index.php?c=student" class="btn btn-outline-secondary">Quản lý Sinh viên</a>
    <a href="index.php?c=book" class="btn btn-success">Quản lý Sách</a>
</div>

<button class="btn btn-primary mb-3" onclick="openBookModal()">+ Thêm Sách mới</button>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>ISBN</th>
            <th>Tên sách</th>
            <th>Tác giả</th>
            <th>Số lượng</th>
            <th width="150">Hành động</th>
        </tr>
    </thead>
    <tbody id="bookTableBody">
        </tbody>
</table>

<div class="modal fade" id="bookModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookModalTitle">Thông tin Sách</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="bookForm">
                    <input type="hidden" id="bookId" name="id">
                    
                    <div class="mb-3">
                        <label>Mã ISBN (*)</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" required>
                    </div>
                    <div class="mb-3">
                        <label>Tên sách (*)</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label>Tác giả (*)</label>
                        <input type="text" class="form-control" id="author" name="author" required>
                    </div>
                    <div class="mb-3">
                        <label>Số lượng (*)</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required min="0">
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100">Lưu dữ liệu</button>
                </form>
            </div>
        </div>
    </div>
</div>