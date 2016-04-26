<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Evaluation Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evaluations'), ['controller' => 'Evaluations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evaluation'), ['controller' => 'Evaluations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evaluation Heads'), ['controller' => 'EvaluationHeads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evaluation Head'), ['controller' => 'EvaluationHeads', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evaluationItems index large-9 medium-8 columns content">
    <h3><?= __('Evaluation Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('evaluation_id') ?></th>
                <th><?= $this->Paginator->sort('head_id') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th><?= $this->Paginator->sort('deleted') ?></th>
                <th><?= $this->Paginator->sort('value') ?></th>
                <th><?= $this->Paginator->sort('unit_id') ?></th>
                <th><?= $this->Paginator->sort('compared_value') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($evaluationItems as $evaluationItem): ?>
            <tr>
                <td><?= $this->Number->format($evaluationItem->id) ?></td>
                <td><?= $evaluationItem->has('evaluation') ? $this->Html->link($evaluationItem->evaluation->id, ['controller' => 'Evaluations', 'action' => 'view', $evaluationItem->evaluation->id]) : '' ?></td>
                <td><?= $evaluationItem->has('evaluation_head') ? $this->Html->link($evaluationItem->evaluation_head->id, ['controller' => 'EvaluationHeads', 'action' => 'view', $evaluationItem->evaluation_head->id]) : '' ?></td>
                <td><?= h($evaluationItem->created) ?></td>
                <td><?= h($evaluationItem->modified) ?></td>
                <td><?= $this->Number->format($evaluationItem->deleted) ?></td>
                <td><?= h($evaluationItem->value) ?></td>
                <td><?= $evaluationItem->has('unit') ? $this->Html->link($evaluationItem->unit->name, ['controller' => 'Units', 'action' => 'view', $evaluationItem->unit->id]) : '' ?></td>
                <td><?= h($evaluationItem->compared_value) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $evaluationItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $evaluationItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $evaluationItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluationItem->id)]) ?>
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
