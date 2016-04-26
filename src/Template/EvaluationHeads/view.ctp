<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Evaluation Head'), ['action' => 'edit', $evaluationHead->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Evaluation Head'), ['action' => 'delete', $evaluationHead->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluationHead->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Evaluation Heads'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evaluation Head'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="evaluationHeads view large-9 medium-8 columns content">
    <h3><?= h($evaluationHead->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Large Type') ?></th>
            <td><?= h($evaluationHead->large_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Medium Type') ?></th>
            <td><?= h($evaluationHead->medium_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Small Type') ?></th>
            <td><?= h($evaluationHead->small_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Allocation') ?></th>
            <td><?= $evaluationHead->has('allocation') ? $this->Html->link($evaluationHead->allocation->id, ['controller' => 'Allocations', 'action' => 'view', $evaluationHead->allocation->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Unit Category') ?></th>
            <td><?= h($evaluationHead->unit_category) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($evaluationHead->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($evaluationHead->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Required') ?></th>
            <td><?= $this->Number->format($evaluationHead->required) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($evaluationHead->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($evaluationHead->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Item Description') ?></h4>
        <?= $this->Text->autoParagraph(h($evaluationHead->item_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Item Criteria') ?></h4>
        <?= $this->Text->autoParagraph(h($evaluationHead->item_criteria)); ?>
    </div>
    <div class="row">
        <h4><?= __('Options') ?></h4>
        <?= $this->Text->autoParagraph(h($evaluationHead->options)); ?>
    </div>
</div>
