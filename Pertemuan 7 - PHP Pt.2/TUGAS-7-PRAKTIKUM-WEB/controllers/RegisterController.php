<?php

include("./config/Connection.php");

class RegisterController extends Connection
{
    public function __construct($data)
    {
        parent::__construct();

        $nama = $data['nama'];
        $nim = $data['nim'];
        $prodi = $data['prodi'];
        $password = $data['password'];
        $confirmPassword = $data['confirmPassword'];

        $query = "SELECT * FROM users WHERE username = '$nim'";

        $result = mysqli_query($this->connect, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('NIM sudah terdaftar!')</script>";
            return;
        }

        if ($password == $confirmPassword) {
            $truePassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users VALUES ('', '$nim', '$nama', '$prodi', 'mahasiswa', '$truePassword')";
            $result = mysqli_query($this->connect, $query);

            header("Location: login.php?message=Berhasil mendaftar!");
            return $result;
        } else {
            echo "<script>alert('Konfirmasi password tidak sesuai!')</script>";
            return;
        }
    }
}
