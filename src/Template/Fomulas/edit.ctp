<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $fomula->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $fomula->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Fomulas'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Company'), ['controller' => 'Company', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Company', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Fomula Items'), ['controller' => 'FomulaItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fomula Item'), ['controller' => 'FomulaItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="fomulas form large-9 medium-8 columns content">
    <?= $this->Form->create($fomula) ?>
    <fieldset>
        <legend><?= __('Edit Fomula') ?></legend>
        <?php
            echo $this->Form->input('company_id', ['options' => $company, 'empty' => true]);
            echo $this->Form->input('deleted');
            echo $this->Form->input('fomula_start', ['empty' => true]);
            echo $this->Form->input('fomula_end', ['empty' => true]);
            echo $this->Form->input('completed');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
