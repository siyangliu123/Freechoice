<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrderCigarette[]|\Cake\Collection\CollectionInterface $orderCigarette
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order Cigarette'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cigarette'), ['controller' => 'Cigarette', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cigarette'), ['controller' => 'Cigarette', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderCigarette index large-9 medium-8 columns content">
    <h3><?= __('Order Cigarette') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('order_cigarette_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('order_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cigarette_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('packet_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('packet_quantity') ?></th>
                <th scope="col"><?= $this->Paginator->sort('carton_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('carton_quantity') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderCigarette as $orderCigarette): ?>
            <tr>
                <td><?= $this->Number->format($orderCigarette->order_cigarette_id) ?></td>
                <td><?= $orderCigarette->has('order') ? $this->Html->link($orderCigarette->order->order_id, ['controller' => 'Orders', 'action' => 'view', $orderCigarette->order->order_id]) : '' ?></td>
                <td><?= $this->Number->format($orderCigarette->cigarette_id) ?></td>
                <td><?= $this->Number->format($orderCigarette->packet_price) ?></td>
                <td><?= $this->Number->format($orderCigarette->packet_quantity) ?></td>
                <td><?= $this->Number->format($orderCigarette->carton_price) ?></td>
                <td><?= $this->Number->format($orderCigarette->carton_quantity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $orderCigarette->order_cigarette_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderCigarette->order_cigarette_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderCigarette->order_cigarette_id], ['confirm' => __('Are you sure you want to delete # {0}?', $orderCigarette->order_cigarette_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
