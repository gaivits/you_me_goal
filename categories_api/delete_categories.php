<?php
session_start();
require '../admin/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Start a transaction to ensure data integrity
    mysqli_begin_transaction($conn);

    try {
        // Step 1: Delete all products associated with this category
        $stmt_products = $conn->prepare("DELETE FROM products WHERE categories_id = ?");
        $stmt_products->bind_param("i", $id);
        $stmt_products->execute();
        $stmt_products->close();
        
        // Step 2: Delete all subcategories associated with this category
        $stmt_subcategories = $conn->prepare("DELETE FROM sub_categories WHERE categories_id = ?");
        $stmt_subcategories->bind_param("i", $id);
        $stmt_subcategories->execute();
        $stmt_subcategories->close();

        // Step 3: Delete the category itself
        $stmt_category = $conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt_category->bind_param("i", $id);
        $stmt_category->execute();
        $stmt_category->close();

        // Commit the transaction
        mysqli_commit($conn);
        $_SESSION['message'] = "ลบหมวดหมู่และข้อมูลที่เกี่ยวข้องทั้งหมดสำเร็จ";
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($conn);
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการลบหมวดหมู่: " . $e->getMessage();
    }
    
    header("Location: categories_dashboard.php");
    exit;
} else {
    $_SESSION['error'] = "รหัสหมวดหมู่ไม่ถูกต้อง";
    header("Location: ../admin/categories_dashboard.php");
    exit;
}
?>