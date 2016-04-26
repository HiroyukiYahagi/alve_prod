<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Evaluations'), ['controller' => 'Evaluations', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evaluation'), ['controller' => 'Evaluations', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Company') ?></th>
            <td><?= $product->has('company') ? $this->Html->link($product->company->name, ['controller' => 'Company', 'action' => 'view', $product->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= $product->has('type') ? $this->Html->link($product->type->id, ['controller' => 'Types', 'action' => 'view', $product->type->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Product Name') ?></th>
            <td><?= h($product->product_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Model Number') ?></th>
            <td><?= h($product->model_number) ?></td>
        </tr>
        <tr>
            <th><?= __('Operator Name') ?></th>
            <td><?= h($product->operator_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($product->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Deleted') ?></th>
            <td><?= $this->Number->format($product->deleted) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($product->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($product->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Product Comment') ?></h4>
        <?= $this->Text->autoParagraph(h($product->product_comment)); ?>
    </div>
    <div class="row">
        <h4><?= __('Product Info Url') ?></h4>
        <?= $this->Text->autoParagraph(h($product->product_info_url)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Evaluations') ?></h4>
        <?php if (!empty($product->evaluations)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Product Id') ?></th>
                <th><?= __('Compared Product Id') ?></th>
                <th><?= __('Created') ?></th>
                <th><?= __('Modified') ?></th>
                <th><?= __('Deleted') ?></th>
                <th><?= __('Update Comment') ?></th>
                <th><?= __('Completed') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->evaluations as $evaluations): ?>
            <tr>
                <td><?= h($evaluations->id) ?></td>
                <td><?= h($evaluations->product_id) ?></td>
                <td><?= h($evaluations->compared_product_id) ?></td>
                <td><?= h($evaluations->created) ?></td>
                <td><?= h($evaluations->modified) ?></td>
                <td><?= h($evaluations->deleted) ?></td>
                <td><?= h($evaluations->update_comment) ?></td>
                <td><?= h($evaluations->completed) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Evaluations', 'action' => 'view', $evaluations->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Evaluations', 'action' => 'edit', $evaluations->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Evaluations', 'action' => 'delete', $evaluations->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evaluations->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
