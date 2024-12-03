<h1>Liste des utilisateurs</h1>
<p>Ceci est la vue de l'action `index` du contrôleur Users.</p>

<?php if (!empty($users)): ?>
    <ul>
        <?php foreach ($users as $user): ?>
            <li><?= h($user->username) ?> - <?= h($user->email) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun utilisateur trouvé.</p>
<?php endif; ?>
