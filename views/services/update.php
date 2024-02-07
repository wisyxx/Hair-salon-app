<h1 class="page-name">Services</h1>
<p class="page-description">Modify the form fields to update the service</p>

<?php
include_once __DIR__ . '/../templates/bar.php';
?>

<form method="POST" class="form">

<?php
    include_once __DIR__ . '/form.php';
?>
<input class="button" type="submit" value="Update">
</form>