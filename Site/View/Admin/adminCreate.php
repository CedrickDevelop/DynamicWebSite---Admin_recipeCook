<?php
?>


<article>
    <h2>Création d'un Administrateur</h2>
    <div class="box">
        <?php echo $message; ?>
        <form class="formulaire" method="post" action="" >
            <!--ROLE-->
            <p><label for="admin"> Administrateur </label></p>
            <input type="radio" id="admin" name="role_admin" value="admin" /></p>
            <p><label for="cook"> Cuisinier </label></p>
            <input type="radio" id="cook" name="role_admin" value="cook" checked/></p>
            <!--NOM & EMAIL-->
            <p><input type="text" name="pseudo_admin" placeholder="Pseudo" /></p>
            <p><input type="Email" name="email_admin" placeholder="Email" /></p>
            <!--MDP-->
            <p><input type="Password" name="password_admin" placeholder="Mot de passe" /></p>
            <p><input type="Password" name="conf_password_admin" placeholder="Confirmation du mot de passe" /></p>
            <p><input id="soumission" type="submit" value="Créer cet Admin" /></p>
        </form>
    </div>
</article>