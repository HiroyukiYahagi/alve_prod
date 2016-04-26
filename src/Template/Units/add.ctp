<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Units'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Evaluation Items'), ['controller' => 'EvaluationItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evaluation Item'), ['controller' => 'EvaluationItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fomula Items'), ['controller' => 'FomulaItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fomula Item'), ['controller' => 'FomulaItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="units form large-9 medium-8 columns content">
    <?= $this->Form->create($unit) ?>
    <fieldset>
        <legend><?= __('Add Unit') ?></legend>
        <?php
            echo $this->Form->input('category');
            echo $this->Form->input('name');
            echo $this->Form->input('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
