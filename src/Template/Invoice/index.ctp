<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Invoice[]|\Cake\Collection\CollectionInterface $invoice
 */
?>
<div class="invoice index large-9 medium-8 columns content" style="padding: 10vh 10vw;">
    <?php $this->Flash->render(); ?>
    <h1><?= __('Invoice') ?></h1>
    <table id="invoiceTable" cellpadding="0" cellspacing="0" class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Order Date</th>
                <th scope="col">Order Client</th>
                <th scope="col">Invoice Date</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= $invoice->order->order_date; ?></td>
                <td><?= $invoice->client->company_name ?></td>
                <td><?= h($invoice->invoice_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View/Print'), ['action' => 'view', $invoice->invoice_id],['class' => 'btn btn-success']) ?>
                    <?= $this->Form->postLink(__('Delete/Return'), ['action' => 'delete', $invoice->invoice_id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $invoice->invoice_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $("#invoiceTable").dataTable({
        'order': [[ 2, "desc" ]],
        "pageLength": 25,
    });
</script>
