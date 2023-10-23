<?php
$data = [
    [
        "nama_barang" => "HP",
        "harga" => 3000000,
        "stok" => 10,
        "jenis" => "Elektronik"
    ],
    [
        "nama_barang" => "Jeruk",
        "harga" => 5000,
        "stok" => 20,
        "jenis" => "Buah"
    ],
    [
        "nama_barang" => "Kemeja",
        "harga" => 5000,
        "stok" => 9,
        "jenis" => "Pakaian"
    ],
    [
        "nama_barang" => "Apel",
        "harga" => 5000,
        "stok" => 5,
        "jenis" => "Buah"
    ],
    [
        "nama_barang" => "Celana",
        "harga" => 5000,
        "stok" => 10,
        "jenis" => "Pakaian"
    ],
    [
        "nama_barang" => "Laptop",
        "harga" => 50000,
        "stok" => 30,
        "jenis" => "Elektronik"
    ],
    [
        "nama_barang" => "Semangka",
        "harga" => 5000,
        "stok" => 2,
        "jenis" => "Buah"
    ],
    [
        "nama_barang" => "Kaos",
        "harga" => 5000,
        "stok" => 1,
        "jenis" => "Pakaian"
    ],
    [
        "nama_barang" => "VGA",
        "harga" => 2000000,
        "stok" => 0,
        "jenis" => "Elektronik"
    ]
];


$hasil = [];
$jenis_barang = '';
$found = false;

if (isset($_GET["jenis_barang"])) {
    $jenis_barang = $_GET["jenis_barang"];

    foreach ($data as $item) {
        if ($item["jenis"] === $jenis_barang) {
            $hasil[] = $item;
            $found = true;
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Pencarian Barang Berdasarkan Jenis</title>
</head>

<body>
    <h2>Pencarian Barang Berdasarkan Jenis</h2>
    <form method="GET">
        <label for="jenis_barang">Jenis Barang:</label>
        <input type="text" name="jenis_barang" id="jenis_barang" value="<?php echo $jenis_barang; ?>">
        <input type="submit" value="Cari">
    </form>

    <?php
    if ($found) {
        echo "<h3>Hasil Pencarian untuk Jenis Barang: $jenis_barang</h3>";
        echo "<table border='1'>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Stock</th>
                    <th>Harga</th>
                </tr>";
        $nomor = 1;
        foreach ($hasil as  $item) {
            echo "<tr>";
            echo "<td>" . $nomor . "</td>";
            echo "<td>" . $item["nama_barang"] . "</td>";
            echo "<td>" . $item["stok"] . "</td>";
            echo "<td>" . $item["harga"] . "</td>";
            echo "</tr>";
            $nomor++;
        }
        echo "</table>";
    } elseif ($jenis_barang !== '') {
        echo "Jenis barang '$jenis_barang' tidak ditemukan.";
    }
    ?>
</body>

</html>