<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
require './db.php';

$message = $_SESSION['message'] ?? null;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['message'], $_SESSION['error']);

$categories_result = mysqli_query($conn, "SELECT * FROM categories ORDER BY categories_name");
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>จัดการหมวดหมู่สินค้า</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: #fff;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 90%;
            position: relative;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col items-center py-10">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-6xl text-center">
        <h1 class="text-2xl font-bold mb-4">จัดการหมวดหมู่สินค้า</h1>
        <a href="dashboard.php" class="inline-block mb-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">กลับสู่หน้า Dashboard หลัก</a>
        <button id="showAddCategoryModalBtn" class="ml-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">เพิ่มหมวดหมู่ใหม่</button>

        <?php if ($message): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                <p><?= htmlspecialchars($message) ?></p>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p><?= htmlspecialchars($error) ?></p>
            </div>
        <?php endif; ?>

        <div class="overflow-x-auto mt-6">
            <table class="min-w-full bg-white border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">รหัส</th>
                        <th class="border p-2">ชื่อหมวดหมู่</th>
                        <th class="border p-2">คำอธิบาย</th>
                        <th class="border p-2">รูปภาพ</th>
                        <th class="border p-2">ไอคอน</th>
                        <th class="border p-2">การดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($categories_result) > 0): ?>
                        <?php while ($category = mysqli_fetch_assoc($categories_result)): ?>
                            <tr>
                                <td class="border p-2"><?= htmlspecialchars($category['id']) ?></td>
                                <td class="border p-2"><?= htmlspecialchars($category['categories_name']) ?></td>
                                <td class="border p-2"><?= htmlspecialchars($category['categories_desc'] ?? '') ?></td>
                                <td class="border p-2">
                                    <?php if (!empty($category['categories_img'])): ?>
                                        <img src="data:image/jpeg;base64,<?= htmlspecialchars($category['categories_img']) ?>"
                                            alt="<?= htmlspecialchars($category['categories_name']) ?>"
                                            class="w-24 h-24 object-contain rounded mx-auto">
                                    <?php else: ?>
                                        ไม่มีรูปภาพ
                                    <?php endif; ?>
                                </td>
                                <td class="border p-2">
                                     <?php if (!empty($category['categories_icon'])): ?>
                                        <img src="<?= htmlspecialchars($category['categories_icon']) ?>"
                                            alt="Icon"
                                            class="w-12 h-12 object-contain rounded mx-auto">
                                    <?php else: ?>
                                        ไม่มีไอคอน
                                    <?php endif; ?>
                                </td>
                                <td class="border p-2">
                                    <button class="edit-btn px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm"
                                        data-id="<?= htmlspecialchars($category['id']) ?>"
                                        data-name="<?= htmlspecialchars($category['categories_name']) ?>"
                                        data-desc="<?= htmlspecialchars($category['categories_desc'] ?? '') ?>">
                                        แก้ไข
                                    </button>
                                    <a href="../admin/delete_categories.php?id=<?= htmlspecialchars($category['id']) ?>"
                                        onclick="return confirm('การลบหมวดหมู่จะลบข้อมูลที่เกี่ยวข้องทั้งหมด คุณแน่ใจหรือไม่ที่จะลบ?');"
                                        class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                        ลบ
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="p-4 text-center">ไม่มีหมวดหมู่ในขณะนี้</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="addCategoryModal" class="modal-overlay hidden">
        <div class="modal-content">
            <h3 class="text-xl font-bold mb-4">เพิ่มหมวดหมู่ใหม่</h3>
            <form action="../categories_api/add_categories.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="addCategoryName" class="block font-semibold mb-1">ชื่อหมวดหมู่:</label>
                    <input type="text" name="name" id="addCategoryName" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addCategoryDesc" class="block font-semibold mb-1">คำอธิบาย:</label>
                    <textarea name="desc" id="addCategoryDesc" rows="3" class="w-full border p-2 rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label for="addImage" class="block font-semibold mb-1">รูปภาพ:</label>
                    <input type="file" name="image" id="addImage" class="w-full p-2 rounded border" accept="image/*">
                </div>
                 <div class="mb-4">
                    <label for="addIcon" class="block font-semibold mb-1">URL ไอคอน:</label>
                    <input type="text" name="icon_url" id="addIcon" class="w-full border p-2 rounded">
                    <small class="text-gray-500">กรอก URL ของไอคอน (เช่น https://example.com/icon.png)</small>
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" class="close-modal-btn px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">ยกเลิก</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">บันทึก</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editCategoryModal" class="modal-overlay hidden">
        <div class="modal-content">
            <h3 class="text-xl font-bold mb-4">แก้ไขหมวดหมู่</h3>
            <form action="../categories_api/update_categories.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="modalCategoryId">
                <div class="mb-4">
                    <label for="modalCategoryName" class="block font-semibold mb-1">ชื่อหมวดหมู่:</label>
                    <input type="text" name="name" id="modalCategoryName" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="modalCategoryDesc" class="block font-semibold mb-1">คำอธิบาย:</label>
                    <textarea name="desc" id="modalCategoryDesc" rows="3" class="w-full border p-2 rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label for="editImage" class="block font-semibold mb-1">รูปภาพ:</label>
                    <input type="file" name="image" id="editImage" class="w-full p-2 rounded border" accept="image/*">
                    <small class="text-gray-500">ปล่อยว่างหากไม่ต้องการเปลี่ยนรูปภาพ</small>
                </div>
                <div class="mb-4">
                    <label for="editIcon" class="block font-semibold mb-1">URL ไอคอน:</label>
                    <input type="text" name="icon_url" id="editIcon" class="w-full border p-2 rounded">
                    <small class="text-gray-500">ปล่อยว่างหากไม่ต้องการเปลี่ยนไอคอน</small>
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" class="close-modal-btn px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">ยกเลิก</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">บันทึก</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addCategoryModal = document.getElementById('addCategoryModal');
        const editCategoryModal = document.getElementById('editCategoryModal');
        const showAddCategoryModalBtn = document.getElementById('showAddCategoryModalBtn');
        const closeModalButtons = document.querySelectorAll('.close-modal-btn');
        const editButtons = document.querySelectorAll('.edit-btn');

        showAddCategoryModalBtn.addEventListener('click', () => {
            addCategoryModal.classList.remove('hidden');
        });

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.dataset.id;
                const name = button.dataset.name;
                const desc = button.dataset.desc;

                document.getElementById('modalCategoryId').value = id;
                document.getElementById('modalCategoryName').value = name;
                document.getElementById('modalCategoryDesc').value = desc;

                editCategoryModal.classList.remove('hidden');
            });
        });

        closeModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                addCategoryModal.classList.add('hidden');
                editCategoryModal.classList.add('hidden');
            });
        });

        addCategoryModal.addEventListener('click', (e) => {
            if (e.target === addCategoryModal) {
                addCategoryModal.classList.add('hidden');
            }
        });

        editCategoryModal.addEventListener('click', (e) => {
            if (e.target === editCategoryModal) {
                editCategoryModal.classList.add('hidden');
            }
        });
    </script>
</body>

</html>