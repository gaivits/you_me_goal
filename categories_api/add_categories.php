<?php
session_start();
require '../admin/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['desc'] ?? null;
    $icon_url = $_POST['icon_url'] ?? null;
    $image_content = null;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_content = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
    }

    $stmt = $conn->prepare("INSERT INTO categories (categories_name, categories_desc, categories_img, categories_icon) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $desc, $image_content, $icon_url);

    if ($stmt->execute()) {
        $_SESSION['message'] = "เพิ่มหมวดหมู่ใหม่สำเร็จ";
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการเพิ่มหมวดหมู่: " . $stmt->error;
    }

    $stmt->close();
    header("Location: ../admin/categories_dashboard.php");
    exit;
} else {
    header("Location: ../admin/categories_dashboard.php");
    exit;
}
?>