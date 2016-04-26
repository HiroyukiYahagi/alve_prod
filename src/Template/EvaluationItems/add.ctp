<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Evaluation Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Evaluations'), ['controller' => 'Evaluations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evaluation'), ['controller' => 'Evaluations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evaluation Heads'), ['controller' => 'EvaluationHeads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evaluation Head'), ['controller' => 'EvaluationHeads', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evaluationItems form large-9 medium-8 columns content">
    <?= $this->Form->create($evaluationItem) ?>
    <fieldset>
        <legend><?= __('Add Evaluation Item') ?></legend>
        <?php
            echo $this->Form->input('evaluation_id', ['options' => $evaluations, 'empty' => true]);
            echo $this->Form->input('head_id', ['options' => $evaluationHeads, 'empty' => true]);
            echo $this->Form->input('deleted');
            echo $this->Form->input('value');
            echo $this->Form->input('unit_id', ['options' => $units, 'empty' => true]);
            echo $this->Form->input('compared_value');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
