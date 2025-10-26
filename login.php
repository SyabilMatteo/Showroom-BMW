<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Query dengan semua kemungkinan kolom
    $query = "SELECT * FROM pengguna WHERE email = '$email' OR username = '$email' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Debugging - tampilkan data user (hapus setelah testing)
        echo "<script>console.log('User found:', " . json_encode($user) . ");</script>";
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id_pengguna'];
            $_SESSION['nama'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            
            echo "<script> window.location='home.html';</script>";
            exit;
        } else {
            echo "<script>alert('Maaf password yang anda masukkan salah, silahkan cek kembali password anda');</script>";
        }
    } else {
        echo "<script>alert('Maaf username atau gmail anda tidak bisa ditemukan');</script>";
    }
    
    // Debugging query error
    if (!$result) {
        echo "<script>alert('Query error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW ID Login</title>
    <link rel="stylesheet" href="./output.css">
</head>
<body class="h-screen w-full flex">
  <div class="flex flex-col justify-center items-center w-full md:w-1/2 bg-white px-10 md:px-20 relative">
    <a href="index.html" class="absolute top-8 left-8 flex items-center gap-2 text-gray-500 hover:text-[#0A7ABD] transition duration-300 font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>Back
    </a>

    <span class="inline-block w-24 h-24 bg-[url('./img/logobmw.png')] bg-cover bg-center mb-6"></span>
    <h2 class="text-3xl font-thin mb-2 text-center">BMW ID LOGIN</h2>
    <p class="text-gray-500 mb-8 text-center">Login to continue your journey</p>

    <form method="POST" class="w-full max-w-sm">
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium opacity-60 text-gray-600">Username atau Email</label>
            <!-- 🔹 ubah type dari email → text agar username juga bisa diterima -->
            <input type="text" id="email" name="email" placeholder="Silahkan masukkan username atau gmail anda"
                   class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium opacity-60 text-gray-600">Password</label>
            <input type="password" id="password" name="password" placeholder="Silahkan masukkan password anda"
                   class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <button type="submit" class="w-full bg-[#1C69D4] text-white p-4 rounded-md font-semibold hover:bg-[#213120] transition-colors duration-300 cursor-pointer">Log In</button>

        <p class="text-sm text-gray-500 text-center mt-4">Don't have a BMW ID? Register 
            <a href="register.php" class="text-blue-600 hover:underline">here.</a>
        </p>
    </form>
  </div>

  <div class="hidden md:block md:w-1/2 h-screen">
      <img src="./img/bannerlogin.png" alt="BMW Car" class="w-full h-full object-cover">
  </div>
</body>
</html>
