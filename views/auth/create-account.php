<h1 class="page-name">Create Account</h1>
<p class="description">Fill the form to create your new account</p>

<?php include_once __DIR__ . '/../templates/alerts.php' ?>

<form class="form" action="/create-account" method="POST">
    <div class="field">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Your name" value="<?php echo s($user->name) ?>">
    </div>
    <div class="field">
        <label for="surname">Surname</label>
        <input type="text" name="surname" id="surname" placeholder="Your surname" value="<?php echo s($user->surname) ?>">
    </div>
    <div class="field">
        <label for="phone">Phone number</label>
        <input type="tel" name="phone" id="phone" placeholder="Your phone number" value="<?php echo s($user->phone) ?>">
    </div>
    <div class="field">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Your email" value="<?php echo s($user->email) ?>">
    </div>
    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Your realy strong password">
    </div>

    <input type="submit" value="Create account" class="button">
</form>

<div class="actions">
    <a href="/">Already have an account?, log in</a>
    <a href="/forgot-password">Forgot my password</a>
</div>