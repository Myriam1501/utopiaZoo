<?php
if (isset($_GET['accepte-cookie'])) {
    setcookie('accepte-cookie', 'true', time() + 365 * 24 * 3600);
    header('Location:./');
}
?>
<?php
if(!isset($_COOKIE['accepte-cookie'])) {
?>
<html>
<div class="banniereCookie">
    <div class="textCookie">
        <p>fgehderv</p>
    </div>
    <div class="boutonCookie">
        <a href="?accepte-cookie">J'accepte</a>
    </div>
</div>
</html>
<?php
    }
    ?>

