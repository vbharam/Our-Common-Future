<?php
session_start();
session_unset('aid');
session_destroy();
header("location:index.php");
?>