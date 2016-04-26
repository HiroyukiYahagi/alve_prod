<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $evaluation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $evaluation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Evaluations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evaluation Items'), ['controller' => 'EvaluationItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evaluation Item'), ['controller' => 'EvaluationItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evaluations form large-9 medium-8 columns content">
    <?= $this->Form->create($evaluation) ?>
    <fieldset>
        <legend><?= __('Edit Evaluation') ?></legend>
        <?php
            echo $this->Form->input('product_id');
            echo $this->Form->input('compared_product_id', ['options' => $products, 'empty' => true]);
            echo $this->Form->input('deleted');
            echo $this->Form->input('update_comment');
            echo $this->Form->input('completed');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
