<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fomula Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fomulas'), ['controller' => 'Fomulas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fomula'), ['controller' => 'Fomulas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fomula Heads'), ['controller' => 'FomulaHeads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fomula Head'), ['controller' => 'FomulaHeads', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fomulaItems index large-9 medium-8 columns content">
    <h3><?= __('Fomula Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('fomula_id') ?></th>
                <th><?= $this->Paginator->sort('head_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('deleted') ?></th>
                <th><?= $this->Paginator->sort('value') ?></th>
                <th><?= $this->Paginator->sort('unit_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fomulaItems as $fomulaItem): ?>
            <tr>
                <td><?= $this->Number->format($fomulaItem->id) ?></td>
                <td><?= $fomulaItem->has('fomula') ? $this->Html->link($fomulaItem->fomula->id, ['controller' => 'Fomulas', 'action' => 'view', $fomulaItem->fomula->id]) : '' ?></td>
                <td><?= $fomulaItem->has('fomula_head') ? $this->Html->link($fomulaItem->fomula_head->id, ['controller' => 'FomulaHeads', 'action' => 'view', $fomulaItem->fomula_head->id]) : '' ?></td>
                <td><?= h($fomulaItem->created) ?></td>
                <td><?= h($fomulaItem->modified) ?></td>
                <td><?= $this->Number->format($fomulaItem->deleted) ?></td>
                <td><?= h($fomulaItem->value) ?></td>
                <td><?= $fomulaItem->has('unit') ? $this->Html->link($fomulaItem->unit->name, ['controller' => 'Units', 'action' => 'view', $fomulaItem->unit->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fomulaItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fomulaItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fomulaItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fomulaItem->id)]) ?>
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
