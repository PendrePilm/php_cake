
<h1>Modifier vos informations</h1>


<div class="user-edit-form">
    <?= $this->Form->create($user, ['url' => ['action' => 'edit', $user->id]]) ?>
        <fieldset>
            <legend>Modifiez vos informations personnelles</legend>
            
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
                'placeholder' => 'Entrez votre nouveau mot de passe'
            ]) ?>
            
        </fieldset>

        <?= $this->Form->button('Mettre à jour') ?>
    <?= $this->Form->end() ?>
</div>
