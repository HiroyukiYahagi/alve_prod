<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Allocations'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Allocation Items'), ['controller' => 'AllocationItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Allocation Item'), ['controller' => 'AllocationItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Evaluation Heads'), ['controller' => 'EvaluationHeads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Evaluation Head'), ['controller' => 'EvaluationHeads', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fomula Heads'), ['controller' => 'FomulaHeads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fomula Head'), ['controller' => 'FomulaHeads', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="allocations form large-9 medium-8 columns content">
    <?= $this->Form->create($allocation) ?>
    <fieldset>
        <legend><?= __('Add Allocation') ?></legend>
        <?php
            echo $this->Form->input('allocation_name');
            echo $this->Form->input('allocation_type');
            echo $this->Form->input('allocation_unit');
            echo $this->Form->input('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
