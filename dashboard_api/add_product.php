<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../admin_login.php");
    exit;
}

require '../admin/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['category_id'] ?? null;
    $product_name = $_POST['product_name'] ?? null;
    $product_desc = $_POST['product_desc'] ?? null;
    $product_amount = $_POST['product_amount'] ?? null;
    $product_price = $_POST['product_price'] ?? null;
    $product_image_base64 = null;

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp_path = $_FILES['product_image']['tmp_name'];
        $image_data = file_get_contents($file_tmp_path);
        $product_image_base64 = base64_encode($image_data);
    }

    if ($category_id && $product_name && $product_amount && $product_price) {
        // Start transaction
        mysqli_begin_transaction($conn);

        try {
            // 1. Insert into sub_categories table
            $stmt_subcat = mysqli_prepare($conn, "INSERT INTO sub_categories (categories_id, subcategories_name, subcategories_desc, subcategories_img) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt_subcat, "isss", $category_id, $product_name, $product_desc, $product_image_base64);
            if (!mysqli_stmt_execute($stmt_subcat)) {
                throw new Exception("Error inserting subcategory: " . mysqli_error($conn));
            }
            $last_subcat_id = mysqli_insert_id($conn);

            // 2. Insert into products table
            $stmt_prod = mysqli_prepare($conn, "INSERT INTO products (categories_id, subcategories_id, products_amount, products_price) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt_prod, "iiss", $category_id, $last_subcat_id, $product_amount, $product_price);
            if (!mysqli_stmt_execute($stmt_prod)) {
                throw new Exception("Error inserting product: " . mysqli_error($conn));
            }

            // If all queries were successful, commit the transaction
            mysqli_commit($conn);
            $_SESSION['message'] = "สินค้าถูกเพิ่มเรียบร้อยแล้ว";
        } catch (Exception $e) {
            // If any query failed, rollback the transaction
            mysqli_rollback($conn);
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการเพิ่มสินค้า: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
    }

    header("Location: ../admin/dashboard.php?category=" . urlencode($category_id));
    exit;
}
?>