<?php
session_start();
$_SESSION['alogin']=="";
session_unset();
session_destroy();
$_SESSION['errmsg']="You have Successfully Logout";
?>

<script>
document.location="index.php";
</script>
