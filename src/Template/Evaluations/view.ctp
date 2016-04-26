<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Evaluation'), ['action' => 'edit', $evaluation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Evaluation'), ['action' => 'delete', $evaluation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Evaluations'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evaluation'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evaluation Items'), ['controller' => 'EvaluationItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evaluation Item'), ['controller' => 'EvaluationItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="evaluations view large-9 medium-8 columns content">
    <h3><?= h($evaluation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Product') ?></th>
            <td><?= $evaluation->has('product') ? $this->Html->link($evaluation->product->id, ['controller' => 'Products', 'action' => 'view', $evaluation->product->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($evaluation->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Product Id') ?></th>
            <td><?= $this->Number->format($evaluation->product_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($evaluation->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Completed') ?></th>
            <td><?= $this->Number->format($evaluation->completed) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($evaluation->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($evaluation->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Update Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($evaluation->update_comment)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Evaluation Items') ?></h4>
        <?php if (!empty($evaluation->evaluation_items)): ?>
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
            <?php foreach ($evaluation->evaluation_items as $evaluationItems): ?>
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
</div>
