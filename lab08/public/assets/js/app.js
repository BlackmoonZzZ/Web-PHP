// --- PHẦN CODE XỬ LÝ CHO BOOK (THÊM VÀO CUỐI FILE) ---

// Kiểm tra xem có đang ở trang Sách không (dựa vào URL ?c=book)
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('c') === 'book') {

    $(document).ready(function() {
        loadBooks(); // Load danh sách sách ngay khi vào trang

        // Xử lý submit form Sách
        $('#bookForm').submit(function(e) {
            e.preventDefault();
            
            let id = $('#bookId').val();
            let action = id ? 'update' : 'store'; // Có ID là sửa, ko có là thêm
            
            $.ajax({
                url: `index.php?c=book&a=${action}`,
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        alert(res.message);
                        $('#bookModal').modal('hide');
                        loadBooks(); // Load lại bảng
                    } else {
                        alert(res.message);
                    }
                },
                error: function() { alert('Có lỗi xảy ra!'); }
            });
        });
    });

    // Hàm load danh sách sách
    function loadBooks() {
        $.ajax({
            url: 'index.php?c=book&a=getList',
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    let html = '';
                    res.data.forEach(book => {
                        html += `
                            <tr>
                                <td>${book.id}</td>
                                <td>${book.isbn}</td>
                                <td>${book.title}</td>
                                <td>${book.author}</td>
                                <td>${book.quantity}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editBook(${book.id})">Sửa</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteBook(${book.id})">Xóa</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#bookTableBody').html(html);
                }
            }
        });
    }

    // Hàm mở Modal thêm mới
    window.openBookModal = function() { // Gán vào window để gọi được từ HTML
        $('#bookForm')[0].reset();
        $('#bookId').val('');
        $('#bookModalTitle').text('Thêm sách mới');
        $('#bookModal').modal('show');
    }

    // Hàm sửa sách
    window.editBook = function(id) {
        $.ajax({
            url: `index.php?c=book&a=edit&id=${id}`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.success) {
                    let b = res.data;
                    $('#bookId').val(b.id);
                    $('#isbn').val(b.isbn);
                    $('#title').val(b.title);
                    $('#author').val(b.author);
                    $('#quantity').val(b.quantity);
                    
                    $('#bookModalTitle').text('Cập nhật sách');
                    $('#bookModal').modal('show');
                } else {
                    alert(res.message);
                }
            }
        });
    }

    // Hàm xóa sách
    window.deleteBook = function(id) {
        if (confirm('Bạn có chắc chắn muốn xóa sách này?')) {
            $.ajax({
                url: 'index.php?c=book&a=delete',
                type: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        loadBooks();
                    } else {
                        alert(res.message);
                    }
                }
            });
        }
    }
}