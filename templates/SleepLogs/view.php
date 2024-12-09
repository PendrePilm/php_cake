<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SleepLog $sleepLog
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Sleep Log'), ['action' => 'edit', $sleepLog->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Sleep Log'), ['action' => 'delete', $sleepLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sleepLog->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Sleep Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Sleep Log'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="sleepLogs view content">
            <h3><?= h($sleepLog->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $sleepLog->has('user') ? $this->Html->link($sleepLog->user->username, ['controller' => 'Users', 'action' => 'view', $sleepLog->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Naps') ?></th>
                    <td><?= h($sleepLog->naps) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($sleepLog->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Wake Score') ?></th>
                    <td><?= $sleepLog->wake_score === null ? '' : $this->Number->format($sleepLog->wake_score) ?></td>
                </tr>
                <tr>
                    <th><?= __('Date') ?></th>
                    <td><?= h($sleepLog->date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Bedtime') ?></th>
                    <td><?= h($sleepLog->bedtime) ?></td>
                </tr>
                <tr>
                    <th><?= __('Wake Time') ?></th>
                    <td><?= h($sleepLog->wake_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($sleepLog->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($sleepLog->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sport Done') ?></th>
                    <td><?= $sleepLog->sport_done ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Comment') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($sleepLog->comment)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
