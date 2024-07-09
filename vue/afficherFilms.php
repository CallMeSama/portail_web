<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Films</title>
</head>
<body>
    <h1>Liste des Films</h1>
    <?php if (!empty($films)): ?>
        <div class="films">
            <?php foreach ($films as $film): ?>
                <div class="film">
                    <h2><?= htmlspecialchars($film->titre) ?></h2>
                    <p>Réalisateur: <?= htmlspecialchars($film->realisateur) ?></p>
                    <p>Année: <?= htmlspecialchars($film->annee) ?></p>
                    <!-- Ajoutez d'autres informations sur le film ici -->
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun film trouvé.</p>
    <?php endif; ?>
</body>
</html>