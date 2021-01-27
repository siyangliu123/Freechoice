
<h1> View Order </h1>
<?php echo $this->Form->create(null, ['url' => ['controller' => 'Orders', 'action' => 'view'], 'type' => 'post']); ?>
<div>
<select id="orderSelection" name="orderSelection">
    <option>Please select your order</option>
    <?php foreach ($orders as $order): ?>
        <option value="<?= $this->Number->format($order->order_id) ?>">
            <?= h($order->order_date) ?>
        </option>
    <?php endforeach; ?>
</select>
</div>
<br>
<button class="btn btn-success" id="submit" type="submit">Submit</button>
<?php echo $this->Form->end(); ?>


<script>

</script>

