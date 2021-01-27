<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerOrder[]|\Cake\Collection\CollectionInterface $customerOrder
 */
?>

<div class="content">
    <h3><?= __('Customer Order') ?></h3>
    <table cellpadding="0" cellspacing="0"  class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('customer_order_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_contact') ?></th>
                <th scope="col"><?= $this->Paginator->sort('customer_order_detail') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customerOrder as $customerOrder): ?>
            <tr>
                <td><?= $this->Number->format($customerOrder->customer_order_id) ?></td>
                <td><?= h($customerOrder->customer_name) ?></td>
                <td><?= h($customerOrder->customer_contact) ?></td>
                <td><?= h($customerOrder->customer_order_detail) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $customerOrder->customer_order_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customerOrder->customer_order_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customerOrder->customer_order_id], ['confirm' => __('Are you sure you want to delete # {0}?', $customerOrder->customer_order_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
