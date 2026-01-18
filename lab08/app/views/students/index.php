<h2 class="text-center text-primary mb-4">DANH SÁCH SINH VIÊN</h2>

<button class="btn btn-success mb-3" onclick="openModal()">+ Thêm mới sinh viên</button>

<table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Mã SV</th>
            <th>Họ và tên</th>
            <th>Email</th>
            <th>Ngày sinh</th>
            <th width="150">Hành động</th>
        </tr>
    </thead>
    <tbody id="studentTableBody">
        </tbody>
</table>

<div class="modal fade" id="studentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Thông tin sinh viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="studentForm">
                    <input type="hidden" id="studentId" name="id">
                    <div class="mb-3">
                        <label>Mã sinh viên (*)</label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label>Họ và tên (*)</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label>Email (*)</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label>Ngày sinh</label>
                        <input type="date" class="form-control" id="dob" name="dob">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Lưu dữ liệu</button>
                </form>
            </div>
        </div>
    </div>
</div>