<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StockRecord $stockRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Stock Record'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="stockRecord form large-9 medium-8 columns content">
    <?= $this->Form->create($stockRecord) ?>
    <fieldset>
        <legend><?= __('Add Stock Record') ?></legend>
        <?php
            echo $this->Form->control('stock_record_item');
            echo $this->Form->control('stock_location');
            echo $this->Form->control('stock_record_quantity');
            echo $this->Form->control('stock_record_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
