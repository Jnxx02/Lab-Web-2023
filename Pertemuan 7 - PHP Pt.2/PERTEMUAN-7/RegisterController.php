<?php

include "connection.php";

class RegisterController extends Connection
{
    public function __construct($data)
    {
        parent::__construct();

        $name = $data['name'];
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $confirmPassword = $data['confirmPassword'];

        $query = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";

        $result = mysqli_query($this->connect, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username or email is already in user')</script>";
            return;
        }

        if ($password == $confirmPassword) {
            $query = "INSERT INTO user VALUES('', '$name', '$username', '$email', '$password')";
            $result = mysqli_query($this->connect, $query);

            echo "<script>alert('Register successfully')</script>";
            header("Location: login.php");
            return $result;
        } else {
            echo "<script>alert('Password does not match!')</script>";
            return;
        }
    }
}

?>