<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cigarette $cigarette
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cigarette'), ['action' => 'edit', $cigarette->Cig_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cigarette'), ['action' => 'delete', $cigarette->Cig_id], ['confirm' => __('Are you sure you want to delete # {0}?', $cigarette->Cig_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cigarette'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cigarette'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cigarette view large-9 medium-8 columns content">
    <h3><?= h($cigarette->Cig_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Cig Brand') ?></th>
            <td><?= h($cigarette->Cig_brand) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cig Size') ?></th>
            <td><?= h($cigarette->Cig_size) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cig Flavor') ?></th>
            <td><?= h($cigarette->Cig_flavor) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cig Id') ?></th>
            <td><?= $this->Number->format($cigarette->Cig_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cig Packet Price') ?></th>
            <td><?= $this->Number->format($cigarette->Cig_packet_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cig Carton Price') ?></th>
            <td><?= $this->Number->format($cigarette->Cig_carton_price) ?></td>
        </tr>
    </table>
</div>
