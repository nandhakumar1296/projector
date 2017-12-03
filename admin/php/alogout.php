<?php
    include 'includes/sessionUtils.php';

    $session = new sessionUtils();
    if ($session->Logout()) {
        echo '<script> window.location="../adminLogin.html"; </script>';
    }