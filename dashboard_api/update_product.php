<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../admin_login.php");
    exit;
}

require '../admin/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? null;
    $subcategory_id = $_POST['subcategory_id'] ?? null;
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

    if ($product_id && $subcategory_id && $category_id && $product_name && $product_amount && $product_price) {
        // Start transaction
        mysqli_begin_transaction($conn);
        try {
            // Update sub_categories table
            if ($product_image_base64) {
                $stmt_subcat = mysqli_prepare($conn, "UPDATE sub_categories SET subcategories_name = ?, subcategories_desc = ?, subcategories_img = ? WHERE id = ?");
                mysqli_stmt_bind_param($stmt_subcat, "sssi", $product_name, $product_desc, $product_image_base64, $subcategory_id);
            } else {
                $stmt_subcat = mysqli_prepare($conn, "UPDATE sub_categories SET subcategories_name = ?, subcategories_desc = ? WHERE id = ?");
                mysqli_stmt_bind_param($stmt_subcat, "ssi", $product_name, $product_desc, $subcategory_id);
            }
            if (!mysqli_stmt_execute($stmt_subcat)) {
                throw new Exception("Error updating subcategory: " . mysqli_error($conn));
            }

            // Update products table
            $stmt_prod = mysqli_prepare($conn, "UPDATE products SET products_amount = ?, products_price = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt_prod, "ssi", $product_amount, $product_price, $product_id);
            if (!mysqli_stmt_execute($stmt_prod)) {
                throw new Exception("Error updating product: " . mysqli_error($conn));
            }

            mysqli_commit($conn);
            $_SESSION['message'] = "สินค้าถูกแก้ไขเรียบร้อยแล้ว";
        } catch (Exception $e) {
            mysqli_rollback($conn);
            $_SESSION['error'] = "เกิดข้อผิดพลาดในการแก้ไขสินค้า: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "กรุณากรอกข้อมูลให้ครบถ้วน";
    }

    header("Location: ../admin/dashboard.php?category=" . urlencode($category_id));
    exit;
}
?>