<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Evaluation Head'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evaluationHeads index large-9 medium-8 columns content">
    <h3><?= __('Evaluation Heads') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('large_type') ?></th>
                <th><?= $this->Paginator->sort('medium_type') ?></th>
                <th><?= $this->Paginator->sort('small_type') ?></th>
                <th><?= $this->Paginator->sort('allocation_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('deleted') ?></th>
                <th><?= $this->Paginator->sort('required') ?></th>
                <th><?= $this->Paginator->sort('unit_category') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evaluationHeads as $evaluationHead): ?>
            <tr>
                <td><?= $this->Number->format($evaluationHead->id) ?></td>
                <td><?= h($evaluationHead->large_type) ?></td>
                <td><?= h($evaluationHead->medium_type) ?></td>
                <td><?= h($evaluationHead->small_type) ?></td>
                <td><?= $evaluationHead->has('allocation') ? $this->Html->link($evaluationHead->allocation->id, ['controller' => 'Allocations', 'action' => 'view', $evaluationHead->allocation->id]) : '' ?></td>
                <td><?= h($evaluationHead->created) ?></td>
                <td><?= h($evaluationHead->modified) ?></td>
                <td><?= $this->Number->format($evaluationHead->deleted) ?></td>
                <td><?= $this->Number->format($evaluationHead->required) ?></td>
                <td><?= h($evaluationHead->unit_category) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $evaluationHead->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evaluationHead->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evaluationHead->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluationHead->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
