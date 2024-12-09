<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\SleepLog> $sleepLogs
 */
?>
<div class="sleepLogs index content">
    <?= $this->Html->link(__('New Sleep Log'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Sleep Logs') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('bedtime') ?></th>
                    <th><?= $this->Paginator->sort('wake_time') ?></th>
                    <th><?= $this->Paginator->sort('naps') ?></th>
                    <th><?= $this->Paginator->sort('wake_score') ?></th>
                    <th><?= $this->Paginator->sort('sport_done') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sleepLogs as $sleepLog): ?>
                <tr>
                    <td><?= $this->Number->format($sleepLog->id) ?></td>
                    <td><?= $sleepLog->has('user') ? $this->Html->link($sleepLog->user->username, ['controller' => 'Users', 'action' => 'view', $sleepLog->user->id]) : '' ?></td>
                    <td><?= h($sleepLog->date) ?></td>
                    <td><?= h($sleepLog->bedtime) ?></td>
                    <td><?= h($sleepLog->wake_time) ?></td>
                    <td><?= h($sleepLog->naps) ?></td>
                    <td><?= $sleepLog->wake_score === null ? '' : $this->Number->format($sleepLog->wake_score) ?></td>
                    <td><?= h($sleepLog->sport_done) ?></td>
                    <td><?= h($sleepLog->created) ?></td>
                    <td><?= h($sleepLog->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $sleepLog->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $sleepLog->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $sleepLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sleepLog->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
