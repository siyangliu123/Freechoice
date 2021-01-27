<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InvoiceCigarette[]|\Cake\Collection\CollectionInterface $invoiceCigarette
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Invoice Cigarette'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="invoiceCigarette index large-9 medium-8 columns content">
    <h3><?= __('Invoice Cigarette') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('invoice_cigarette_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cigarette_brand') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cigarette_size') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cigarette_flavor') ?></th>
                <th scope="col"><?= $this->Paginator->sort('packet_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('packet_from_shop') ?></th>
                <th scope="col"><?= $this->Paginator->sort('packet_from_warehouse') ?></th>
                <th scope="col"><?= $this->Paginator->sort('carton_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('carton_from_shop') ?></th>
                <th scope="col"><?= $this->Paginator->sort('carton_from_warehouse') ?></th>
                <th scope="col"><?= $this->Paginator->sort('invoice_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoiceCigarette as $invoiceCigarette): ?>
            <tr>
                <td><?= $this->Number->format($invoiceCigarette->invoice_cigarette_id) ?></td>
                <td><?= h($invoiceCigarette->cigarette_brand) ?></td>
                <td><?= h($invoiceCigarette->cigarette_size) ?></td>
                <td><?= h($invoiceCigarette->cigarette_flavor) ?></td>
                <td><?= $this->Number->format($invoiceCigarette->packet_price) ?></td>
                <td><?= $this->Number->format($invoiceCigarette->packet_from_shop) ?></td>
                <td><?= $this->Number->format($invoiceCigarette->packet_from_warehouse) ?></td>
                <td><?= $this->Number->format($invoiceCigarette->carton_price) ?></td>
                <td><?= $this->Number->format($invoiceCigarette->carton_from_shop) ?></td>
                <td><?= $this->Number->format($invoiceCigarette->carton_from_warehouse) ?></td>
                <td><?= $this->Number->format($invoiceCigarette->invoice_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $invoiceCigarette->invoice_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $invoiceCigarette->invoice_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $invoiceCigarette->invoice_id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceCigarette->invoice_id)]) ?>
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
