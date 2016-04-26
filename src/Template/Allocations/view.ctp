<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Allocation'), ['action' => 'edit', $allocation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Allocation'), ['action' => 'delete', $allocation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $allocation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Allocations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Allocation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Allocation Items'), ['controller' => 'AllocationItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Allocation Item'), ['controller' => 'AllocationItems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evaluation Heads'), ['controller' => 'EvaluationHeads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evaluation Head'), ['controller' => 'EvaluationHeads', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fomula Heads'), ['controller' => 'FomulaHeads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fomula Head'), ['controller' => 'FomulaHeads', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="allocations view large-9 medium-8 columns content">
    <h3><?= h($allocation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Allocation Name') ?></th>
            <td><?= h($allocation->allocation_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Allocation Unit') ?></th>
            <td><?= h($allocation->allocation_unit) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($allocation->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Allocation Type') ?></th>
            <td><?= $this->Number->format($allocation->allocation_type) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($allocation->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($allocation->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($allocation->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Allocation Items') ?></h4>
        <?php if (!empty($allocation->allocation_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Point') ?></th>
                <th><?= __('Text') ?></th>
                <th><?= __('Range Max') ?></th>
                <th><?= __('Range Min') ?></th>
                <th><?= __('Allocation Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Deleted') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($allocation->allocation_items as $allocationItems): ?>
            <tr>
                <td><?= h($allocationItems->id) ?></td>
                <td><?= h($allocationItems->point) ?></td>
                <td><?= h($allocationItems->text) ?></td>
                <td><?= h($allocationItems->range_max) ?></td>
                <td><?= h($allocationItems->range_min) ?></td>
                <td><?= h($allocationItems->allocation_id) ?></td>
                <td><?= h($allocationItems->created) ?></td>
                <td><?= h($allocationItems->modified) ?></td>
                <td><?= h($allocationItems->deleted) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'AllocationItems', 'action' => 'view', $allocationItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'AllocationItems', 'action' => 'edit', $allocationItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'AllocationItems', 'action' => 'delete', $allocationItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $allocationItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Evaluation Heads') ?></h4>
        <?php if (!empty($allocation->evaluation_heads)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Large Type') ?></th>
                <th><?= __('Medium Type') ?></th>
                <th><?= __('Small Type') ?></th>
                <th><?= __('Item Description') ?></th>
                <th><?= __('Item Criteria') ?></th>
                <th><?= __('Allocation Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Required') ?></th>
                <th><?= __('Options') ?></th>
                <th><?= __('Unit Category') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($allocation->evaluation_heads as $evaluationHeads): ?>
            <tr>
                <td><?= h($evaluationHeads->id) ?></td>
                <td><?= h($evaluationHeads->large_type) ?></td>
                <td><?= h($evaluationHeads->medium_type) ?></td>
                <td><?= h($evaluationHeads->small_type) ?></td>
                <td><?= h($evaluationHeads->item_description) ?></td>
                <td><?= h($evaluationHeads->item_criteria) ?></td>
                <td><?= h($evaluationHeads->allocation_id) ?></td>
                <td><?= h($evaluationHeads->created) ?></td>
                <td><?= h($evaluationHeads->modified) ?></td>
                <td><?= h($evaluationHeads->deleted) ?></td>
                <td><?= h($evaluationHeads->required) ?></td>
                <td><?= h($evaluationHeads->options) ?></td>
                <td><?= h($evaluationHeads->unit_category) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EvaluationHeads', 'action' => 'view', $evaluationHeads->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EvaluationHeads', 'action' => 'edit', $evaluationHeads->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EvaluationHeads', 'action' => 'delete', $evaluationHeads->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluationHeads->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Fomula Heads') ?></h4>
        <?php if (!empty($allocation->fomula_heads)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Large Type') ?></th>
                <th><?= __('Medium Type') ?></th>
                <th><?= __('Small Type') ?></th>
                <th><?= __('Item Description') ?></th>
                <th><?= __('Item Criteria') ?></th>
                <th><?= __('Allocation Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Required') ?></th>
                <th><?= __('Unit Category') ?></th>
                <th><?= __('Options') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($allocation->fomula_heads as $fomulaHeads): ?>
            <tr>
                <td><?= h($fomulaHeads->id) ?></td>
                <td><?= h($fomulaHeads->large_type) ?></td>
                <td><?= h($fomulaHeads->medium_type) ?></td>
                <td><?= h($fomulaHeads->small_type) ?></td>
                <td><?= h($fomulaHeads->item_description) ?></td>
                <td><?= h($fomulaHeads->item_criteria) ?></td>
                <td><?= h($fomulaHeads->allocation_id) ?></td>
                <td><?= h($fomulaHeads->created) ?></td>
                <td><?= h($fomulaHeads->modified) ?></td>
                <td><?= h($fomulaHeads->deleted) ?></td>
                <td><?= h($fomulaHeads->required) ?></td>
                <td><?= h($fomulaHeads->unit_category) ?></td>
                <td><?= h($fomulaHeads->options) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FomulaHeads', 'action' => 'view', $fomulaHeads->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FomulaHeads', 'action' => 'edit', $fomulaHeads->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FomulaHeads', 'action' => 'delete', $fomulaHeads->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fomulaHeads->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
