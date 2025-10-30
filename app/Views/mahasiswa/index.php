<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <a href="/mahasiswa/create">+ Tambah Data</a>
    <table border="1" cellpadding="8">
        <tr><th>ID</th><th>Nama</th><th>NIM</th><th>Jurusan</th><th>Aksi</th></tr>
        <?php foreach ($mahasiswa as $m): ?>
            <tr>
                <td><?= $m['id'] ?></td>
                <td><?= $m['nama'] ?></td>
                <td><?= $m['nim'] ?></td>
                <td><?= $m['jurusan'] ?></td>
                <td>
                    <a href="/mahasiswa/edit/<?= $m['id'] ?>">Edit</a> |
                    <a href="/mahasiswa/delete/<?= $m['id'] ?>">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
