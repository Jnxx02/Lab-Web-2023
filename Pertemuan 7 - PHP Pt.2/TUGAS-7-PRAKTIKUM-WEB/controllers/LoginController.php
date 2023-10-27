<?php

include("./config/Connection.php");

class LoginController extends Connection
{
    public function __construct($data)
    {
        parent::__construct();

        $username = $data['username'];
        $password = $data['password'];
        $query = "SELECT * FROM users WHERE username = '$username'";

        $result = mysqli_query($this->connect, $query);
        if (mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            $hashPasword = $data['password'];

                if (password_verify($password, $hashPasword)) {
                    session_start();
                    $_SESSION['id'] = $data['id'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['nama'] = $data['nama'];
                    $_SESSION['prodi'] = $data['prodi'];
                    $_SESSION['status'] = 'login';

                    if ($data['role'] == 'admin') {
                        header("Location: dashboard/dashboard-admin.php?message=Welcome Back Boss, Glad to see you ^^");
                    } else {
                        header("Location: dashboard/dashboard.php?message=Selamat datang di Welcome");
                    }
                }
                return;
        } else {
            header("Location: ?message=Password salah!");
            return;
        }
    }
}
?>