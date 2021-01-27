<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderCigarette $orderCigarette
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order Cigarette'), ['action' => 'edit', $orderCigarette->order_cigarette_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order Cigarette'), ['action' => 'delete', $orderCigarette->order_cigarette_id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderCigarette->order_cigarette_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Order Cigarette'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Cigarette'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cigarette'), ['controller' => 'Cigarette', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cigarette'), ['controller' => 'Cigarette', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orderCigarette view large-9 medium-8 columns content">
    <h3><?= h($orderCigarette->order_cigarette_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Order') ?></th>
            <td><?= $orderCigarette->has('order') ? $this->Html->link($orderCigarette->order->order_id, ['controller' => 'Orders', 'action' => 'view', $orderCigarette->order->order_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cigarette') ?></th>
            <td><?= $orderCigarette->has('cigarette') ? $this->Html->link($orderCigarette->cigarette->Cig_id, ['controller' => 'Cigarette', 'action' => 'view', $orderCigarette->cigarette->Cig_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Order Cigarette Id') ?></th>
            <td><?= $this->Number->format($orderCigarette->order_cigarette_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cigarette Id') ?></th>
            <td><?= $this->Number->format($orderCigarette->cigarette_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Packet Price') ?></th>
            <td><?= $this->Number->format($orderCigarette->packet_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Packet Quantity') ?></th>
            <td><?= $this->Number->format($orderCigarette->packet_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Carton Price') ?></th>
            <td><?= $this->Number->format($orderCigarette->carton_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Carton Quantity') ?></th>
            <td><?= $this->Number->format($orderCigarette->carton_quantity) ?></td>
        </tr>
    </table>
</div>
