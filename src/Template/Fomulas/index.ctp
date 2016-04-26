<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Fomula'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fomula Items'), ['controller' => 'FomulaItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fomula Item'), ['controller' => 'FomulaItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fomulas index large-9 medium-8 columns content">
    <h3><?= __('Fomulas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('company_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('deleted') ?></th>
                <th><?= $this->Paginator->sort('fomula_start') ?></th>
                <th><?= $this->Paginator->sort('fomula_end') ?></th>
                <th><?= $this->Paginator->sort('completed') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fomulas as $fomula): ?>
            <tr>
                <td><?= $this->Number->format($fomula->id) ?></td>
                <td><?= $fomula->has('company') ? $this->Html->link($fomula->company->name, ['controller' => 'Company', 'action' => 'view', $fomula->company->id]) : '' ?></td>
                <td><?= h($fomula->created) ?></td>
                <td><?= h($fomula->modified) ?></td>
                <td><?= $this->Number->format($fomula->deleted) ?></td>
                <td><?= h($fomula->fomula_start) ?></td>
                <td><?= h($fomula->fomula_end) ?></td>
                <td><?= $this->Number->format($fomula->completed) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $fomula->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $fomula->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $fomula->id], ['confirm' => __('Are you sure you want to delete # {0}?', $fomula->id)]) ?>
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
