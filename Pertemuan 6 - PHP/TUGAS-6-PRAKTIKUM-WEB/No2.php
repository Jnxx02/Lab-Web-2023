<!DOCTYPE html>
<html>

<head>
    <title>Formulir Perkenalan</title>
</head>

<body>
    <h2>Formulir Perkenalan</h2>
    <form method="POST">
        <label for="nama">Nama:</label> <br>
        <input type="text" name="nama" id="nama" required><br><br>

        <label for="email">Email:</label> <br>
        <input type="email" name="email" id="email" required><br><br>

        <label for="tgl_lahir">Tanggal Lahir:</label> <br>
        <input type="date" name="tgl_lahir" id="tgl_lahir" required><br><br>

        <label>Jenis Kelamin:</label> <br>
        <input type="radio" name="jenis_kelamin" value= "Laki&quot;" required>Pria
        <input type="radio" name="jenis_kelamin" value="Wanita" required>Wanita<br><br>

        <label>Bahasa yang Dikuasai:</label> <br>
        <input type="checkbox" name="bahasa[]" value="Java">Java
        <input type="checkbox" name="bahasa[]" value="Python">Python
        <input type="checkbox" name="bahasa[]" value="HTML">HTML
        <input type="checkbox" name="bahasa[]" value="JavaScript">JavaScript
        <input type="checkbox" name="bahasa[]" value="PHPx  x">PHP<br><br>

        <input type="submit" value="Kirim">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nama = $_POST["nama"];
        $email = $_POST["email"];
        $tgl_lahir = $_POST["tgl_lahir"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $bahasa = isset($_POST["bahasa"]) ? $_POST["bahasa"] : [];

        $tgl_lahir = $_POST["tgl_lahir"];
        $tahun_sekarang = date("Y");
        $tahun_lahir = date("Y", strtotime($tgl_lahir));
        $usia = $tahun_sekarang - $tahun_lahir;        

        $kalimat_perkenalan = "Halo saya $nama, berusia $usia tahun. 
                            Saya lahir pada tanggal $tgl_lahir. Saya adalah seorang $jenis_kelamin. ";

        if (!empty($bahasa)) {
            $kalimat_perkenalan .= "Saya menguasai bahasa " . implode(", ", $bahasa);
        } else {
            $kalimat_perkenalan .= "Saya belum menguasai bahasa apapun dari pilihan yang tersedia.";
        }

        echo "<h3>Kalimat Perkenalan:</h3>";
        echo "<p>$kalimat_perkenalan</p>";
    }
    ?>
</body>

</html>