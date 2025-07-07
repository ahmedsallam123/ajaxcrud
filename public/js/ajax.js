$(document).ready(function () {
    fetchUsers();

    $('#saveBtn').click(function () {
        let name = $('#name').val();
        let email = $('#email').val();
        let token = $('meta[name="csrf-token"]').attr('content');

        $.post('/userdata/store', { name, email, _token: token }, function (response) {
            $('#result').html('<p style="color:green">' + response.success + '</p>');
            $('#name').val('');
            $('#email').val('');
            fetchUsers();
        }).fail(function (xhr, status, error) {
            $('#result').html('<p style="color:red">حدث خطأ أثناء الإضافة: </p>');
        });
    });


    // زر التحديث في المودال
    $('#updateBtn').click(function () {
        let id = $('#edit_user_id').val();
        let name = $('#edit_name').val();
        let email = $('#edit_email').val();
        let token = $('meta[name="csrf-token"]').attr('content');

        $.post(`/userdata/update/${id}`, { name, email, _token: token }, function (response) {
            $('#result').html('<p style="color:blue">' + response.success + '</p>');
            $('#editModal').hide();
            fetchUsers();
        });
    });

    // زر تأكيد الحذف
    $('#confirmDeleteBtn').click(function () {
        let id = $('#delete_user_id').val();
        $.ajax({
            url: `/userdata/delete/${id}`,
            method: 'DELETE',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#result').html('<p style="color:red">' + response.success + '</p>');
                $('#deleteModal').hide();
                fetchUsers();
            },
            error: function (xhr, status, error) {
                 $('#result').html('<p style="color:red">حدث خطأ أثناء الإضافة: </p>');
            }
        });
    });

    window.editUser = function(id, name, email) {
        $('#edit_user_id').val(id);
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#editModal').show();
    }

    window.deleteUser = function(id) {
        $('#delete_user_id').val(id);
        $('#deleteModal').show();
    }

    function fetchUsers() {
        $.get('/userdata/all', function (data) {
            let rows = '';
            $.each(data, function (i, user) {
                rows += `
                    <tr>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>
                            <button onclick="editUser(${user.id}, '${user.name}', '${user.email}')">تعديل</button>
                            <button onclick="deleteUser(${user.id})">حذف</button>
                        </td>
                    </tr>
                `;
            });
            $('#usersTable tbody').html(rows);
        });
    }
});
