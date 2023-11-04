<?php
include("connection.php");

class LoginBlok extends Connection
{
    public $data;
    public function __construct($data)
    {
        parent::__construct();

        $usernameOrEmail = $data["usernameOrEmail"];
        $password = $data["password"];

        $query = "SELECT * FROM user WHERE username = '$usernameOrEmail' OR email = '$usernameOrEmail'";

        $result = mysqli_query($this->connect, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Register successfully')</script>";
        
        }

        header("Location: register.php?message=Welkom");
    }
}
?>