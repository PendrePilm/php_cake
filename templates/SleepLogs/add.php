<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Sleep Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sleepLogs form content">
            <h1><?= __('Ajouter vos Données de Sommeil') ?></h1>
            <?= $this->Form->create($sleepLog) ?>
            <fieldset>
                <legend><?= __('Entrez vos informations de sommeil') ?></legend>
                
                <?= $this->Form->control('user_id', ['options' => $users]); ?>


                <?= $this->Form->control('date', [
                    'label' => 'Date du Sommeil',
                    'type' => 'date',
                    'required' => true
                ]) ?>

                <?= $this->Form->control('bedtime', [
                    'label' => 'Heure de Coucher',
                    'type' => 'time',
                    'required' => true
                ]) ?>

                <?= $this->Form->control('wake_time', [
                    'label' => 'Heure de Lever',
                    'type' => 'time',
                    'required' => true
                ]) ?>

                <?= $this->Form->control('naps', [
                    'label' => 'Sieste',
                    'type' => 'select',
                    'options' => [
                        'none' => 'Aucune',
                        'afternoon' => 'Après-midi',
                        'evening' => 'Soir',
                        'both' => 'Les deux'
                    ],
                    'empty' => 'Sélectionnez une option',
                    'required' => true
                ]) ?>

                <?= $this->Form->control('wake_score', [
                    'label' => 'Score au Réveil (0 à 10)',
                    'type' => 'number',
                    'min' => 0,
                    'max' => 10,
                    'required' => true
                ]) ?>

                <?= $this->Form->control('comment', [
                    'label' => 'Commentaire',
                    'type' => 'textarea',
                    'rows' => 3,
                    'placeholder' => 'Partagez vos ressentis ou remarques sur votre sommeil.',
                    'required' => false
                ]) ?>

                <?= $this->Form->control('sport_done', [
                    'label' => 'Avez-vous fait du sport ce jour ?',
                    'type' => 'checkbox',
                    'required' => false
                ]) ?>
            </fieldset>

            <?= $this->Form->button(__('Enregistrer'), ['class' => 'button button-primary']) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
