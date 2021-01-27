<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InvoiceCigarette $invoiceCigarette
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Invoice Cigarette'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invoiceCigarette form large-9 medium-8 columns content">
    <?= $this->Form->create($invoiceCigarette) ?>
    <fieldset>
        <legend><?= __('Add Invoice Cigarette') ?></legend>
        <?php
            echo $this->Form->control('invoice_cigarette_id');
            echo $this->Form->control('cigarette_brand');
            echo $this->Form->control('cigarette_size');
            echo $this->Form->control('cigarette_flavor');
            echo $this->Form->control('packet_price');
            echo $this->Form->control('packet_from_shop');
            echo $this->Form->control('packet_from_warehouse');
            echo $this->Form->control('carton_price');
            echo $this->Form->control('carton_from_shop');
            echo $this->Form->control('carton_from_warehouse');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
