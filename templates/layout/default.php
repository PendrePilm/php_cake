<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <?php if ($this->request->getAttribute('identity')): ?>
                <?php $user = $this->request->getAttribute('identity'); ?>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']) ?>">
                   <?= h($user->first_name) ?> <?= h($user->last_name) ?>
                </a>
            <?php else: ?>
                <a href="<?= $this->Url->build('/') ?>"><span>Cake</span>PHP</a>
            <?php endif; ?>
        </div>
        <div class="top-nav-links">
            <?php if ($this->request->getAttribute('identity')): ?>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">Déconnexion</a>
            <?php else: ?>
                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Connexion</a>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
