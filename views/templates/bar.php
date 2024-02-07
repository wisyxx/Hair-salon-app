<div class="bar">
    <p>Hello: <?php echo $_SESSION['name'] ?? '' ?></p>
    <a href="/logout" class="button">Log out</a>
</div>

<?php if (isset($_SESSION['admin'])) : ?>
    <div class="services-bar">
        <a href="/admin-panel" class="button">View apointments</a>
        <a href="/services" class="button">View services</a>
        <a href="/services/create" class="button">Create new service</a>
    </div>
<?php endif; ?>