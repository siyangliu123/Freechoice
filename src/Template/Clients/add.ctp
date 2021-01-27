<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client $client
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Clients'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="clients form large-9 medium-8 columns content" style="padding: 0 30vw">
    <?= $this->Form->create($client) ?>
    <fieldset>
        <h1><?= __('Add Client') ?></h1>
        <h5>Company Name</h5>
        <?php echo $this->Form->control('company_name',['class' => 'form-control', 'type' => 'text', 'label' => false]);?>
        <h5>Company ABN</h5>
        <?php echo $this->Form->control('company_ABN',['class' => 'form-control', 'type' => 'text', 'label' => false]);?>
        <h5>Company Address</h5>
        <?php echo $this->Form->control('company_address',['class' => 'form-control', 'type' => 'text', 'label' => false]);?>

    </fieldset>
    <br/>
    <?= $this->Form->button(__('Submit'),['class' => 'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
