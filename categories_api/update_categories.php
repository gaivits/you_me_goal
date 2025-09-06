<?php
session_start();
require '../admin/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'] ?? null;
    $icon_url = $_POST['icon_url'] ?? null;

    $query = "UPDATE categories SET categories_name = ?, categories_desc = ?";
    $params = [$name, $desc];
    $types = "ss";

    if (!empty($_FILES['image']['tmp_name'])) {
        $image_content = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
        $query .= ", categories_img = ?";
        $params[] = $image_content;
        $types .= "s";
    }
    
    if ($icon_url !== null) {
        $query .= ", categories_icon = ?";
        $params[] = $icon_url;
        $types .= "s";
    }

    $query .= " WHERE id = ?";
    $params[] = $id;
    $types .= "i";

    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $_SESSION['message'] = "แก้ไขหมวดหมู่สำเร็จ";
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการแก้ไขหมวดหมู่: " . $stmt->error;
    }

    $stmt->close();
    header("Location: ../admin/categories_dashboard.php");
    exit;
} else {
    header("Location: ../admin/categories_dashboard.php");
    exit;
}
?>