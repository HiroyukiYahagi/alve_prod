<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Types'), ['controller' => 'Types', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Type'), ['controller' => 'Types', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evaluations'), ['controller' => 'Evaluations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evaluation'), ['controller' => 'Evaluations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->input('company_id', ['options' => $company, 'empty' => true]);
            echo $this->Form->input('type_id', ['options' => $types, 'empty' => true]);
            echo $this->Form->input('product_name');
            echo $this->Form->input('model_number');
            echo $this->Form->input('operator_name');
            echo $this->Form->input('deleted');
            echo $this->Form->input('product_comment');
            echo $this->Form->input('product_info_url');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
