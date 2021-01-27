<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerOrder $customerOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Customer Order'), ['action' => 'edit', $customerOrder->customer_order_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customer Order'), ['action' => 'delete', $customerOrder->customer_order_id], ['confirm' => __('Are you sure you want to delete # {0}?', $customerOrder->customer_order_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customer Order'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer Order'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customerOrder view large-9 medium-8 columns content">
    <h3><?= h($customerOrder->customer_order_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Customer Name') ?></th>
            <td><?= h($customerOrder->customer_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Contact') ?></th>
            <td><?= h($customerOrder->customer_contact) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Order Detail') ?></th>
            <td><?= h($customerOrder->customer_order_detail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Customer Order Id') ?></th>
            <td><?= $this->Number->format($customerOrder->customer_order_id) ?></td>
        </tr>
    </table>
</div>
