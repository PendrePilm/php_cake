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

    <?= $this->Html->css('style') ?>
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
    <div class="main">
        <?php if ($this->request->getAttribute('identity')): ?>
            <div id="menu" style="float: left; width: 20%; padding: 10px; background-color: #f4f4f4; height: 100vh;">
                <h3>Menu</h3>
                <ul>
                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'dashboard']) ?>">Dashboard</a></li>
                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Utilisateurs</a></li>
                    <li><?= $this->Html->link('Suivi du Sommeil', ['controller' => 'SleepLogs', 'action' => 'index']) ?></li>
                    <li><?= $this->Html->link('Graphique du Sommeil', ['controller' => 'SleepLogs', 'action' => 'graph']) ?></li>
                </ul>
            </div>
            <div id="content" style="float: right; width: 75%; padding: 10px;">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        <?php else: ?>
            <div id="content" style="width: 100%; padding: 10px;">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        <?php endif; ?>
    </div>
    <footer style="clear: both;">
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</html>
