<h2>Edit Data Mahasiswa</h2>
<form action="/mahasiswa/update/<?= $mahasiswa['id'] ?>" method="post">
    Nama: <input type="text" name="nama" value="<?= $mahasiswa['nama'] ?>"><br>
    NIM: <input type="text" name="nim" value="<?= $mahasiswa['nim'] ?>"><br>
    Jurusan: <input type="text" name="jurusan" value="<?= $mahasiswa['jurusan'] ?>"><br>
    <button type="submit">Update</button>
</form>
