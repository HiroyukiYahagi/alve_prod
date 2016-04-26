<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $evaluationHead->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $evaluationHead->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Evaluation Heads'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="evaluationHeads form large-9 medium-8 columns content">
    <?= $this->Form->create($evaluationHead) ?>
    <fieldset>
        <legend><?= __('Edit Evaluation Head') ?></legend>
        <?php
            echo $this->Form->input('large_type');
            echo $this->Form->input('medium_type');
            echo $this->Form->input('small_type');
            echo $this->Form->input('item_description');
            echo $this->Form->input('item_criteria');
            echo $this->Form->input('allocation_id', ['options' => $allocations, 'empty' => true]);
            echo $this->Form->input('deleted');
            echo $this->Form->input('required');
            echo $this->Form->input('options');
            echo $this->Form->input('unit_category');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
