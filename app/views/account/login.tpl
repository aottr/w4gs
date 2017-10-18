<div id="content-main" class="w-500">
    <div class="box-body">
        <h1>Dein erster Besuch?</h1>
        <div class="content">
            <a href="<?php echo BASE_URL; ?>account/register/">Neues Benutzerkonto erstellen</a>
        </div>
        <h1>Anmelden</h1>
        <div class="content">
            <form action="<?php echo BASE_URL; ?>account/login/do" method="post">
                <p><label>Benutzername</label> <input type="text" name="username" /></p>
                <p><label>Password</label> <input type="password" name="password" /></p>
                <p align="right"><label></label><input type="submit" value="Anmelden" /></p>
            </form>
        </div>
    </div>
</div>