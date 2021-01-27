<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Client'), ['action' => 'edit', $client->detail_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Client'), ['action' => 'delete', $client->detail_id], ['confirm' => __('Are you sure you want to delete # {0}?', $client->detail_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Clients'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Client'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="clients view large-9 medium-8 columns content">
    <h3><?= h($client->detail_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Detail Id') ?></th>
            <td><?= $this->Number->format($client->detail_id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Company Name') ?></h4>
        <?= $this->Text->autoParagraph(h($client->company_name)); ?>
    </div>
    <div class="row">
        <h4><?= __('Company ABN') ?></h4>
        <?= $this->Text->autoParagraph(h($client->company_ABN)); ?>
    </div>
    <div class="row">
        <h4><?= __('Company Address') ?></h4>
        <?= $this->Text->autoParagraph(h($client->company_address)); ?>
    </div>
</div>
