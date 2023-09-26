<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<div class="container mt-12>
    <title>Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
 
 <div class="overflow-x-auto">
    <!-- Tambahkan stylesheet atau script yang diperlukan di sini -->
</head>
<body>
    <?php foreach($user as $users) ;?>
    <div class="container mt-12">
      <div class="max-full rounded border overflow-hidden shadow-lg">
        <form action="<?php echo base_url('admin/aksi_ubah_account') ?>" enctype="multipart/from-data" method="post">
        <div class="px-6 py-4">
            <p class="text-xl font-bold text-center">Akun</p>
            <div class="grid grid-cols-2 gap-4 mt-5"> 
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="email" name="email" type="email" placeholder="Email" value="<?php echo $users->email?>">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                id="username" name="username" type="username" placeholder="username" value="<?php echo $users->username?>">
            </div>
            <div class="mb-4">
             <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                 Password Baru
             </label>
             <input
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                 id="password" name="password" type="password" placeholder="Password Baru">
                     </div>
                     <div class="mb-4">
                         <label class="block text-gray-700 text-sm font-bold mb-2" for="konfirmasi_password">
                             Konfirmasi Password
                         </label>
                         <input
                             class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              id="konfirmasi_password" name="konfirmasi_password" type="password" placeholder="Konfirmasi Password">
                        </div>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-2/6">
                            Ubah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
