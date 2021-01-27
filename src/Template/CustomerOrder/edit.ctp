<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerOrder $customerOrder
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $customerOrder->customer_order_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $customerOrder->customer_order_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Customer Order'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="customerOrder form large-9 medium-8 columns content">
    <?= $this->Form->create($customerOrder) ?>
    <fieldset>
        <legend><?= __('Edit Customer Order') ?></legend>
        <?php
            echo $this->Form->control('customer_name');
            echo $this->Form->control('customer_contact');
            echo $this->Form->control('customer_order_detail');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
