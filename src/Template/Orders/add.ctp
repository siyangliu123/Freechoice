<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
echo $this->Html->css('orderCreate');
?>


<div class="orderForm">
    <?= $this->Flash->render() ?>
    <div class="toast" id="toast" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
        <div class="toast-header">
            <strong class="mr-auto"><?= h($announcement->announcement_title) ?></strong>
            <small class="text-muted"><?= date_format($announcement->announcement_date, "Y/m/d h:i:s") ?></small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body link-icons">
            <?= h($announcement->announcement_content) ?>
            <div class="download-link">
            <?php
            if ($announcement->announcement_file) {
                ?>
                Download: <a class="link-icon" target="_blank" href="<?php echo "/".$announcement->announcement_file_dir . $announcement->announcement_file; ?>"><?= h($announcement->announcement_file) ?></a>
                <?php
            }
            ?>
            </div>
        </div>
    </div>
    <?php echo $this->Form->create(null, ['url' => ['controller' => 'Orders', 'action' => 'Confirm'], 'type' => 'post', 'id' => 'orderForm']); ?>
    <table id="orderTable" class="table table-hover table-bordered">
        <thead>
        <tr>
            <th scope="col" style="width: 20%">Brand</th>
            <th scope="col" style="width: 10%">Size</th>
            <th scope="col" style="width: 10%">Flavor</th>
            <th scope="col" style="width: 10%">Packet Price</th>
            <th scope="col" style="width: 15%">Packet Quantity</th>
            <th scope="col" style="width: 10%">Carton Price</th>
            <th scope="col" style="width: 15%">Carton Quantity</th>
            <th scope="col" style="width: 10%">Subtotal</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        <?php foreach ($query as $cigarette): ?>
            <tr>
                <td><?= h($cigarette->Cig_brand) ?></td>
                <td><?= h($cigarette->Cig_size) ?></td>
                <td class="flavor"><?= h($cigarette->Cig_flavor) ?></td>
                <td>$<span class="pPrice"><?= $this->Number->format($cigarette->Cig_packet_price) ?></span></td>
                <td>
                    <button class="btnMinus" type="button">-</button>
                    <input class="packet quantity" style="text-align:center;" type="text" value="0" readonly="readonly"/>
                    <button class="btnPlus" type="button">+</button>
                </td>
                <td>$<span class="cPrice"><?= $this->Number->format($cigarette->Cig_carton_price) ?></span></td>
                <td>
                    <button class="btnMinus" type="button">-</button>
                    <input class="carton quantity" style="text-align:center;" type="text" value="0" readonly="readonly"/>
                    <button class="btnPlus" type="button">+</button>
                </td>
                <td>
                    $<span class="subtotal">0.00</span>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
        <tfoot>
        <tr>
            <td class="sticky" colspan="3"></td>
            <td class="sticky">Total Packet:</td>
            <td class="sticky"><span id="pTotal">0</td>
            <td class="sticky">Total Carton:</td>
            <td class="sticky"><span id="cTotal">0</td>
            <td class="sticky">$<span id="total">0.00</span></td>
        </tr>
        <tr>
            <td><label for="comment">Comment: </label></td>
            <td colspan="5">
                <textarea id="comment" rows="3"></textarea>
            </td>
            <td style="vertical-align:middle">
                <button class="btn btn-danger btn-sm" onclick="confirmClear()" type="button">Clear X</button>
            </td>
            <td style="vertical-align:middle">
                <input name="submitData" id="submitData" type="hidden" readonly="readonly"/>
                <button class="btn btn-success" id="submit" type="submit">Checkout</button>
            </td>
        </tr>

        </tfoot>
    </table>
    <?php echo $this->Form->end(); ?>
</div>
<script>
    $(document).ready(function () {
        restoreDataLocally();

        var jsonData = JSON.parse(localStorage.getItem("data"));
        var rowCounter = 0;
        var row;
        $('tbody > tr').each(function () {
            row = $(this);
            row.find('.packet.quantity').val(parseInt(jsonData.packetQuantity[rowCounter]));
            row.find('.carton.quantity').val(parseInt(jsonData.cartonQuantity[rowCounter]));
            rowCounter++;
            updateSubtotal(row);
            if (row.find('.carton.quantity').val() > 0 || row.find('.packet.quantity').val() > 0) {
                row.addClass("highlighted");
            }
            else {
                row.removeClass("highlighted");
            }
        })
        $("#comment").val(jsonData.comment);
        storeDataLocally();
    })

    function highlightRow(row) {
        row.addClass("highlighted");
    }

    $(".btnMinus").click(function () {
        var row = $(this).closest("tr");
        var quantity = $(this).closest("td").find(".quantity");
        var value = parseInt(quantity.val());
        $(this).closest("td").find(".quantity").val(value - 1);
        if (quantity.val() < 0) {
            alert("Quantity must be greater than 0!");
            quantity.val(0);
        }
        updateSubtotal(row);
        if (row.find('.carton.quantity').val() > 0 || row.find('.packet.quantity').val() > 0) {
            row.addClass("highlighted");
        }
        else {
            row.removeClass("highlighted");
        }
        storeDataLocally();
    })
    $(".btnPlus").click(function () {
        var row = $(this).closest("tr");
        var quantity = $(this).closest("td").find(".quantity");
        var value = parseInt(quantity.val());
        $(this).closest("td").find(".quantity").val(value + 1);
        updateSubtotal(row);
        if (row.find('.carton.quantity').val() > 0 || row.find('.packet.quantity').val() > 0) {
            row.addClass("highlighted");
        }
        else {
            row.removeClass("highlighted");
        }
        storeDataLocally();
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

    $('#comment').change(function(){
        storeDataLocally();
    })

    function clearAll() {
        $(".quantity").each(function () {
            var tr = $(this).parent().parent();
            $(this).val(0);
            updateSubtotal(tr)
            tr.removeClass("highlighted");
        })
        $("#comment").val("");

    }

    function confirmClear() {
        var result = confirm("Do you wish to clear all quantity?");
        if (result == true) {
            clearAll();
            alert("Cleared, refresh the page to try undo.");
        } else {
            return false;
        }
    }

    $("#submit").click(function () {
        var jsonData = localStorage.getItem("data");
        $("#submitData").val(jsonData);
        $("#orderForm").submit();
    })

    function storeDataLocally() {
        localStorage.removeItem("data");
        var submitData = {"packetQuantity": [], "cartonQuantity": [], "comment": ""};
        $(".packet.quantity").each(function () {
            submitData.packetQuantity.push($(this).val());
        })
        $(".carton.quantity").each(function () {
            submitData.cartonQuantity.push($(this).val());
        })
        $("#comment").each(function () {
            submitData.comment = $(this).val();
        })
        var jsonData = JSON.stringify(submitData);
        localStorage.setItem("data", jsonData)
    }

    function restoreDataLocally() {
        var restoredData = localStorage.getItem("data");
        var jsonData = JSON.parse(restoredData);
        var rowCounter = 0;
        var row;
        $('tbody > tr').each(function () {
            row = $(this);
            row.find('.packet.quantity').val(parseInt(jsonData.packetQuantity[rowCounter]));
            row.find('.carton.quantity').val(parseInt(jsonData.cartonQuantity[rowCounter]));
            rowCounter++;
            updateSubtotal(row);
            if (row.find('.carton.quantity').val() > 0 || row.find('.packet.quantity').val() > 0) {
                row.addClass("highlighted");
            }
            else {
                row.removeClass("highlighted");
            }
        })
        $("#comment").val(jsonData.comment);
    }

    $(document).ready(function(){
        $('.toast').toast('show');
        $(".flavor").each(function(){
            let flavor = $(this);
            let flavorText = flavor.text().toLowerCase();
            if(flavorText.includes("red")){
                flavor.css("color", "red");
            }
            else if(flavorText.includes("blue")){
                flavor.css("color", "blue");
            }
            else if(flavorText.includes("gold")){
                flavor.css("color", "gold");
            }
            else if(flavorText.includes("menthol")){
                flavor.css("color", "green");
            }
            else if(flavorText.includes("yellow")){
                flavor.css("color", "yellow");
            }
            else if(flavorText.includes("white")){
                flavor.css("color", "black");
            }
            else{
                flavor.css("color", flavorText);
            }
        })
    });
</script>

