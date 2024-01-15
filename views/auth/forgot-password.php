<h1 class="page-name">Forgot password</h1>
<p class="description">Change your password with your email</p>

<?php
include __DIR__ . '/../templates/alerts.php';
?>

<form method="POST" action="/forgot-password" class="form">
    <div class="field">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Your email">
    </div>

    <input type="submit" value="Send instructions" class="button">
</form>

<div class="actions">
    <a href="/">Already have an account?, log in</a>
    <a href="/create-account">Don't have an account yet?, Create one</a>
</div>