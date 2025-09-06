<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}
require './db.php';

$selected_category_id = $_GET['category'] ?? '';
$page = max(1, intval($_GET['page'] ?? 1));
$items_per_page = 15;
$offset = ($page - 1) * $items_per_page;

$categories_result = mysqli_query($conn, "SELECT id, categories_name FROM categories ORDER BY categories_name") or die(mysqli_error($conn));
$total_items = 0;
$products_result = false;
$selected_category_name = '';

if (!empty($selected_category_id) && filter_var($selected_category_id, FILTER_VALIDATE_INT)) {
    $selected_category_id = intval($selected_category_id);

    $stmt = mysqli_prepare($conn, "SELECT categories_name FROM categories WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $selected_category_id);
    mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
    $res = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($res)) {
        $selected_category_name = $row['categories_name'];
    }

    $stmt = mysqli_prepare($conn, "SELECT COUNT(*) AS total FROM products WHERE categories_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $selected_category_id);
    mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
    $res = mysqli_stmt_get_result($stmt);
    $total_items = mysqli_fetch_assoc($res)['total'];

    $products_query = "
        SELECT
            p.id,
            p.products_amount,
            p.products_price,
            sc.subcategories_name,
            sc.subcategories_img,
            sc.subcategories_desc,
            sc.id as subcategory_id
        FROM products p
        JOIN sub_categories sc ON p.subcategories_id = sc.id
        WHERE p.categories_id = ?
        LIMIT ?, ?
    ";
    $stmt = mysqli_prepare($conn, $products_query);
    mysqli_stmt_bind_param($stmt, "iii", $selected_category_id, $offset, $items_per_page);
    mysqli_stmt_execute($stmt) or die(mysqli_error($conn));
    $products_result = mysqli_stmt_get_result($stmt);
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
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
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-start py-10">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-6xl text-center">
        <h1 class="text-2xl font-bold mb-4">Welcome, <?= htmlspecialchars($_SESSION['admin']['username']) ?></h1>
        <p class="mb-6">นี่คือหน้า Admin Dashboard</p>

        <div class="mb-6 flex justify-center items-center flex-wrap gap-4">
            <form method="get" class="inline-block">
                <label for="category" class="mr-2 font-semibold">เลือกหมวดหมู่:</label>
                <select name="category" id="category" class="border p-2 rounded">
                    <option value="">-- เลือกหมวดหมู่ --</option>
                    <?php
                    mysqli_data_seek($categories_result, 0);
                    while ($cat = mysqli_fetch_assoc($categories_result)): ?>
                        <option value="<?= htmlspecialchars($cat['id']) ?>" <?= ($selected_category_id == $cat['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['categories_name']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">เลือก</button>
            </form>
            <button id="showAddModalBtn" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">เพิ่มสินค้าใหม่</button>
            <a href="categories_dashboard.php" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">จัดการหมวดหมู่</a>
        </div>

        <?php if ($selected_category_id && $selected_category_name): ?>
            <h2 class="text-xl font-bold mb-4">หมวดหมู่: <?= htmlspecialchars($selected_category_name) ?></h2>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">รูปภาพ</th>
                            <th class="border p-2">รหัสสินค้า</th>
                            <th class="border p-2">ชื่อสินค้า</th>
                            <th class="border p-2">จำนวนสินค้า</th>
                            <th class="border p-2">ราคา(฿)</th>
                            <th class="border p-2">การดำเนินการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($products_result && mysqli_num_rows($products_result) > 0): ?>
                            <?php while ($product = mysqli_fetch_assoc($products_result)): ?>
                                <tr>
                                    <td class="border p-2 text-center">
                                        <?php if (!empty($product['subcategories_img'])): ?>
                                            <img src="data:image/jpeg;base64,<?= htmlspecialchars($product['subcategories_img']) ?>"
                                                 alt="<?= htmlspecialchars($product['subcategories_name']) ?>"
                                                 class="w-16 h-16 object-cover rounded mx-auto">
                                        <?php else: ?>
                                            ไม่มีรูปภาพ
                                        <?php endif; ?>
                                    </td>
                                    <td class="border p-2"><?= htmlspecialchars($product['id']) ?></td>
                                    <td class="border p-2"><?= htmlspecialchars($product['subcategories_name']) ?></td>
                                    <td class="border p-2"><?= htmlspecialchars($product['products_amount']) ?></td>
                                    <td class="border p-2"><?= htmlspecialchars($product['products_price']) ?></td>
                                    <td class="border p-2">
                                        <button class="edit-btn px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm"
                                                data-id="<?= htmlspecialchars($product['id']) ?>"
                                                data-subcategory-id="<?= htmlspecialchars($product['subcategory_id']) ?>"
                                                data-name="<?= htmlspecialchars($product['subcategories_name']) ?>"
                                                data-desc="<?= htmlspecialchars($product['subcategories_desc']) ?>"
                                                data-amount="<?= htmlspecialchars($product['products_amount']) ?>"
                                                data-price="<?= htmlspecialchars($product['products_price']) ?>"
                                                data-img="data:image/jpeg;base64,<?= htmlspecialchars($product['subcategories_img']) ?>">
                                            แก้ไข
                                        </button>
                                        <a href="../dashboard_api/delete_product.php?id=<?= htmlspecialchars($product['id']) ?>"
                                           class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                            ลบ
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="p-4 text-center">ไม่พบสินค้าในหมวดหมู่นี้</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php
            $total_pages = ceil($total_items / $items_per_page);
            if ($total_pages > 1):
            ?>
                <div class="mt-4 flex justify-center space-x-2">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?category=<?= urlencode($selected_category_id) ?>&page=<?= $i ?>"
                           class="px-3 py-1 border rounded <?= ($i == $page) ? 'bg-blue-600 text-white' : 'hover:bg-gray-200' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <a href="logout.php" class="mt-6 inline-block px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700">Logout</a>
    </div>

    <!-- Modal Add -->
    <div id="addModal" class="modal-overlay hidden">
        <div class="modal-content">
            <h3 class="text-xl font-bold mb-4">เพิ่มสินค้าใหม่</h3>
            <form action="../dashboard_api/add_product.php" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label for="addCategory" class="block font-semibold mb-1">หมวดหมู่:</label>
                    <select name="category_id" id="addCategory" class="w-full border p-2 rounded" required>
                        <option value="">-- เลือกหมวดหมู่ --</option>
                        <?php
                        mysqli_data_seek($categories_result, 0);
                        while ($cat = mysqli_fetch_assoc($categories_result)): ?>
                            <option value="<?= htmlspecialchars($cat['id']) ?>"><?= htmlspecialchars($cat['categories_name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="addName" class="block font-semibold mb-1">ชื่อสินค้า:</label>
                    <input type="text" name="product_name" id="addName" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addDesc" class="block font-semibold mb-1">คำอธิบาย:</label>
                    <textarea name="product_desc" id="addDesc" rows="3" class="w-full border p-2 rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label for="addAmount" class="block font-semibold mb-1">จำนวนคงเหลือ:</label>
                    <input type="number" name="product_amount" id="addAmount" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addPrice" class="block font-semibold mb-1">ราคาต่อชิ้น(฿):</label>
                    <input type="text" name="product_price" id="addPrice" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="addImage" class="block font-semibold mb-1">รูปภาพสินค้า (ไฟล์):</label>
                    <input type="file" name="product_image" id="addImage" class="w-full border p-2 rounded">
                </div>
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" class="close-modal-btn px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">ยกเลิก</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">บันทึก</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit -->
    <div id="editModal" class="modal-overlay hidden">
        <div class="modal-content">
            <h3 class="text-xl font-bold mb-4">แก้ไขสินค้า</h3>
            <form action="../dashboard_api/update_product.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="product_id" id="modalProductId">
                <input type="hidden" name="subcategory_id" id="modalSubcategoryId">
                <input type="hidden" name="category_id" value="<?= htmlspecialchars($selected_category_id) ?>">

                <div class="mb-4">
                    <label for="modalImagePreview" class="block font-semibold mb-1">รูปภาพปัจจุบัน:</label>
                    <img id="modalImagePreview" src="" alt="Product Image" class="w-24 h-24 object-cover rounded mb-2">
                    <input type="file" name="product_image" class="w-full border p-2 rounded">
                    <small class="text-gray-500">เลือกไฟล์ใหม่เพื่ออัปเดต</small>
                </div>
                <div class="mb-4">
                    <label for="modalName" class="block font-semibold mb-1">ชื่อสินค้า:</label>
                    <input type="text" name="product_name" id="modalName" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="modalDesc" class="block font-semibold mb-1">คำอธิบาย:</label>
                    <textarea name="product_desc" id="modalDesc" rows="3" class="w-full border p-2 rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label for="modalAmount" class="block font-semibold mb-1">จำนวนคงเหลือ:</label>
                    <input type="number" name="product_amount" id="modalAmount" class="w-full border p-2 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="modalPrice" class="block font-semibold mb-1">ราคาต่อชิ้น(฿):</label>
                    <input type="text" name="product_price" id="modalPrice" class="w-full border p-2 rounded" required>
                </div>

                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" class="close-modal-btn px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">ยกเลิก</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">บันทึก</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addModal = document.getElementById('addModal');
        const showAddModalBtn = document.getElementById('showAddModalBtn');
        const editModal = document.getElementById('editModal');
        const closeModalButtons = document.querySelectorAll('.close-modal-btn');
        const editButtons = document.querySelectorAll('.edit-btn');

        showAddModalBtn.addEventListener('click', () => addModal.classList.remove('hidden'));

        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('modalProductId').value = button.dataset.id;
                document.getElementById('modalSubcategoryId').value = button.dataset.subcategoryId;
                document.getElementById('modalName').value = button.dataset.name;
                document.getElementById('modalDesc').value = button.dataset.desc;
                document.getElementById('modalAmount').value = button.dataset.amount;
                document.getElementById('modalPrice').value = button.dataset.price;
                document.getElementById('modalImagePreview').src = button.dataset.img;
                editModal.classList.remove('hidden');
            });
        });

        closeModalButtons.forEach(button => button.addEventListener('click', () => {
            addModal.classList.add('hidden');
            editModal.classList.add('hidden');
        }));

        addModal.addEventListener('click', e => {
            if (e.target === addModal) addModal.classList.add('hidden');
        });
        editModal.addEventListener('click', e => {
            if (e.target === editModal) editModal.classList.add('hidden');
        });
    </script>
</body>
</html>