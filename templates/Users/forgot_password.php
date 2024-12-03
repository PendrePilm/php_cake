<div class="users form">
    <?= $this->Flash->render() ?>
    <h3>Réinitialisation du mot de passe</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Veuillez entrer votre adresse e-mail pour générer un nouveau mot de passe.') ?></legend>
        <?= $this->Form->control('email', ['required' => true, 'label' => 'Adresse e-mail']) ?>
    </fieldset>
    <?= $this->Form->submit(__('Générer un nouveau mot de passe')); ?>
    <?= $this->Form->end() ?>

    <?php if (!empty($temporaryPassword)): ?>
        <div class="password-display">
            <p>Votre nouveau mot de passe est : <strong id="password"><?= h($temporaryPassword) ?></strong></p>
            <button onclick="copyToClipboard()">Copier le mot de passe</button>
        </div>
    <?php endif; ?>
</div>

<script>
    function copyToClipboard() {
        const password = document.getElementById('password').innerText;
        navigator.clipboard.writeText(password).then(() => {
            alert('Mot de passe copié dans le presse-papiers.');
        }, (err) => {
            console.error('Erreur lors de la copie du mot de passe : ', err);
        });
    }
</script>