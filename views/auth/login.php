<h1 class="page-name">Login</h1>
<p class="page-description">Login with your credentials</p>

<form class="form" method="POST" action="/">
    <div class="field">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Your email">
    </div>
    <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Your password">
    </div>

    <input class="button" type="submit" value="Login">
</form>
<div class="actions">
    <a href="/create-account">Don't have an account yet?, Create one</a>
    <a href="/forgot-password">Forgot my password</a>
</div>