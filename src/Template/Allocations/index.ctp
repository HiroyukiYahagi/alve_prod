<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Allocation'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Allocation Items'), ['controller' => 'AllocationItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Allocation Item'), ['controller' => 'AllocationItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evaluation Heads'), ['controller' => 'EvaluationHeads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evaluation Head'), ['controller' => 'EvaluationHeads', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fomula Heads'), ['controller' => 'FomulaHeads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fomula Head'), ['controller' => 'FomulaHeads', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="allocations index large-9 medium-8 columns content">
    <h3><?= __('Allocations') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('allocation_name') ?></th>
                <th><?= $this->Paginator->sort('allocation_type') ?></th>
                <th><?= $this->Paginator->sort('allocation_unit') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('deleted') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allocations as $allocation): ?>
            <tr>
                <td><?= $this->Number->format($allocation->id) ?></td>
                <td><?= h($allocation->allocation_name) ?></td>
                <td><?= $this->Number->format($allocation->allocation_type) ?></td>
                <td><?= h($allocation->allocation_unit) ?></td>
                <td><?= h($allocation->created) ?></td>
                <td><?= h($allocation->modified) ?></td>
                <td><?= $this->Number->format($allocation->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $allocation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $allocation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $allocation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $allocation->id)]) ?>
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
