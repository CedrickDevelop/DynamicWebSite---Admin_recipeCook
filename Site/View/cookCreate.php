<?php
?>


<article>
    <h2>Création d'un cuisinier</h2>
    <div class="box">
        <?php echo $message; unset($_POST); ?>
        <form class="formulaire" method="post" action="" enctype="multipart/form-data" >
            <p><input type="text" name="nom_cuisinier" placeholder="Nom" /></p>
            <p><input type="text" name="prenom_cuisinier" placeholder="Prenom" /></p>
           <!-- <p><label  for="photo_cook">Une photo ? 1 mo max par photo // jpg, jpeg, png</label></p>
            <input  type="file" name="photo_cook" id="photo_cook" accept="image/jpg image/png" />-->
            <p><input id="soumission" type="submit" value="Envoyer" /></p>
        </form>
    </div>
</article>