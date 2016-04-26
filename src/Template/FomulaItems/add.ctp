<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Fomula Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Fomulas'), ['controller' => 'Fomulas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fomula'), ['controller' => 'Fomulas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fomula Heads'), ['controller' => 'FomulaHeads', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fomula Head'), ['controller' => 'FomulaHeads', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Units'), ['controller' => 'Units', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Unit'), ['controller' => 'Units', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fomulaItems form large-9 medium-8 columns content">
    <?= $this->Form->create($fomulaItem) ?>
    <fieldset>
        <legend><?= __('Add Fomula Item') ?></legend>
        <?php
            echo $this->Form->input('fomula_id', ['options' => $fomulas, 'empty' => true]);
            echo $this->Form->input('head_id', ['options' => $fomulaHeads, 'empty' => true]);
            echo $this->Form->input('deleted');
            echo $this->Form->input('value');
            echo $this->Form->input('unit_id', ['options' => $units, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
