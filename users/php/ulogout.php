<?php
    include 'includes/sessionUtils.php';

    $session = new sessionUtils();
    if ($session->Logout()) {
        echo '<script> window.location="../../index.html"; </script>';
    }