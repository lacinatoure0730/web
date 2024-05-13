<div class="bg">
        <div class="form-container">
          <h2>Contactez-nous</h2>
          <form action="data.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nom">Nom:</label>
              <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
              <label for="prenom">Prénom:</label>
              <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
              <label for="telephone">Téléphone:</label>
              <input type="tel" id="telephone" name="telephone" required>
            </div>
            <div class="form-group">
              <label for="fichier">Fichier:</label>
              <input type="file" id="fichier" name="fichier">
            </div>
            <div class="form-group">
              <label for="message">Message:</label>
              <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit">Envoyer</button>
          </form>
        </div>
</div>