<?php

if (isset($_GET['accepte-cookie'])) {
    setcookie('accepte-cookie', 'true', time() + 365 * 24 * 3600);
    header('Location:./');
}
?>