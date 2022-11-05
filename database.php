<?php

class Database {
    private const HOST = "localhost";
    private const USERNAME = "nmaldo";
    private const PASSWORD = "banana";
    private const DATABASE = "WeddingBoardDB";
    private $con;

    function getCon() {
        return $this->con;
    }

    function connect() {
        $this->con = mysqli_connect(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASE);
        return mysqli_connect_errno() ? "Unable to access resources. Please try again later." : "";
    }

    function close() {
        mysqli_close($this->con);
    }
}

?>