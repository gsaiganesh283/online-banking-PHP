<?php
    session_start();
    unset($_SESSION['account_id']);
    session_destroy();

    header("Location: pages_user_index.php");
    exit;
