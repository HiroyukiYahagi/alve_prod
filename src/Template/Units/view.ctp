<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Unit'), ['action' => 'edit', $unit->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Unit'), ['action' => 'delete', $unit->id], ['confirm' => __('Are you sure you want to delete # {0}?', $unit->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evaluation Items'), ['controller' => 'EvaluationItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evaluation Item'), ['controller' => 'EvaluationItems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fomula Items'), ['controller' => 'FomulaItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fomula Item'), ['controller' => 'FomulaItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="units view large-9 medium-8 columns content">
    <h3><?= h($unit->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Category') ?></th>
            <td><?= h($unit->category) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($unit->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($unit->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($unit->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($unit->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($unit->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Evaluation Items') ?></h4>
        <?php if (!empty($unit->evaluation_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Evaluation Id') ?></th>
                <th><?= __('Head Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Value') ?></th>
                <th><?= __('Unit Id') ?></th>
                <th><?= __('Compared Value') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($unit->evaluation_items as $evaluationItems): ?>
            <tr>
                <td><?= h($evaluationItems->id) ?></td>
                <td><?= h($evaluationItems->evaluation_id) ?></td>
                <td><?= h($evaluationItems->head_id) ?></td>
                <td><?= h($evaluationItems->created) ?></td>
                <td><?= h($evaluationItems->modified) ?></td>
                <td><?= h($evaluationItems->deleted) ?></td>
                <td><?= h($evaluationItems->value) ?></td>
                <td><?= h($evaluationItems->unit_id) ?></td>
                <td><?= h($evaluationItems->compared_value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'EvaluationItems', 'action' => 'view', $evaluationItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'EvaluationItems', 'action' => 'edit', $evaluationItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'EvaluationItems', 'action' => 'delete', $evaluationItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluationItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Fomula Items') ?></h4>
        <?php if (!empty($unit->fomula_items)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Fomula Id') ?></th>
                <th><?= __('Head Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Value') ?></th>
                <th><?= __('Unit Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($unit->fomula_items as $fomulaItems): ?>
            <tr>
                <td><?= h($fomulaItems->id) ?></td>
                <td><?= h($fomulaItems->fomula_id) ?></td>
                <td><?= h($fomulaItems->head_id) ?></td>
                <td><?= h($fomulaItems->created) ?></td>
                <td><?= h($fomulaItems->modified) ?></td>
                <td><?= h($fomulaItems->deleted) ?></td>
                <td><?= h($fomulaItems->value) ?></td>
                <td><?= h($fomulaItems->unit_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'FomulaItems', 'action' => 'view', $fomulaItems->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'FomulaItems', 'action' => 'edit', $fomulaItems->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'FomulaItems', 'action' => 'delete', $fomulaItems->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fomulaItems->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
