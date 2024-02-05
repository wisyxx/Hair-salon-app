<h1>Admin panel</h1>

<?php

include_once __DIR__ . '/../templates/bar.php';

?>

<h2>Search apointments</h2>
<div class="search">
    <form class="form">
        <div class="field">
            <label for="date">Date</label>
            <input type="date" name="date" id="date">
        </div>
    </form>
</div>

<div class="apointments-admin"></div>