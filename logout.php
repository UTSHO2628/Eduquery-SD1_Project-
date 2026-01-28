<?php
include_once 'includes/init.php'; // Use the new init.php

session_destroy();   // ata puro session remove kore dei . aita logout er mul kaj.
header('Location: login.php');
exit();
?>
