<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-vh-100 d-flex align-items-center ">


    <aside id="default-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="<?php echo base_url('keuangan/index')?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="ml-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('keuangan/pembayaran') ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="flex-1 ml-3 whitespace-nowrap"> Data Pembayaran </span>

                    </a>
                </li>
                <!-- <li>
                    <a href="<?php echo base_url('keuangan/') ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="flex-1 ml-3 whitespace-nowrap">Pemabayaran Uang Gedung</span>

                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('keuangan/') ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="flex-1 ml-3 whitespace-nowrap">Pemabayaran Seragam</span>

                    </a>
                </li> -->
                <li>

                    <a href="<?php echo base_url('Login/logout'); ?>"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">

                        <span class="flex-1 ml-3 whitespace-nowrap">Log Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <div class="card w-50 m-auto p-3">

        <!-- Konten -->
        <!-- Konten -->

        <div class="content">
            <?php if (isset($pembayaran)): ?>
                <h3 class="text-center">Ubah</h3>
                <form class="row" action="<?php echo base_url('keuangan/aksi_ubah_bayar'); ?>" enctype="multipart/form-data"
                    method="post">
                    <input name="id" type="hidden" value="<?php echo $pembayaran->id; ?>">
                    <div class="mb-3 col-6">
                        <label for="nama_siswa" class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" required>
                    </div>

                    <div class="mb-3 col-6">
                        <label for="" class="form-label">Jenis Pembayaran</label>
                        <select name="jenis_pembayaran" class="form-select">
                            <option selected>
                                <?php echo isset($pembayaran->jenis_pembayaran) ? $pembayaran->jenis_pembayaran : ''; ?>
                            </option>
                            <!-- <option value="" selected>Pilih Jenis Pembayaran</option> -->
                            <option value="pembayaran SPP">Pembayaran SPP</option>
                            <option value="pembayaran uang gedung">Pembayaran Uang Gedung</option>
                            <option value="pembayaran seragam">Pembayaran Seragam</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="" class="form-label">Total Pembayaran</label>
                        <input type="text" class="form-control" id="total_pembayaran" name="total_pembayaran"
                            value="<?php echo isset($pembayaran->total_pembayaran) ? $pembayaran->total_pembayaran : ''; ?>">
                    </div>
                    <div class="mb-3 col-12">
                        <input type="hidden" name="id_siswa"
                            value="<?php echo isset($pembayaran->id_siswa) ? $pembayaran->id_siswa : ''; ?>">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </form>
            <?php else: ?>
                <!-- Tampilkan pesan atau tindakan yang sesuai jika objek $pembayaran tidak ada -->
            <?php endif; ?>
        </div>
    </div>
    </div>
    </div>
</body>

</html>