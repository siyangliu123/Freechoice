<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SaleRecord $saleRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $saleRecord->record_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $saleRecord->record_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sale Record'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="saleRecord form large-9 medium-8 columns content">
    <?= $this->Form->create($saleRecord) ?>
    <fieldset>
        <legend><?= __('Edit Sale Record') ?></legend>
        <?php
            echo $this->Form->control('record_date');
            echo $this->Form->control('record_sold_quantity');
            echo $this->Form->control('record_item');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
