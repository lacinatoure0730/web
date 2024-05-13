<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin page</title>
  <link rel="stylesheet" href="css/index.css">
  
</head>
<body>

  <?php include 'header.php' ?>

  <div class="container">

    <?php include 'aside.php' ?>
    <main>
      <h1> Bienvenue sur la page test CBI - Cote d'Ivoire</h1>
      <div class="cards">
          <div class="card">
              <h2>Sécurité informatique</h2>
              <p>La sécurité informatique est un domaine essentiel dans le monde numérique d'aujourd'hui. Protéger les systèmes, les données et les réseaux contre les cybermenaces est crucial pour garantir la confidentialité et la disponibilité des informations.</p>
          </div>
          <div class="card">
              <h2>Réseaux informatiques</h2>
              <p>Les réseaux informatiques permettent la communication et le partage de ressources entre les appareils connectés. Des architectures simples aux infrastructures complexes, les réseaux jouent un rôle central dans la connectivité moderne.</p>
          </div>
          <div class="card">
              <h2>Télécommunications</h2>
              <p>Les télécommunications facilitent la transmission de l'information à travers des moyens variés tels que les câbles, les ondes radio et les réseaux cellulaires. Cette technologie est fondamentale pour la communication à distance.</p>
          </div>
          <div class="card">
              <h2>Systèmes d'information</h2>
              <p>Les systèmes d'information regroupent les outils, les processus et les technologies utilisés pour collecter, stocker, traiter et distribuer les données dans une organisation. Ils soutiennent les activités opérationnelles et stratégiques.</p>
          </div>
      </div>
      <div>
              <h2>Le producteur de productivité</h2>
              <p>
                  A l’ère du numérique, nous tirons parti des possibilités offertes par les Nouvelles Technologies de l’Information et de la Communication pour permettre à tout organisme, public ou privé, de développer son activité et d’accélérer ses ambitions. <br> <br>

                  De la TPE à la multinationale, nous guidons votre transformation digitale, pas à pas, en nous appuyant sur le meilleur de la technologie disponible sur le marché.
          <br><br>
                  Nous évaluons précisément vos besoins et nous déployons une stratégie sur-mesure, tout en vous accompagnant dans le changement au sein de votre organisation.
               <br>  <br> <strong>Si vous avez besoin de plus d'informations, Remplissez le formulaire ci-dessous entrant un fichier decrivant votre entreprise 
               </strong>  </p>
      </div>

      <?php include 'form.php' ?>
        
    </main>

  </div>

  <?php include 'footer.php' ?>
  
  
  <script src="js/script.js"></script>
  <script src="https://kit.fontawesome.com/fed9cd4040.js" crossorigin="anonymous"></script>
</body>
</html>
