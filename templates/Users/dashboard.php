<h1>Bienvenue sur votre tableau de bord</h1>

<div class="user-info">
    <?php if ($this->request->getAttribute('identity')): ?>
        <?php $user = $this->request->getAttribute('identity'); ?>
        <p><?= h($user->first_name) ?> <?= h($user->last_name) ?>.</p>
        <p>
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'creation']) ?>">Ajouter un compte</a>
        </p>
        <p>
    <a href="<?= $this->Url->build(['action' => 'edit', $user->id]) ?>">Modifier les informations de votre compte</a>
</p>

        <p>
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">Déconnexion</a>
        </p>
    <?php else: ?>
        <p>Vous n'êtes pas connecté. 
            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Connexion</a>
        </p>
    <?php endif; ?>
</div>
