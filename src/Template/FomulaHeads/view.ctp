<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fomula Head'), ['action' => 'edit', $fomulaHead->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fomula Head'), ['action' => 'delete', $fomulaHead->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fomulaHead->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fomula Heads'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fomula Head'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fomulaHeads view large-9 medium-8 columns content">
    <h3><?= h($fomulaHead->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Large Type') ?></th>
            <td><?= h($fomulaHead->large_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Medium Type') ?></th>
            <td><?= h($fomulaHead->medium_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Small Type') ?></th>
            <td><?= h($fomulaHead->small_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Allocation') ?></th>
            <td><?= $fomulaHead->has('allocation') ? $this->Html->link($fomulaHead->allocation->id, ['controller' => 'Allocations', 'action' => 'view', $fomulaHead->allocation->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Unit Category') ?></th>
            <td><?= h($fomulaHead->unit_category) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($fomulaHead->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($fomulaHead->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Required') ?></th>
            <td><?= $this->Number->format($fomulaHead->required) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($fomulaHead->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($fomulaHead->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Item Description') ?></h4>
        <?= $this->Text->autoParagraph(h($fomulaHead->item_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Item Criteria') ?></h4>
        <?= $this->Text->autoParagraph(h($fomulaHead->item_criteria)); ?>
    </div>
    <div class="row">
        <h4><?= __('Options') ?></h4>
        <?= $this->Text->autoParagraph(h($fomulaHead->options)); ?>
    </div>
</div>
