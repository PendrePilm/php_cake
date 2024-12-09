<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SleepLog $sleepLog
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $sleepLog->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $sleepLog->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Sleep Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sleepLogs form content">
            <?= $this->Form->create($sleepLog) ?>
            <fieldset>
                <legend><?= __('Edit Sleep Log') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('date');
                    echo $this->Form->control('bedtime');
                    echo $this->Form->control('wake_time');
                    echo $this->Form->control('naps');
                    echo $this->Form->control('wake_score');
                    echo $this->Form->control('comment');
                    echo $this->Form->control('sport_done');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
