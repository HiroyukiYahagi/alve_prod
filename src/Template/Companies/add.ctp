<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Company'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Fomulas'), ['controller' => 'Fomulas', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Fomula'), ['controller' => 'Fomulas', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Products'), ['controller' => 'Products', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Products', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="company form large-9 medium-8 columns content">
    <?= $this->Form->create($company) ?>
    <fieldset>
        <legend><?= __('Add Company') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('password');
            echo $this->Form->input('deleted');
            echo $this->Form->input('is_admin');
            echo $this->Form->input('company_name');
            echo $this->Form->input('url');
            echo $this->Form->input('tel');
            echo $this->Form->input('email');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
