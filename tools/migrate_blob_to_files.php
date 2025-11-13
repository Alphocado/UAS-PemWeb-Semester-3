<?php
// tools/migrate_blob_to_files.php
// Jalankan via CLI: php migrate_blob_to_files.php
// Pastikan path dan DB credentials sesuai file Config/Database

require __DIR__ . '/../vendor/autoload.php';

// simple DB connection using mysqli (adjust jika perlu)
$mysqli = new mysqli('localhost', 'root', '', 'uas_ptik');
if ($mysqli->connect_errno) {
    echo "DB connection failed: " . $mysqli->connect_error . PHP_EOL;
    exit;
}

// create folders if not exists
$resepDir = __DIR__ . '/../public/assets/img/resep';
$sejarahDir = __DIR__ . '/../public/assets/img/sejarah';
if (!is_dir($resepDir)) mkdir($resepDir, 0755, true);
if (!is_dir($sejarahDir)) mkdir($sejarahDir, 0755, true);

function saveBlobToFile($data, $pathBase, $prefix, $id, $mysqli) {
    if (empty($data)) return null;
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->buffer($data) ?: 'image/jpeg';
    $ext = null;
    switch ($mime) {
        case 'image/jpeg': $ext = 'jpg'; break;
        case 'image/png': $ext = 'png'; break;
        case 'image/gif': $ext = 'gif'; break;
        default: $ext = 'jpg';
    }
    $filename = sprintf('%s_%d.%s', $prefix, $id, $ext);
    $filepath = rtrim($pathBase, '/\\') . DIRECTORY_SEPARATOR . $filename;
    file_put_contents($filepath, $data);
    // optional: set permissions
    @chmod($filepath, 0644);
    return $filename;
}

// Migrate resep
$res = $mysqli->query("SELECT id, gambar FROM resep");
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $id = intval($row['id']);
        $blob = $row['gambar'];
        if (empty($blob)) continue;
        $filename = saveBlobToFile($blob, $resepDir, 'resep', $id, $mysqli);
        if ($filename) {
            $stmt = $mysqli->prepare("UPDATE resep SET gambar_file = ? WHERE id = ?");
            $stmt->bind_param('si', $filename, $id);
            $stmt->execute();
            echo "Rekap: resep.id={$id} -> {$filename}\n";
            $stmt->close();
        }
    }
    $res->close();
}

// Migrate sejarah
$res2 = $mysqli->query("SELECT id, gambar FROM sejarah");
if ($res2) {
    while ($row = $res2->fetch_assoc()) {
        $id = intval($row['id']);
        $blob = $row['gambar'];
        if (empty($blob)) continue;
        $filename = saveBlobToFile($blob, $sejarahDir, 'sejarah', $id, $mysqli);
        if ($filename) {
            $stmt = $mysqli->prepare("UPDATE sejarah SET gambar_file = ? WHERE id = ?");
            $stmt->bind_param('si', $filename, $id);
            $stmt->execute();
            echo "Rekap: sejarah.id={$id} -> {$filename}\n";
            $stmt->close();
        }
    }
    $res2->close();
}

$mysqli->close();
echo "Selesai migrasi (periksa kolom gambar_file dan folder public/assets/img/*)\n";
