<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Link ke Output -->
    <link rel="stylesheet" href="./output.css">

</head>
<body class="h-screen w-full flex">
<!-- FORM LOGIN START -->
  <!-- KIRI: FORM LOGIN -->
  <div class="flex flex-col justify-center items-center w-full md:w-1/2 bg-white px-10 md:px-20">

    <!-- 🔙 TOMBOL BACK -->
    <a href="index.html" 
       class="absolute top-8 left-8 flex items-center gap-2 text-gray-500 hover:text-[#0A7ABD] transition duration-300 font-medium">
        <!-- Icon Panah -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
            stroke-width="1.8" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
      </svg>Back
    </a>

    <!-- LOGO BMW -->
    <span class="inline-block w-24 h-24 bg-[url('./img/logobmw.png')] bg-cover bg-center mb-6"></span>

    <!-- TEKS JUDUL -->
    <h2 class="text-3xl font-thin mb-2 text-center">BMW ID LOGIN</h2>
    <p class="text-gray-500 mb-8 text-center">Login to continue your journey</p>

    <!-- FORM -->
    <!-- Input Username -->
    <div class="w-full max-w-sm mb-6">
        <label for="email" class="block mb-2 text-sm font-outfit font-medium opacity-60 text-gray-600">Username</label>
        <input type="email" id="email" name="email" placeholder="Justice Suelai" class="w-full p-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- Input Password -->
    <div class="w-full max-w-sm mb-6">
        <label for="email" class="block mb-2 text-sm font-outfit font-medium opacity-60 text-gray-600">Password</label>
        <input type="email" id="email" name="email" placeholder="********" class="w-full p-3 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <!-- TOMBOL LOGIN -->
    <button class="w-full max-w-sm bg-[#1C69D4] text-white p-4 rounded-md font-semibold hover:bg-[#213120] transition-colors duration-300 cursor-pointer">Log In</button>

    <!-- TOMBOL KE HALAMAN REGISTER -->
    <p class="text-sm text-gray-500 text-center mt-4">Don't have a BMW ID? Register 
        <a href="register.html" class="text-blue-600 hover:underline">here.</a>
    </p>
  </div>

  <!-- KANAN: BANNER FULLSCREEN 🖼️ -->
  <div class="hidden md:block md:w-1/2 h-screen">
      <img src="./img/bannerlogin.png" alt="BMW Car" class="w-full h-full object-cover">
  </div>
</body>

</html>