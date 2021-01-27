<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockRecord $stockRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Stock Record'), ['action' => 'edit', $stockRecord->stock_record_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Stock Record'), ['action' => 'delete', $stockRecord->stock_record_id], ['confirm' => __('Are you sure you want to delete # {0}?', $stockRecord->stock_record_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Stock Record'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Stock Record'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="stockRecord view large-9 medium-8 columns content">
    <h3><?= h($stockRecord->stock_record_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Stock Record Item') ?></th>
            <td><?= h($stockRecord->stock_record_item) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock Record Date') ?></th>
            <td><?= h($stockRecord->stock_record_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock Record Id') ?></th>
            <td><?= $this->Number->format($stockRecord->stock_record_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock Location') ?></th>
            <td><?= $this->Number->format($stockRecord->stock_location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Stock Record Quantity') ?></th>
            <td><?= $this->Number->format($stockRecord->stock_record_quantity) ?></td>
        </tr>
    </table>
</div>
