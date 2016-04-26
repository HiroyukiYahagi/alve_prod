<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fomula Head'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fomulaHeads index large-9 medium-8 columns content">
    <h3><?= __('Fomula Heads') ?></h3>
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
            <?php foreach ($fomulaHeads as $fomulaHead): ?>
            <tr>
                <td><?= $this->Number->format($fomulaHead->id) ?></td>
                <td><?= h($fomulaHead->large_type) ?></td>
                <td><?= h($fomulaHead->medium_type) ?></td>
                <td><?= h($fomulaHead->small_type) ?></td>
                <td><?= $fomulaHead->has('allocation') ? $this->Html->link($fomulaHead->allocation->id, ['controller' => 'Allocations', 'action' => 'view', $fomulaHead->allocation->id]) : '' ?></td>
                <td><?= h($fomulaHead->created) ?></td>
                <td><?= h($fomulaHead->modified) ?></td>
                <td><?= $this->Number->format($fomulaHead->deleted) ?></td>
                <td><?= $this->Number->format($fomulaHead->required) ?></td>
                <td><?= h($fomulaHead->unit_category) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fomulaHead->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fomulaHead->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fomulaHead->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fomulaHead->id)]) ?>
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
