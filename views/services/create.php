<h1 class="page-name">New service</h1>
<p class="page-description">Create a new service by filling the form</p>

<?php
include_once __DIR__ . '/../templates/alerts.php';
// include_once __DIR__ . '/../templates/bar.php';
?>

<form action="/services/create" method="POST" class="form">
<?php
    include_once __DIR__ . '/form.php';
?>
<input class="button" type="submit" value="Create service">
</form>