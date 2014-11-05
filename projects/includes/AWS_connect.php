<?php

define("DB_HOST", "localhost");
define("DB_NAME", "codecoop_UWCnext");
define("DB_USER", "codecoop_UWCnext");
define("DB_PASS", "UWCnext2013");

/** The unix socket for AWS: Amazon Web Services (Ubuntu 14) */
define("DB_UNIX_SOCKET", "/var/run/mysqld/mysqld.sock");
define("DB_PORT", 3306);

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT, DB_UNIX_SOCKET);

if (mysqli_connect_errno($connection)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>
