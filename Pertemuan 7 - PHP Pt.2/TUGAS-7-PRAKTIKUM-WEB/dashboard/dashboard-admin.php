<?php
include("../config/Connection.php");
$connection = new Connection();

$nama_admin = "";

session_start();
$nama_admin = $_SESSION['nama'];

if ($_SESSION['status'] != 'login') {
    header("location:../login.php?message=Silahkan login terlebih dahulu!");
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("location:../login.php?message=See you again Boss, have a nice day");
}

$success = "";
$error = "";

$nim = "";
$nama = "";
$prodi = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($connection->connect, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        $error = "Data tidak ditemukan";
    } else {
        $nim = $data['username'];
        $nama = $data['nama'];
        $prodi = $data['prodi'];
    }
}

if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];

    if ($nim && $nama && $prodi) {
        if ($op == 'edit') {
            $query = "UPDATE users SET username='$nim', nama='$nama', prodi='$prodi' WHERE id='$id'";
            $result = mysqli_query($connection->connect, $query);
            if ($result) {
                $success = "Data berhasil diperbarui";
            } else {
                $error = "Data gagal diperbarui";
            }
        }
    } else {
        $error = "Semua data harus diisi!";
    }
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM users WHERE id='$id'";
    $result = mysqli_query($connection->connect, $query);
    if ($result) {
        $success = "Berhasil menghapus data";
    } else {
        $error = "Gagal menghapus data";
    }
}

if (isset($_POST['tambah_mahasiswa'])) {
    $nim_mahasiswa = $_POST['nim_mahasiswa'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $prodi_mahasiswa = $_POST['prodi_mahasiswa'];

    $query = "INSERT INTO users (username, nama, prodi, role, password) VALUES 
        ('$nim_mahasiswa', '$nama_mahasiswa', '$prodi_mahasiswa', 'mahasiswa', '123')";
    $result = mysqli_query($connection->connect, $query);

    if ($result) {
        $success = "Data mahasiswa baru berhasil ditambahkan";
    } else {
        $error = "Gagal menambahkan data mahasiswa baru";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 700px;
        }

        .card {
            margin-top: 20px;
        }
    </style>
</head>

<body class="bg-warning-subtle">
    <nav class="navbar sticky-top" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand ps-3">Dashboard Admin</a>
            <form action="" method="POST" class="d-flex pe-3">
                <button class="btn btn-outline-danger" type="submit" name="logout">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4 mx-auto">

        <h2 class="text-center mb-5">
            <?= "Welcome Boss $nama_admin" ?>
        </h2>

        <?php
        if (isset($_GET['message'])) {
            echo "<div class='alert alert-info' role='alert'>$_GET[message]</div>";
        }
        ?>

        <div class="card">
            <div class="card-header text-black bg-primary-subtle">
                Update Data Mahasiswa
            </div>
            <div class="card-body">
                <?php if ($error) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                    <?php
                    header("refresh:3;url=dashboard-admin.php");
                }
                if ($success) {
                    ?>
                    <div class="alert alert-success" role="alert">
                        <?= $success ?>
                    </div>
                    <?php
                    header("refresh:3;url=dashboard-admin.php");
                }
                if ($op != "" && $op == 'edit') {
                    ?>
                    <form action="" method="post">
                        <div class="mb-3 row">
                            <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nim" name="nim" value="<?= $nim ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="prodi" class="col-sm-2 col-form-label">Prodi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $prodi ?>"
                                    required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="submit" name="simpan" class="btn btn-outline-primary">Update</button>
                            <a href="dashboard-admin.php" class="btn btn-outline-warning">Clear</a>
                        </div>
                    </form>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-black bg-primary-subtle">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIM</th>
                            <th scope="col">Prodi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM users WHERE role = 'mahasiswa'";
                        $result = mysqli_query($connection->connect, $query);
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td scope="row">
                                    <?= $no++ ?>
                                </td>
                                <td scope="row">
                                    <?= $data['nama'] ?>
                                </td>
                                <td scope="row">
                                    <?= $data['username'] ?>
                                </td>
                                <td scope="row">
                                    <?= $data['prodi'] ?>
                                </td>
                                <td scope="row">
                                    <a href="?op=edit&id=<?= $data['id'] ?>">
                                        <button type="button" class="btn btn-sm btn-outline-success">Edit</button>
                                    </a>
                                    <a href="?op=delete&id=<?= $data['id'] ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <button type="button" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <button type="button" class="btn btn-md btn-outline-primary mt-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
            Tambah +
        </button>
    </div>

    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Data Mahasiswa Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nim_mahasiswa" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim_mahasiswa" name="nim_mahasiswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                            <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" required>
                        </div>
                        <div class="mb-3">
                            <label for="prodi_mahasiswa" class="form-label">Program Studi</label>
                            <input type="text" class="form-control" id="prodi_mahasiswa" name="prodi_mahasiswa"
                                required>
                        </div>
                        <button type="submit" name="tambah_mahasiswa" class="btn btn-outline-primary">Tambahkan</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>