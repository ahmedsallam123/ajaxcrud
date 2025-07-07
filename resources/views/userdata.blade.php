<!DOCTYPE html>
<html>
<head>
    <title>Ajax CRUD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>إضافة أو تعديل مستخدم</h2>
    <input type="hidden" id="user_id">
    <input type="text" id="name" placeholder="الاسم">
    <input type="email" id="email" placeholder="البريد">
    <button id="saveBtn">حفظ</button>

    <h3>كل المستخدمين</h3>
    <table border="1" id="usersTable">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>البريد</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <div id="result"></div>

    <!-- تعديل المستخدم -->
<div id="editModal" style="display:none; position:fixed; top:20%; left:30%; background:#fff; border:1px solid #ccc; padding:20px; z-index:1000">
    <h3>تعديل مستخدم</h3>
    <input type="hidden" id="edit_user_id">
    <input type="text" id="edit_name" placeholder="الاسم">
    <input type="email" id="edit_email" placeholder="البريد">
    <button id="updateBtn">تحديث</button>
    <button onclick="$('#editModal').hide()">إلغاء</button>
</div>

<!-- تأكيد الحذف -->
<div id="deleteModal" style="display:none; position:fixed; top:30%; left:35%; background:#fff; border:1px solid #ccc; padding:20px; z-index:1000">
    <h3>هل أنت متأكد من الحذف؟</h3>
    <input type="hidden" id="delete_user_id">
    <button id="confirmDeleteBtn">نعم، احذف</button>
    <button onclick="$('#deleteModal').hide()">إلغاء</button>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/ajax.js') }}"></script>
</body>
</html>
