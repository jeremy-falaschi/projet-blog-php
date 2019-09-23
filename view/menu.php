<nav class="navbar navbar-fixed-top  navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">le blog de Jean Forteroche</a>
  <?php if (isset($_SESSION['pseudo'])){ ?>
    <span class="navbar-text">Bonjour <?= $_SESSION['pseudo']; ?></span>  
  <?php } ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="nav flex-column">
      <?php if (isset($_SESSION['pseudo'])){ ?>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=admin">Administration</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php?action=affichenewarticle">Ajouter un article</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=deconnexion">Se Déconnecter</a>
        </li>
      <?php }else { ?> 
        <li class="nav-item active">
         <a class="nav-link" href="index.php?action=connexion">Se connecter</a>
        </li>
      <?php } ?>
    </ul>  
  </div>
</nav>