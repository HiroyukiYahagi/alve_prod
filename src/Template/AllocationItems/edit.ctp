<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $allocationItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $allocationItem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Allocation Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Allocations'), ['controller' => 'Allocations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Allocation'), ['controller' => 'Allocations', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="allocationItems form large-9 medium-8 columns content">
    <?= $this->Form->create($allocationItem) ?>
    <fieldset>
        <legend><?= __('Edit Allocation Item') ?></legend>
        <?php
            echo $this->Form->input('point');
            echo $this->Form->input('text');
            echo $this->Form->input('range_max');
            echo $this->Form->input('range_min');
            echo $this->Form->input('allocation_id', ['options' => $allocations, 'empty' => true]);
            echo $this->Form->input('deleted');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
