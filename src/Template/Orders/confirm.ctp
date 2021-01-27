<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
echo $this->Html->css('orderCreate');
?>
<div class="orderForm">
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'Orders', 'action' => 'confirm'], 'type' => 'post', 'id' => 'confirmForm']);
    ?>
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
            <?php foreach ($query as $cigarette): ?>
                <tr>
                    <input class="ID" type="hidden" value="<?= h($cigarette->Cig_id) ?>"/>
                    <td><?= h($cigarette->Cig_brand) ?></td>
                    <td><?= h($cigarette->Cig_size) ?></td>
                    <td><?= h($cigarette->Cig_flavor) ?></td>
                    <td>$<span class="pPrice"><?= $this->Number->format($cigarette->Cig_packet_price) ?></span></td>
                    <td><input class="packet quantity" style="text-align:center;" type="number" value="0" min="0" readonly="readonly"/></td>
                    <td>$<span class="cPrice"><?= $this->Number->format($cigarette->Cig_carton_price) ?></span></td>
                    <td><input class="carton quantity" style="text-align:center;" type="number" value="0" min="0" readonly="readonly"/></td>
                    <td>
                        $<span class="subtotal">0.00</span>
                    </td>
                </tr>
            <?php endforeach; ?>
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
            <td colspan="5">
                <textarea id="comment" name="comment" rows="3" readonly="readonly"></textarea>
            </td>
            <?php echo $this->Form->create(null, ['url' => ['controller' => 'Orders', 'action' => 'add'], 'type' => 'post', 'id' => 'modifyForm']);
            ?>
            <td style="vertical-align:middle">
                    <input name="modifyData" id="modifyData" type="hidden" readonly="readonly"/>
                    <button class="btn btn-warning btn-sm" id="modifyBtn" type="submit">Modify Order</button>
            </td>
            <?php echo $this->Form->end(); ?>
            <td style="vertical-align:middle">
                <input name="action" id="action" value="0" type="hidden" readonly="readonly"/>
                <input name="orderData" id="orderData" type="hidden" readonly="readonly"/>
                <button type="button" class="btn btn-success" id="submitBtn">Complete Order</button>
            </td>
        </tr>

        </tfoot>
    </table>
    </form>
</div>
<script>
$(document).ready(function(){
    $('.navContainer').hide();
    var jsonData = JSON.parse(localStorage.getItem("data"));
    $("#modifyData").val(jsonData);
    var rowCounter = 0;
    $('tbody > tr').each(function(){
        var row = $(this);
        if(parseInt(jsonData.packetQuantity[rowCounter])===0&&parseInt(jsonData.cartonQuantity[rowCounter])===0){
            row.remove();
        }
        else{
            row.find('.packet.quantity').val(parseInt(jsonData.packetQuantity[rowCounter]));
            row.find('.carton.quantity').val(parseInt(jsonData.cartonQuantity[rowCounter]));
        }
        rowCounter++;
        updateSubtotal(row)
    })
    $("#comment").html(jsonData.comment);
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
    $(".subtotal").each(function(){
        totalVal += parseFloat($(this).html());
    })
    $(".quantity.packet").each(function(){
        pTotal += parseFloat($(this).val());
    })
    $(".quantity.carton").each(function(){
        cTotal += parseFloat($(this).val());
    })
    $("#pTotal").html(pTotal);
    $("#cTotal").html(cTotal);
    $("#total").html(totalVal.toFixed(2));
}

$("#modifyBtn").click(function(){
    $("#action").val("modify");
})
$("#submitBtn").click(function(){
    $("#action").val("complete");
    var submitData = {"ID": [],"Brand": [], "Size": [], "Flavor": [], "PacketPrice": [], "PacketQuantity": [], "CartonPrice": [], "CartonQuantity": [], "Comment": ""};
    $("tbody > tr").each(function () {
        submitData.ID.push($(this).find(".ID").val());
        submitData.Brand.push($(this).children('td').eq(0).html());
        submitData.Size.push($(this).children('td').eq(1).html());
        submitData.Flavor.push($(this).children('td').eq(2).html());
        submitData.PacketPrice.push($(this).find('.pPrice').html());
        submitData.PacketQuantity.push($(this).find('.packet.quantity').val());
        submitData.CartonPrice.push($(this).find('.cPrice').html());
        submitData.CartonQuantity.push($(this).find('.carton.quantity').val());
    })
    submitData.Comment = $("#comment").val();
    var jsonData = JSON.stringify(submitData);
    $("#orderData").val(jsonData);
    localStorage.removeItem("data");
    $("#confirmForm").submit();
    $("#submitBtn").attr("disabled", "disabled");
})
</script>
