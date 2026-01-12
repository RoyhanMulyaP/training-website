<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-black min-h-screen flex flex-col">

    <!-- CONTENT -->
    <div class="flex-1 flex items-center justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 px-6">

            <!-- CARD TUGAS 8 -->
            <a href="<?= base_url('film') ?>"
                class="w-64 h-40
                  flex items-center justify-center
                  text-2xl font-bold text-red-600
                  border border-red-600 rounded-xl
                  bg-gradient-to-br from-black to-gray-900
                  hover:scale-105 transition
                  hover:shadow-xl hover:shadow-red-600/40">
                Tugas 8
            </a>

            <!-- CARD CHECKPOINT 2 -->
            <div>
                <a href="<?= site_url('/home') ?>"
                    class="w-64 h-40
                        flex items-center justify-center
                        text-2xl font-bold text-red-600
                        border border-red-600 rounded-xl
                        bg-gradient-to-br from-black to-gray-900
                        hover:scale-105 transition
                        hover:shadow-xl hover:shadow-red-600/40">
                    Checkpoint 2
                </a>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <footer class="text-center text-gray-500 text-sm py-4 border-t border-red-600">
        PHP v<?= PHP_VERSION ?> |
        CodeIgniter <?= \CodeIgniter\CodeIgniter::CI_VERSION ?>
    </footer>

</body>

</html>