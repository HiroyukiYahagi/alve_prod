<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fomula'), ['action' => 'edit', $fomula->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fomula'), ['action' => 'delete', $fomula->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fomula->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fomulas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fomula'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fomula Items'), ['controller' => 'FomulaItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fomula Item'), ['controller' => 'FomulaItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fomulas view large-9 medium-8 columns content">
    <h3><?= h($fomula->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= $fomula->has('company') ? $this->Html->link($fomula->company->name, ['controller' => 'Company', 'action' => 'view', $fomula->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($fomula->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($fomula->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Completed') ?></th>
            <td><?= $this->Number->format($fomula->completed) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($fomula->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($fomula->modified) ?></td>
        </tr>
        <tr>
            <th><?= __('Fomula Start') ?></th>
            <td><?= h($fomula->fomula_start) ?></td>
        </tr>
        <tr>
            <th><?= __('Fomula End') ?></th>
            <td><?= h($fomula->fomula_end) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Fomula Items') ?></h4>
        <?php if (!empty($fomula->fomula_items)): ?>
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
            <?php foreach ($fomula->fomula_items as $fomulaItems): ?>
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
