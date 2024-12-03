<h1>Connexion</h1>

<?php if ($this->Flash->render()): ?>
    <div class="flash-messages">
        <?= $this->Flash->render() ?>
    </div>
<?php endif; ?>

<div class="login-form">
    <?= $this->Form->create(null, ['url' => ['action' => 'login']]) ?>
        <fieldset>
            <legend>Veuillez entrer vos identifiants pour vous connecter</legend>

            <?= $this->Form->control('email', [
                'label' => 'Email',
                'type' => 'email',
                'required' => true,
                'placeholder' => 'Entrez votre email'
            ]) ?>

            <?= $this->Form->control('password', [
                'label' => 'Mot de passe',
                'type' => 'password',
                'required' => true,
                'placeholder' => 'Entrez votre mot de passe'
            ]) ?>
        </fieldset>

    <?= $this->Form->button('Se connecter') ?>
    <?= $this->Form->end() ?>
</div>

<p>
    <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'forgotPassword']) ?>">Mot de passe oublié ?</a>
</p> 
