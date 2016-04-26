<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Fomula Item'), ['action' => 'edit', $fomulaItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Fomula Item'), ['action' => 'delete', $fomulaItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fomulaItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Fomula Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fomula Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fomulas'), ['controller' => 'Fomulas', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fomula'), ['controller' => 'Fomulas', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Fomula Heads'), ['controller' => 'FomulaHeads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Fomula Head'), ['controller' => 'FomulaHeads', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="fomulaItems view large-9 medium-8 columns content">
    <h3><?= h($fomulaItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Fomula') ?></th>
            <td><?= $fomulaItem->has('fomula') ? $this->Html->link($fomulaItem->fomula->id, ['controller' => 'Fomulas', 'action' => 'view', $fomulaItem->fomula->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Fomula Head') ?></th>
            <td><?= $fomulaItem->has('fomula_head') ? $this->Html->link($fomulaItem->fomula_head->id, ['controller' => 'FomulaHeads', 'action' => 'view', $fomulaItem->fomula_head->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Value') ?></th>
            <td><?= h($fomulaItem->value) ?></td>
        </tr>
        <tr>
            <th><?= __('Unit') ?></th>
            <td><?= $fomulaItem->has('unit') ? $this->Html->link($fomulaItem->unit->name, ['controller' => 'Units', 'action' => 'view', $fomulaItem->unit->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($fomulaItem->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($fomulaItem->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($fomulaItem->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($fomulaItem->modified) ?></td>
        </tr>
    </table>
</div>
