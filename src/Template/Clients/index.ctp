<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Client[]|\Cake\Collection\CollectionInterface $clients
 */
?>
<br/>
<div class="clients index large-9 medium-8 columns content" style="padding: 20px 50px">
    <h1><?= __('Clients') ?></h1>
    <?= $this->Html->link(__('+ New Client'), ['action' => 'add'], ['class' => 'btn btn-success']) ?>

    <table id="clientTable" cellpadding="0" cellspacing="0" class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Company Name</th>
                <th scope="col">Company ABN</th>
                <th scope="col">Company Address</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client): ?>
            <tr>
                <td><?= $client->company_name ?></td>
                <td><?= $client->company_ABN ?></td>
                <td><?= $client->company_address ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $client->detail_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $client->detail_id], ['confirm' => __('Are you sure you want to delete # {0}?', $client->detail_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $("#clientTable").dataTable();
</script>
