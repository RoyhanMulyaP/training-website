<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Film</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .neon-red {
            box-shadow: 0 0 15px rgba(220, 38, 38, .6),
                0 0 30px rgba(220, 38, 38, .4);
        }

        .glass {
            background: rgba(0, 0, 0, .6);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(220, 38, 38, .4);
        }

        .hover-glow:hover {
            box-shadow: 0 0 20px rgba(220, 38, 38, .9);
            transform: translateY(-2px);
        }

        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        td,
        th {
            vertical-align: middle;
        }

        .cover-option input:checked+svg,
        .cover-option input:checked~span {
            color: #dc2626;
        }

        .cover-option:has(input:checked) {
            border-color: #dc2626;
            box-shadow: 0 0 18px rgba(220, 38, 38, .7);
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-black via-zinc-900 to-black text-white p-10">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-4xl font-bold text-red-600">DATA FILM</h1>
        <button onclick="openCreateModal()"
            class="px-5 py-2 bg-red-600 rounded-xl neon-red hover-glow transition">
            + Tambah Film
        </button>
    </div>

    <!-- TABLE -->
    <div class="glass rounded-2xl neon-red p-6">
        <table class="w-full text-sm">
            <thead class="text-red-500 border-b border-red-600 text-sm">
                <tr>
                    <th class="py-4 px-3 text-left">Judul</th>
                    <th class="py-4 px-3 text-left">Sutradara</th>
                    <!-- <th class="py-4 px-3 text-left">Synopsis</th> -->
                    <th class="py-4 px-3 text-center">Cover</th>
                    <th class="py-4 px-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-red-900/40 text-sm">
                <?php foreach ($films as $f): ?>
                    <tr class="hover:bg-red-900/10 transition">

                        <!-- JUDUL -->
                        <td class="py-6 px-3 font-semibold">
                            <?= esc($f['judul']) ?>
                        </td>

                        <!-- SUTRADARA -->
                        <td class="py-6 px-3 text-gray-300">
                            <?= esc($f['sutradara']) ?>
                        </td>

                        <!-- SYNOPSIS (MAX 4 BARIS) -->
                        <!-- <td class="py-6 px-3 max-w-sm text-gray-400">
                            <p class="line-clamp-4 leading-relaxed">
                                <?= esc($f['synopsis']) ?>
                            </p>
                        </td> -->

                        <!-- COVER -->
                        <td class="py-6 px-3">
                            <div class="w-24 h-36 mx-auto rounded-xl overflow-hidden
                    bg-black border border-red-600/40 p-1">
                                <img src="<?= esc($f['cover']) ?>"
                                    class="w-full h-full object-cover rounded-lg">
                            </div>
                        </td>

                        <!-- AKSI -->
                        <td class="py-6 px-3 text-center space-x-1">
                            <button onclick="viewFilm(<?= $f['id'] ?>)"
                                class="px-3 py-1 rounded bg-blue-600 hover:bg-blue-500 transition">
                                View
                            </button>

                            <button onclick="openEditModal(<?= $f['id'] ?>)"
                                class="px-3 py-1 rounded bg-yellow-500 hover:bg-yellow-400 transition">
                                Edit
                            </button>

                            <button onclick="deleteFilm(<?= $f['id'] ?>)"
                                class="px-3 py-1 rounded bg-red-600 hover:bg-red-500 transition">
                                Delete
                            </button>
                        </td>

                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>
        <!-- ACTION BOTTOM -->
        <div class="flex justify-end mt-6">
            <a href="javascript:history.back()"
                class="px-6 py-2 rounded-xl bg-zinc-800 border border-red-600/50
               text-red-500 hover:bg-red-600 hover:text-white
               transition hover-glow">
                ← Kembali
            </a>
        </div>

    </div>

    <!-- MODAL CREATE / EDIT -->
    <div id="formModal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50">
        <div class="glass neon-red rounded-xl w-96 p-6">
            <h2 id="formTitle" class="text-xl text-red-600 mb-4 text-center"></h2>

            <form id="filmForm" enctype="multipart/form-data">
                <input type="hidden" name="id" id="filmId">

                <input name="judul" id="judul" placeholder="Judul"
                    class="w-full mb-2 p-2 rounded bg-black border border-red-600">

                <input name="sutradara" id="sutradara" placeholder="Sutradara"
                    class="w-full mb-2 p-2 rounded bg-black border border-red-600">

                <textarea name="synopsis" id="synopsis" placeholder="Synopsis"
                    class="w-full mb-2 p-2 rounded bg-black border border-red-600"></textarea>

                <input type="hidden" id="originalCoverType">
                <input type="hidden" id="originalCoverValue">

                <!-- PILIHAN COVER -->
                <div class="mb-2">
                    <label class="block text-sm mb-1">Cover Film</label>

                    <div class="grid grid-cols-2 gap-3 mb-3">

                        <!-- LINK OPTION -->
                        <label class="cover-option glass rounded-xl p-3 cursor-pointer border border-red-600/40
        hover:border-red-600 transition flex flex-col items-center gap-1">
                            <input type="radio" name="cover_type" value="link" checked class="hidden"
                                onchange="toggleCoverInput()">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 010 5.656l-3 3a4 4 0 01-5.656-5.656l1.5-1.5" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.172 13.828a4 4 0 010-5.656l3-3a4 4 0 115.656 5.656l-1.5 1.5" />
                            </svg>

                            <span class="text-sm font-semibold">Link URL</span>
                            <span class="text-xs text-gray-400">Gunakan gambar online</span>
                        </label>

                        <!-- UPLOAD OPTION -->
                        <label class="cover-option glass rounded-xl p-3 cursor-pointer border border-red-600/40
        hover:border-red-600 transition flex flex-col items-center gap-1">
                            <input type="radio" name="cover_type" value="upload" class="hidden"
                                onchange="toggleCoverInput()">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v7m0-7l-3 3m3-3l3 3M12 4v8" />
                            </svg>

                            <span class="text-sm font-semibold">Upload</span>
                            <span class="text-xs text-gray-400">Upload dari komputer</span>
                        </label>

                    </div>

                    <!-- LINK -->
                    <div id="coverLinkWrapper">
                        <input name="cover_link" id="cover_link" placeholder="https://example.com/cover.jpg"
                            class="w-full p-2 rounded bg-black border border-red-600">
                    </div>

                    <!-- UPLOAD -->
                    <div id="coverUploadWrapper" class="hidden">
                        <input type="file" name="cover_file"
                            class="w-full text-sm border border-red-600 rounded p-2 bg-black">
                    </div>
                </div>


                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeForm()"
                        class="px-4 py-1 bg-gray-600 rounded">Batal</button>
                    <button type="submit"
                        class="px-4 py-1 bg-red-600 neon-red">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL VIEW -->
    <div id="viewModal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50">
        <div class="glass neon-red rounded-xl w-[420px] p-6 text-center">
            <h2 id="vJudul" class="text-2xl text-red-600 mb-2"></h2>
            <p id="vSutradara" class="mb-3 text-sm"></p>
            <img id="vCover" class="mx-auto rounded-xl mb-3 max-h-64">
            <p id="vSynopsis" class="text-sm"></p>

            <button onclick="closeView()"
                class="mt-4 px-4 py-1 bg-red-600 rounded">Tutup</button>
        </div>
    </div>

    <script>
        const formModal = document.getElementById('formModal');

        function toggleCoverInput(skipConfirm = false) {
            const selected = document.querySelector('input[name="cover_type"]:checked').value;
            const original = originalCoverType.value;

            if (!skipConfirm && original && selected !== original) {
                Swal.fire({
                    title: 'Ganti Cover?',
                    text: 'Cover lama akan diganti dengan yang baru',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    background: '#000',
                    color: '#fff'
                }).then(res => {
                    if (!res.isConfirmed) {
                        document.querySelector(`input[value="${original}"]`).checked = true;
                        return;
                    }

                    cover_link.value = '';
                    document.querySelector('input[name="cover_file"]').value = '';
                    originalCoverType.value = selected;

                    updateCoverUI(selected);
                });

                return;
            }

            updateCoverUI(selected);
        }

        function updateCoverUI(type) {
            document.getElementById('coverLinkWrapper')
                .classList.toggle('hidden', type !== 'link');

            document.getElementById('coverUploadWrapper')
                .classList.toggle('hidden', type !== 'upload');
        }

        function openCreateModal() {
            formTitle.innerText = 'Tambah Film';
            filmForm.reset();
            filmId.value = '';

            document.querySelector('input[value="link"]').checked = true;
            toggleCoverInput();

            formModal.classList.remove('hidden');
        }

        function openEditModal(id) {
            fetch(`/film/get/${id}`)
                .then(r => r.json())
                .then(d => {
                    formTitle.innerText = 'Edit Film';
                    filmId.value = d.id;
                    judul.value = d.judul;
                    sutradara.value = d.sutradara;
                    synopsis.value = d.synopsis;
                    const isLink = d.cover.startsWith('http');

                    originalCoverType.value = isLink ? 'link' : 'upload';
                    originalCoverValue.value = d.cover;

                    document.querySelector(`input[value="${originalCoverType.value}"]`).checked = true;
                    if (isLink) {
                        cover_link.value = d.cover;
                    }

                    toggleCoverInput(true); // true = tanpa konfirmasi
                    formModal.classList.remove('hidden');
                });
        }

        function closeForm() {
            formModal.classList.add('hidden');
        }

        document.getElementById('filmForm').addEventListener('submit', e => {
            e.preventDefault();
            const id = filmId.value;
            const url = id ? `/film/update/${id}` : `/film/store`;

            fetch(url, {
                method: 'POST',
                body: new FormData(e.target)
            }).then(() => location.reload());
        });

        function viewFilm(id) {
            fetch(`/film/get/${id}`)
                .then(r => r.json())
                .then(d => {
                    vJudul.innerText = d.judul;
                    vSutradara.innerText = 'Sutradara: ' + d.sutradara;
                    vSynopsis.innerText = d.synopsis;
                    vCover.src = d.cover;
                    viewModal.classList.remove('hidden');
                });
        }

        function closeView() {
            viewModal.classList.add('hidden');
        }

        function deleteFilm(id) {
            Swal.fire({
                title: 'Hapus?',
                text: 'Data film akan dihapus',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                background: '#000',
                color: '#fff'
            }).then(res => {
                if (res.isConfirmed) {
                    fetch(`/film/delete/${id}`, {
                            method: 'DELETE'
                        })
                        .then(() => location.reload());
                }
            });
        }
    </script>
    <footer class="mt-16 border-t border-red-600/30 pt-6 text-sm text-gray-400">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row
                justify-between items-center gap-4">

            <!-- LEFT -->
            <div>
                <span class="text-red-600 font-semibold">Film Management System</span><br>
                <span>Modern Movie Database Dashboard</span>
            </div>

            <!-- CENTER -->
            <div class="flex gap-6 text-xs">
                <span class="hover:text-red-500 transition cursor-default">CodeIgniter 4</span>
                <span class="hover:text-red-500 transition cursor-default">Tailwind CSS</span>
                <span class="hover:text-red-500 transition cursor-default">SweetAlert2</span>
            </div>

            <!-- RIGHT -->
            <div class="text-right text-xs">
                © <?= date('Y') ?>
                <span class="text-red-500 font-semibold">Royhan Pratama</span><br>
                All Rights Reserved
            </div>

        </div>
    </footer>

</body>

</html>