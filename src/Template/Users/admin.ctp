<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>


<div id="content">
    <h2>New Orders</h2>
    <table id="orderTable" class="table table-hover table-bordered">
        <tr>
            <th>Order Company</th>
            <th>Order Date</th>
            <th>Order Comment</th>
            <th>Operation</th>
        </tr>
        <?php foreach ($unviewed_orders as $unviewed_order){ ?>
            <tr>
                <td>
                    <?php foreach ($users as $user):
                        if($user->user_id == $unviewed_order->order_user) {
                            echo $user->user_company;
                        }
                    endforeach;?>
                </td>
                <td>
                    <?php echo $unviewed_order->order_date; ?>
                </td>
                <td><?php echo $unviewed_order->order_comment; ?></td>
                <td>
                    <?= $this->Html->link(__('View'), ['controller' => 'invoice', 'action' => 'add', $unviewed_order->order_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'orders', 'action' => 'delete', $unviewed_order->order_id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<script>

</script>
