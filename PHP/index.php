<?php
require_once 'Penayangan.php';
session_start();

// Folder untuk menyimpan file gambar secara lokal (bukan database, bukan URL)
$folderUpload = 'Asset/';
if (!is_dir($folderUpload)) {
    mkdir($folderUpload, 0777, true);
}

// Inisialisasi data awal (hanya sekali, saat session baru dibuat)
if (!isset($_SESSION['daftarPenayangan'])) {
    $_SESSION['daftarPenayangan'] = [
        new Penayangan("Avengers: Endgame", "2023-12-01", "19:00", "Studio 1", 50000, ""),
        new Penayangan("Spider-Man: No Way Home", "2023-12-02", "20:00", "Studio 2", 60000, ""),
    ];
}

// Referensi ke array penayangan di session
$daftarPenayangan = &$_SESSION['daftarPenayangan'];
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

// Fungsi bantu: memproses upload file gambar, mengembalikan path lokal atau "" jika tidak ada file
function prosesUploadGambar($folderUpload) {
    if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] === UPLOAD_ERR_NO_FILE) {
        return null; // tidak ada file baru yang diupload
    }

    if ($_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
        return null; // ada error saat upload, abaikan
    }

    $namaAsli = basename($_FILES['gambar']['name']);
    $namaUnik = uniqid() . '_' . $namaAsli;
    $tujuan = $folderUpload . $namaUnik;

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $tujuan)) {
        return $tujuan; // path file lokal, contoh: uploads/64f1a_poster.jpg
    }

    return null;
}

// CREATE: proses tambah data baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $aksi === 'tambah') {
    $pathGambar = prosesUploadGambar($folderUpload);

    $penayanganBaru = new Penayangan(
        $_POST['judulFilm'],
        $_POST['tanggal'],
        $_POST['jam'],
        $_POST['studio'],
        (int) $_POST['hargaTiket'],
        $pathGambar ? $pathGambar : ""
    );
    $daftarPenayangan[] = $penayanganBaru;

    header('Location: index.php');
    exit;
}

// UPDATE: proses update data pada index tertentu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $aksi === 'update') {
    $index = (int) $_POST['index'];
    if (isset($daftarPenayangan[$index])) {
        $daftarPenayangan[$index]->setJudulFilm($_POST['judulFilm']);
        $daftarPenayangan[$index]->setTanggal($_POST['tanggal']);
        $daftarPenayangan[$index]->setJam($_POST['jam']);
        $daftarPenayangan[$index]->setStudio($_POST['studio']);
        $daftarPenayangan[$index]->setHargaTiket((int) $_POST['hargaTiket']);

        // Gambar hanya diganti jika user mengupload file baru
        $pathGambarBaru = prosesUploadGambar($folderUpload);
        if ($pathGambarBaru) {
            $daftarPenayangan[$index]->setGambar($pathGambarBaru);
        }
    }

    header('Location: index.php');
    exit;
}

// DELETE: hapus data pada index tertentu (sekaligus hapus file gambarnya jika ada)
if ($aksi === 'hapus' && isset($_GET['index'])) {
    $index = (int) $_GET['index'];
    if (isset($daftarPenayangan[$index])) {
        $gambarLama = $daftarPenayangan[$index]->getGambar();
        if ($gambarLama && file_exists($gambarLama)) {
            unlink($gambarLama);
        }
        array_splice($daftarPenayangan, $index, 1);
    }

    header('Location: index.php');
    exit;
}

// Cek apakah sedang dalam mode edit (menampilkan form isi data lama)
$dataEdit = null;
$editIndex = null;
if ($aksi === 'edit' && isset($_GET['index'])) {
    $editIndex = (int) $_GET['index'];
    if (isset($daftarPenayangan[$editIndex])) {
        $dataEdit = $daftarPenayangan[$editIndex];
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pengelolaan Penayangan Bioskop</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Pengelolaan Penayangan Bioskop</h1>

    <!-- FORM TAMBAH / EDIT -->
    <div class="form-box">
        <?php if ($dataEdit): ?>
        <h2>Update Penayangan (Index <?php echo $editIndex; ?>)</h2>
        <form method="post" action="index.php?aksi=update" enctype="multipart/form-data">
            <input type="hidden" name="index" value="<?php echo $editIndex; ?>">
            <?php else: ?>
            <h2>Tambah Penayangan Baru</h2>
            <form method="post" action="index.php?aksi=tambah" enctype="multipart/form-data">
                <?php endif; ?>

                <label>Judul Film</label>
                <input type="text" name="judulFilm"
                    value="<?php echo $dataEdit ? htmlspecialchars($dataEdit->getJudulFilm()) : ''; ?>" required>

                <label>Tanggal</label>
                <input type="date" name="tanggal"
                    value="<?php echo $dataEdit ? htmlspecialchars($dataEdit->getTanggal()) : ''; ?>" required>

                <label>Jam</label>
                <input type="time" name="jam"
                    value="<?php echo $dataEdit ? htmlspecialchars($dataEdit->getJam()) : ''; ?>" required>

                <label>Studio</label>
                <input type="text" name="studio"
                    value="<?php echo $dataEdit ? htmlspecialchars($dataEdit->getStudio()) : ''; ?>" required>

                <label>Harga Tiket</label>
                <input type="number" name="hargaTiket"
                    value="<?php echo $dataEdit ? $dataEdit->getHargaTiket() : ''; ?>" required>

                <label>Gambar Poster (file disimpan lokal di folder uploads/)</label>
                <input type="file" name="gambar" accept="image/*" <?php echo $dataEdit ? '' : 'required'; ?>>
                <?php if ($dataEdit && $dataEdit->getGambar()): ?>
                <p class="ket-gambar">
                    Gambar saat ini: <img src="<?php echo htmlspecialchars($dataEdit->getGambar()); ?>"
                        class="preview-kecil">
                    <br>Kosongkan jika tidak ingin mengganti gambar.
                </p>
                <?php endif; ?>

                <?php if ($dataEdit): ?>
                <button type="submit">Update</button>
                <a href="index.php" class="btn-batal">Batal</a>
                <?php else: ?>
                <button type="submit">Tambah</button>
                <?php endif; ?>
            </form>
    </div>

    <!-- TABEL DAFTAR PENAYANGAN -->
    <h2>Daftar Seluruh Penayangan</h2>
    <table>
        <thead>
            <tr>
                <th>Index</th>
                <th>Gambar</th>
                <th>Judul Film</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Studio</th>
                <th>Harga Tiket</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($daftarPenayangan)): ?>
            <tr>
                <td colspan="8">Belum ada data penayangan.</td>
            </tr>
            <?php else: ?>
            <?php foreach ($daftarPenayangan as $i => $p): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <?php if ($p->getGambar() && file_exists($p->getGambar())): ?>
                    <img src="<?php echo htmlspecialchars($p->getGambar()); ?>" class="preview-kecil">
                    <?php else: ?>
                    (tidak ada gambar)
                    <?php endif; ?>
                </td>
                <td><?php echo htmlspecialchars($p->getJudulFilm()); ?></td>
                <td><?php echo htmlspecialchars($p->getTanggal()); ?></td>
                <td><?php echo htmlspecialchars($p->getJam()); ?></td>
                <td><?php echo htmlspecialchars($p->getStudio()); ?></td>
                <td><?php echo number_format($p->getHargaTiket(), 0, ',', '.'); ?></td>
                <td class="kolom-aksi">
                    <a href="index.php?aksi=edit&index=<?php echo $i; ?>">Edit</a>
                    <a href="index.php?aksi=hapus&index=<?php echo $i; ?>"
                        onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>