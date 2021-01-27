<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
echo $this->Html->css('adminOrder');
?>

<div id="content">
    <?= $this->Flash->render() ?>
    <h1 id="unviewedh2">New Orders</h1>
    <table id="orderTable" class="table table-hover table-bordered">
        <tr>
            <th>Order Company</th>
            <th>Order Date</th>
            <th>Order Comment</th>
            <th>Operation</th>
        </tr>
        <?php foreach ($recent_orders as $recent_order) { ?>
            <tr>
                <td>
                    <?php foreach ($users as $user):
                        if ($user->user_id == $recent_order->order_user) {
                            echo $user->user_company;
                        }
                    endforeach; ?>
                </td>
                <td>
                    <?php echo $recent_order->order_date; ?>
                </td>
                <td><?php echo $recent_order->order_comment; ?></td>
                <td>
                    <?= $this->Html->link(__('View'), ['controller' => 'invoice', 'action' => 'add', $recent_order->order_id], ['target' => '_blank']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $recent_order->order_id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php echo $this->Form->create(null, ['url' => ['controller' => 'Orders', 'action' => 'adminList'], 'type' => 'post']); ?>
    <h1> View Order </h1>
    <div>
        <select class="form-control" id="userSelection" name="userSelection" onchange="this.form.submit()">
            <option>Please select user</option>
            <?php foreach ($users as $user): ?>
                <option value="<?= $this->Number->format($user->user_id) ?>">
                    <?= h($user->user_company) ?>
                </option>
            <?php endforeach; ?>
        </select>

    </div>
    <?php if (isset($user_orders)) { ?>
        <br>
        <table id="orderTable2" class="table table-hover table-bordered">
            <tr>
                <th>Order Company</th>
                <th>Order Date</th>
                <th>Order Comment</th>
                <th>Operation</th>
            </tr>
            <?php foreach ($user_orders as $user_order) { ?>
                <tr>
                    <td>
                        <?php foreach ($users as $user):
                            if ($user->user_id == $user_order->order_user) {
                                echo $user->user_company;
                            }
                        endforeach; ?>
                    </td>
                    <td>
                        <?php echo $user_order->order_date; ?>
                    </td>
                    <td><?php echo $user_order->order_comment; ?></td>
                    <td>
                        <?= $this->Html->link(__('View'), ['controller' => 'invoice', 'action' => 'add', $user_order->order_id], ['target' => '_blank']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user_order->order_id], ['confirm' => __('Are you sure you want to delete ?')]) ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php
        echo $this->Form->end();
    }
    ?>
    <br><br>
</div>
<script>
    $("#userSelection").select2();
</script>

