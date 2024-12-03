<h1>Créer un compte</h1>

<?php if ($this->Flash->render()): ?>
    <div class="flash-messages">
        <?= $this->Flash->render() ?>
    </div>
<?php endif; ?>

<div class="register-form">
    <?= $this->Form->create($user) ?>
        <fieldset>
            <legend>Veuillez remplir les informations ci-dessous pour créer un compte</legend>

            <?= $this->Form->control('username', [
                'label' => 'Nom d’utilisateur',
                'required' => true,
                'placeholder' => 'Entrez votre nom d’utilisateur'
            ]) ?>

            <?= $this->Form->control('first_name', [
                'label' => 'Prénom',
                'required' => true,
                'placeholder' => 'Entrez votre prénom'
            ]) ?>

            <?= $this->Form->control('last_name', [
                'label' => 'Nom',
                'required' => true,
                'placeholder' => 'Entrez votre nom'
            ]) ?>

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

    <?= $this->Form->button('Créer un compte') ?>
    <?= $this->Form->end() ?>
</div>

<p>
    Vous avez déjà un compte ? <a href="/users/login">Connectez-vous</a>
</p>
