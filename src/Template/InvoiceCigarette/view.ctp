<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InvoiceCigarette $invoiceCigarette
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Invoice Cigarette'), ['action' => 'edit', $invoiceCigarette->invoice_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Invoice Cigarette'), ['action' => 'delete', $invoiceCigarette->invoice_id], ['confirm' => __('Are you sure you want to delete # {0}?', $invoiceCigarette->invoice_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Invoice Cigarette'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Invoice Cigarette'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['controller' => 'Clients', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['controller' => 'Clients', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="invoiceCigarette view large-9 medium-8 columns content">
    <h3><?= h($invoiceCigarette->invoice_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Cigarette Brand') ?></th>
            <td><?= h($invoiceCigarette->cigarette_brand) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cigarette Size') ?></th>
            <td><?= h($invoiceCigarette->cigarette_size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cigarette Flavor') ?></th>
            <td><?= h($invoiceCigarette->cigarette_flavor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Cigarette Id') ?></th>
            <td><?= $this->Number->format($invoiceCigarette->invoice_cigarette_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Packet Price') ?></th>
            <td><?= $this->Number->format($invoiceCigarette->packet_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Packet From Shop') ?></th>
            <td><?= $this->Number->format($invoiceCigarette->packet_from_shop) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Packet From Warehouse') ?></th>
            <td><?= $this->Number->format($invoiceCigarette->packet_from_warehouse) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Carton Price') ?></th>
            <td><?= $this->Number->format($invoiceCigarette->carton_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Carton From Shop') ?></th>
            <td><?= $this->Number->format($invoiceCigarette->carton_from_shop) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Carton From Warehouse') ?></th>
            <td><?= $this->Number->format($invoiceCigarette->carton_from_warehouse) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Invoice Id') ?></th>
            <td><?= $this->Number->format($invoiceCigarette->invoice_id) ?></td>
        </tr>
    </table>
</div>
