<div id="content-main" class="w-500">
    <div class="box-body">
        <h1>Du hast bereits ein Konto?</h1>
        <div class="content">
            <a href="<?php echo BASE_URL; ?>account/login/">Mit Benutzerkonto anmelden</a>
        </div>
        <h1>Benutzerkonto anlegen</h1>
        <div class="content">
            <form action="<?php echo BASE_URL; ?>account/register/do" method="post">
                <p><label>Benutzername</label><input type="text" name="username" /></p>
	           <!-- <p><label>Vorname</label><input type="text" name="prename" /></p>
	            <p><label>Nachname</label><input type="text" name="name" /></p>
                <p><label>Adresse</label><input type="text" name="address" /></p>
                <p><label>PLZ</label><input type="text" name="plz" width="6" /></p>
                <p><label>Stadt</label><input type="text" name="town" /></p>
                <p><label>Land</label><input type="text" name="country" /></p>-->
                <p><label>eMail Adresse</label><input type="text" name="email" /></p>
                <!--<p><label>Alter</label><input type="text" name="age" /></p>
                <p><label>Geschlecht</label><select name="gender">
                    <option value="m">M&auml;nnlich</option>
                    <option value="f">Weiblich</option>
                </select></p>
                <p><label>Telefon</label><input type="text" name="telefon" /></p>
                <p><label>Homepage</label><input type="text" name="homepage" /></p>-->
	            <p><label>Passwort</label><input type="password" name="password" /></p>
	            <p align="right"><label></label><input type="submit" /></p>
            </form>
        </div>
    </div>
</div>