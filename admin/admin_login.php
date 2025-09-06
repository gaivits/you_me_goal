<?php
session_start();
require './db.php'; // เชื่อมต่อฐานข้อมูล $conn

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // ป้องกัน SQL Injection
    $username = mysqli_real_escape_string($conn, $username);

    // ดึงข้อมูลผู้ใช้จากฐานข้อมูล
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // ตรวจสอบรหัสผ่าน (เปรียบเทียบ MD5 hash)
        if (md5($password) === $user['password']) {
            // เก็บข้อมูลเซสชันอย่างปลอดภัย
            $_SESSION['admin'] = [
                'username' => $user['username'],
                'id' => $user['id']
            ];
            header("Location: dashboard.php");
            exit;
        } else {
            $msg = "Username หรือ Password ไม่ถูกต้อง";
        }
    } else {
        $msg = "Username หรือ Password ไม่ถูกต้อง";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="bg-white p-8 rounded-xl shadow-lg w-96">
    <h2 class="text-2xl font-bold mb-6 text-center">Admin Login</h2>
    <?php if($msg): ?>
      <p class="text-red-500 mb-4 text-center"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>
    <form method="POST" class="space-y-4">
      <input type="text" name="username" placeholder="Username" required class="w-full border rounded-xl px-4 py-2">
      <input type="password" name="password" placeholder="Password" required class="w-full border rounded-xl px-4 py-2">
      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700">Login</button>
    </form>
  </div>
</body>
</html>