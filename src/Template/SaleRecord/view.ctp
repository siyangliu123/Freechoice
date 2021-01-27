<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SaleRecord $saleRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sale Record'), ['action' => 'edit', $saleRecord->record_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sale Record'), ['action' => 'delete', $saleRecord->record_id], ['confirm' => __('Are you sure you want to delete # {0}?', $saleRecord->record_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sale Record'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sale Record'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="saleRecord view large-9 medium-8 columns content">
    <h3><?= h($saleRecord->record_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Record Date') ?></th>
            <td><?= h($saleRecord->record_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Record Id') ?></th>
            <td><?= $this->Number->format($saleRecord->record_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Record Sold Quantity') ?></th>
            <td><?= $this->Number->format($saleRecord->record_sold_quantity) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Record Item') ?></th>
            <td><?= $this->Number->format($saleRecord->record_item) ?></td>
        </tr>
    </table>
</div>
