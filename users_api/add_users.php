<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $retype_password = $_POST['retype_password'];
    $email = trim($_POST['email']);
    $permission_id = 2;
    $error_message = "";

    // --- 1. Validation ---
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } elseif ($password !== $retype_password) {
        $error_message = "Passwords do not match";
    }

    if (empty($error_message)) {
        // --- 2. Database connect ---
        $conn = new mysqli("localhost", "root", "", "your_dbname");
        if ($conn->connect_error) {
            $error_message = "Connection failed: " . $conn->connect_error;
        } else {
            // --- 3. Check duplicate username using a prepared statement ---
            $stmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
            if ($stmt) {
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $error_message = "Username already taken";
                }
                $stmt->close();
            } else {
                $error_message = "Error preparing statement: " . $conn->error;
            }

            if (empty($error_message)) {
                // --- 4. Insert user with secure password hashing ---
                // Hash the password using password_hash() for security
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                if ($hashed_password === false) {
                    $error_message = "Failed to hash password";
                } else {
                    $stmt = $conn->prepare(
                        "INSERT INTO users (username, password, permission_id, e_mail, create_at) 
                         VALUES (?, ?, ?, ?, NOW())"
                    );
                    if ($stmt) {
                        $stmt->bind_param("ssis", $username, $hashed_password, $permission_id, $email);
                        if ($stmt->execute()) {
                            // Registration successful, redirect to login page
                            header("Location: ../login.php?registration=success");
                            exit();
                        } else {
                            $error_message = "Error: " . $stmt->error;
                        }
                        $stmt->close();
                    } else {
                        $error_message = "Error preparing statement: " . $conn->error;
                    }
                }
            }
            $conn->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-sm">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Create Account</h1>
            <p class="text-gray-500 mt-2">Join us by creating a new account</p>
        </div>
        
        <!-- Display error message if it exists -->
        <?php if (isset($error_message) && !empty($error_message)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo htmlspecialchars($error_message); ?></span>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
            </div>
            <div>
                <label for="retype_password" class="block text-sm font-medium text-gray-700">Retype Password</label>
                <input type="password" id="retype_password" name="retype_password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
            </div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                Register
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a href="../users/user_login.php" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                    Login here
                </a>
            </p>
        </div>
    </div>
</body>
</html>
