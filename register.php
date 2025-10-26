<?php<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $address  = mysqli_real_escape_string($conn, $_POST['address']);

    // --- CEK KELENGKAPAN DATA ---
    if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($address)) {
        echo "<script>alert('Tolong isi semua data anda terlebih dahulu'); window.history.back();</script>";
        exit;
    }

    // --- CEK PANJANG PASSWORD ---
    if (strlen($password) < 8) {
        echo "<script>alert('Password minimal 8 karakter'); window.history.back();</script>";
        exit;
    }

    // --- CEK DUPLIKASI USERNAME / EMAIL ---
    $check_sql = "SELECT * FROM pengguna WHERE username='$username'";
    $result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username yang anda masukkan sudah terdaftar, tolong masukkan usename yang lain'); window.history.back();</script>";
        exit;
    }

    // --- ENKRIPSI PASSWORD ---
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // --- UPLOAD FOTO PROFIL ---
    $profilePic = "";
    if (!empty($_FILES["profilePic"]["name"])) {
        $targetDir = "upload_FP/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = basename($_FILES["profilePic"]["name"]);
        $targetFilePath = $targetDir . time() . "_" . $fileName;
        if (move_uploaded_file($_FILES["profilePic"]["tmp_name"], $targetFilePath)) {
            $profilePic = $targetFilePath;
        }
    }

    // --- SIMPAN KE DATABASE ---
    $sql = "INSERT INTO pengguna (username, email, no_telp, password, alamat, foto_profil, tanggal_daftar)
            VALUES ('$username', '$email', '$phone', '$hashed_password', '$address', '$profilePic', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>window.location='home.html';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMW ID Registration</title>
    <link rel="stylesheet" href="./output.css">
</head>
<body class="min-h-screen w-full flex">
  <!-- KIRI: BANNER -->
  <div class="hidden md:block md:w-1/2 h-screen sticky top-0">
      <img src="./img/bannerlogin.png" alt="BMW Car" class="w-full h-full object-cover">
  </div>

  <!-- KANAN: FORM REGISTER -->
  <div class="relative flex flex-col justify-start items-center w-full md:w-1/2 bg-white px-10 md:px-20 overflow-y-auto min-h-screen">
    <a href="index.html" class="absolute top-8 left-8 flex items-center gap-2 text-gray-500 hover:text-[#0A7ABD] transition duration-300 font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
        </svg>Back
    </a>

    <div class="mt-32 flex flex-col justify-start items-center w-full max-w-md">
      <span class="block w-24 h-24 bg-[url('./img/logobmw.png')] bg-cover bg-center mb-6 shrink-0"></span>
      <h2 class="text-3xl font-thin mb-2 text-center">BMW ID REGISTRATION</h2>
      <p class="text-gray-500 mb-8 text-center">Register to start your journey</p>

      <form method="POST" enctype="multipart/form-data" class="w-full max-w-md pb-10">
          <div class="mb-4">
              <label for="username" class="block mb-2 text-sm font-medium opacity-60 text-gray-600">Username</label>
              <input type="text" id="username" name="username" required placeholder=" Silahkan isi nama anda"
                     class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
          </div>

          <div class="flex flex-col md:flex-row md:gap-4 mb-4">
              <div class="w-full">
                  <label for="email" class="block mb-2 text-sm font-medium opacity-60 text-gray-600">Email</label>
                  <input type="email" id="email" name="email" required placeholder="Silahkan isi gmail anda"
                         class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
              </div>
              <div class="w-full">
                  <label for="phone" class="block mb-2 text-sm font-medium opacity-60 text-gray-600">Phone</label>
                  <input type="tel" id="phone" name="phone" required placeholder="Silahkan isi nomor telepon anda"
                         class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
              </div>
          </div>

          <div class="mb-4">
              <label for="password" class="block mb-2 text-sm font-medium opacity-60 text-gray-600">Password</label>
              <input type="password" id="password" name="password" required placeholder="Silahkan buat password anda"
                     class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
          </div>

          <div class="mb-4">
              <label for="address" class="block mb-2 text-sm font-medium opacity-60 text-gray-600">Address</label>
              <textarea id="address" name="address" rows="3" required placeholder="Silahkan masukkan alamat anda"
                        class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
          </div>

          <div class="mb-6">
              <label class="block mb-2 text-sm font-medium opacity-60 text-gray-600">Profile Picture</label>
              <input type="file" id="profilePic" name="profilePic" accept="image/*"
                     class="w-full p-2 border border-gray-300 rounded-md text-gray-500 
                            file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm 
                            file:font-semibold file:bg-[#1C69D4] file:text-white hover:file:bg-[#213120] transition-colors duration-300 cursor-pointer">
          </div>

          <button type="submit" class="w-full bg-[#1C69D4] text-white p-4 rounded-md font-semibold hover:bg-[#213120] transition-colors duration-300 cursor-pointer">Register</button>

          <p class="text-sm text-gray-500 text-center mt-4">Already have a BMW ID? Login 
              <a href="login.php" class="text-blue-600 hover:underline">here</a>
          </p>
      </form>
    </div>
  </div>
</body>
</html>
