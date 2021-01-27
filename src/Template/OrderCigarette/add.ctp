<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderCigarette $orderCigarette
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Order Cigarette'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cigarette'), ['controller' => 'Cigarette', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cigarette'), ['controller' => 'Cigarette', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderCigarette form large-9 medium-8 columns content">
    <?= $this->Form->create($orderCigarette) ?>
    <fieldset>
        <legend><?= __('Add Order Cigarette') ?></legend>
        <?php
            echo $this->Form->control('order_id', ['options' => $orders]);
            echo $this->Form->control('cigarette_id');
            echo $this->Form->control('packet_price');
            echo $this->Form->control('packet_quantity');
            echo $this->Form->control('carton_price');
            echo $this->Form->control('carton_quantity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
