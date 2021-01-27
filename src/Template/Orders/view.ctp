<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
echo $this->Html->css('orderCreate');
?>
<div id="content">
    <br>
    <h1>Order on date: <?php echo $order['order_date']; ?></h1>
    <div class="orderForm">
        <table id="orderTable" class="table table-hover table-bordered">
            <thead>
            <tr>
                <th scope="col">Brand</th>
                <th scope="col">Size</th>
                <th scope="col">Flavor</th>
                <th scope="col">Packet Price</th>
                <th scope="col">Packet Quantity</th>
                <th scope="col">Carton Price</th>
                <th scope="col">Carton Quantity</th>
                <th scope="col">Subtotal</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            <?php
            foreach ($orderCigarettes as $orderCigarette) {
                ?>
                <tr>
                    <td><?= h($orderCigarette->cigarette->Cig_brand) ?></td>
                    <td><?= h($orderCigarette->cigarette->Cig_size) ?></td>
                    <td><?= h($orderCigarette->cigarette->Cig_flavor) ?></td>
                    <td>$<span class="pPrice"><?= $this->Number->format($orderCigarette->packet_price) ?></span></td>
                    <td><input class="packet quantity" type="number"
                               value="<?= $this->Number->format($orderCigarette->packet_quantity) ?>" min="0"
                               readonly="readonly"/></td>
                    <td>$<span class="cPrice"><?= $this->Number->format($orderCigarette->carton_price) ?></span></td>
                    <td><input class="carton quantity" type="number"
                               value="<?= $this->Number->format($orderCigarette->carton_quantity) ?>" min="0"
                               readonly="readonly"/></td>
                    <td>
                        $<span class="subtotal">0.00</span>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            <tfoot>
            <tr>
                <td colspan="3"></td>
                <td>Total Packet:</td>
                <td><span id="pTotal">0</td>
                <td>Total Carton:</td>
                <td><span id="cTotal">0</td>
                <td>$<span id="total">0.00</span></td>
            </tr>
            <tr>
                <td><label for="comment">Comment: </label></td>
                <td colspan="6">
                    <textarea id="comment" rows="3"
                              readonly="readonly"><?php echo $order['order_comment']; ?></textarea>
                </td>
                <td style="vertical-align:middle">
                    <?= $this->Html->link('+ Create New Order', ['action' => 'add'], ['class' => 'btn btn-success btn-lg']) ?>
                </td>
            </tr>

            </tfoot>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('tbody > tr').each(function () {
            var row = $(this);
            updateSubtotal(row);
        })
    })

    function updateSubtotal(tr) {
        var pPrice = parseFloat(tr.find(".pPrice").html());
        var cPrice = parseFloat(tr.find(".cPrice").html());
        var pQuantity = parseInt(tr.find(".quantity.packet").val());
        var cQuantity = parseInt(tr.find(".quantity.carton").val());
        var subtotal = (pPrice * pQuantity + cPrice * cQuantity).toFixed(2);
        tr.find(".subtotal").html(subtotal);
        updateTotal();
    }

    function updateTotal() {
        var pTotal = 0;
        var cTotal = 0;
        var totalVal = 0;
        $(".subtotal").each(function () {
            totalVal += parseFloat($(this).html());
        })
        $(".quantity.packet").each(function () {
            pTotal += parseFloat($(this).val());
        })
        $(".quantity.carton").each(function () {
            cTotal += parseFloat($(this).val());
        })
        $("#pTotal").html(pTotal);
        $("#cTotal").html(cTotal);
        $("#total").html(totalVal.toFixed(2));
    }
</script>
