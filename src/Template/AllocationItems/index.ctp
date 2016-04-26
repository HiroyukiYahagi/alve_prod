<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Allocation Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="allocationItems index large-9 medium-8 columns content">
    <h3><?= __('Allocation Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('point') ?></th>
                <th><?= $this->Paginator->sort('range_max') ?></th>
                <th><?= $this->Paginator->sort('range_min') ?></th>
                <th><?= $this->Paginator->sort('allocation_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('deleted') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allocationItems as $allocationItem): ?>
            <tr>
                <td><?= $this->Number->format($allocationItem->id) ?></td>
                <td><?= $this->Number->format($allocationItem->point) ?></td>
                <td><?= $this->Number->format($allocationItem->range_max) ?></td>
                <td><?= $this->Number->format($allocationItem->range_min) ?></td>
                <td><?= $allocationItem->has('allocation') ? $this->Html->link($allocationItem->allocation->id, ['controller' => 'Allocations', 'action' => 'view', $allocationItem->allocation->id]) : '' ?></td>
                <td><?= h($allocationItem->created) ?></td>
                <td><?= h($allocationItem->modified) ?></td>
                <td><?= $this->Number->format($allocationItem->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $allocationItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $allocationItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $allocationItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $allocationItem->id)]) ?>
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
