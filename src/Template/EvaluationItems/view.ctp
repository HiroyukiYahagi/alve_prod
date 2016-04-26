<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Evaluation Item'), ['action' => 'edit', $evaluationItem->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Evaluation Item'), ['action' => 'delete', $evaluationItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluationItem->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Evaluation Items'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evaluation Item'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evaluations'), ['controller' => 'Evaluations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evaluation'), ['controller' => 'Evaluations', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evaluation Heads'), ['controller' => 'EvaluationHeads', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evaluation Head'), ['controller' => 'EvaluationHeads', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="evaluationItems view large-9 medium-8 columns content">
    <h3><?= h($evaluationItem->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Evaluation') ?></th>
            <td><?= $evaluationItem->has('evaluation') ? $this->Html->link($evaluationItem->evaluation->id, ['controller' => 'Evaluations', 'action' => 'view', $evaluationItem->evaluation->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Evaluation Head') ?></th>
            <td><?= $evaluationItem->has('evaluation_head') ? $this->Html->link($evaluationItem->evaluation_head->id, ['controller' => 'EvaluationHeads', 'action' => 'view', $evaluationItem->evaluation_head->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Value') ?></th>
            <td><?= h($evaluationItem->value) ?></td>
        </tr>
        <tr>
            <th><?= __('Unit') ?></th>
            <td><?= $evaluationItem->has('unit') ? $this->Html->link($evaluationItem->unit->name, ['controller' => 'Units', 'action' => 'view', $evaluationItem->unit->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Compared Value') ?></th>
            <td><?= h($evaluationItem->compared_value) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($evaluationItem->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($evaluationItem->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($evaluationItem->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($evaluationItem->modified) ?></td>
        </tr>
    </table>
</div>
