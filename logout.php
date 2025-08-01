<?php
include_once 'includes/init.php'; // Use the new init.php

session_destroy();
header('Location: login.php');
exit();
?>