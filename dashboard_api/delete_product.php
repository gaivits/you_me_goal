<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../admin_login.php");
    exit;
}

require '../db.php';

$product_id = $_GET['id'] ?? null;
$category_id = $_GET['category'] ?? null;

if ($product_id) {
    mysqli_begin_transaction($conn);
    try {
        $stmt_get_subcat_id = mysqli_prepare($conn, "SELECT subcategories_id, categories_id FROM products WHERE id = ?");
        mysqli_stmt_bind_param($stmt_get_subcat_id, "i", $product_id);
        mysqli_stmt_execute($stmt_get_subcat_id);
        $result = mysqli_stmt_get_result($stmt_get_subcat_id);
        $row = mysqli_fetch_assoc($result);
        $subcategory_id = $row['subcategories_id'];
        $category_id = $row['categories_id'];

        // Delete from products table
        $stmt_prod = mysqli_prepare($conn, "DELETE FROM products WHERE id = ?");
        mysqli_stmt_bind_param($stmt_prod, "i", $product_id);
        if (!mysqli_stmt_execute($stmt_prod)) {
            throw new Exception("Error deleting product: " . mysqli_error($conn));
        }

        // Delete from sub_categories table
        $stmt_subcat = mysqli_prepare($conn, "DELETE FROM sub_categories WHERE id = ?");
        mysqli_stmt_bind_param($stmt_subcat, "i", $subcategory_id);
        if (!mysqli_stmt_execute($stmt_subcat)) {
            throw new Exception("Error deleting subcategory: " . mysqli_error($conn));
        }

        mysqli_commit($conn);
        $_SESSION['message'] = "สินค้าถูกลบเรียบร้อยแล้ว";
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการลบสินค้า: " . $e->getMessage();
    }
}

if ($category_id) {
    header("Location: ../admin/dashboard.php?category=" . urlencode($category_id));
} else {
    header("Location: ../admin/dashboard.php");
}
exit;
?>