<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Allocation Item'), ['action' => 'edit', $allocationItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Allocation Item'), ['action' => 'delete', $allocationItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $allocationItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Allocation Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Allocation Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="allocationItems view large-9 medium-8 columns content">
    <h3><?= h($allocationItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Allocation') ?></th>
            <td><?= $allocationItem->has('allocation') ? $this->Html->link($allocationItem->allocation->id, ['controller' => 'Allocations', 'action' => 'view', $allocationItem->allocation->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($allocationItem->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Point') ?></th>
            <td><?= $this->Number->format($allocationItem->point) ?></td>
        </tr>
        <tr>
            <th><?= __('Range Max') ?></th>
            <td><?= $this->Number->format($allocationItem->range_max) ?></td>
        </tr>
        <tr>
            <th><?= __('Range Min') ?></th>
            <td><?= $this->Number->format($allocationItem->range_min) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($allocationItem->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($allocationItem->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($allocationItem->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Text') ?></h4>
        <?= $this->Text->autoParagraph(h($allocationItem->text)); ?>
    </div>
</div>
