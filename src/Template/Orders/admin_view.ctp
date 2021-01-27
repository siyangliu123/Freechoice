<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Order $order
 */
echo $this->Html->css('orderCreate');


?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div id="content" class="invoice">
    <div class="row ausio">
        <div class="col-lg-6 col-md-6">
            <h1 style="padding-left: 50px; text-align:left; border-bottom: 3px black solid; margin-bottom: 20px;">Tax
                Invoice</h1>
            <div style="margin-left: 5vw;">AUSIO PTY LTD T/A FREECHOICE TOBACCONIST GREENSBOROUGH</div>
            <div style="margin-left: 5vw;">ABN: 39158843899</div>
            <div style="margin-left: 5vw;">Shop 2A, 35-39 Main Street, Greensborough, VIC, 3088</div>
            <br>
            <h3 style="text-align:left;margin-left: 5vw;">Invoice to:</h3>
        </div>
        <div class="col-lg-6 col-md-6">
            <?php
            echo $this->Html->image('Freechoice.jpg', ['class' => 'centerImage', 'alt' => 'Freechoice', 'style' => 'float: right;'])
            ?>
        </div>

    </div>

    <div class="row">
        <select id="client">
            <?php foreach ($clients as $client): ?>
                <option></option>
                <option ABN="<?php echo $client->company_ABN ?>" company="<?php echo $client->company_name ?>" address="<?php echo $client->company_address ?>"><?php echo $client->company_name ?></option>
            <?php endforeach;?>
        </select>
        <div contenteditable="true" class="col-lg-6 col-md-6" style="text-align: left; margin-left: 15vw;">
            <div class="company" style="text-transform: capitalize"><?php foreach ($users as $user):
                if ($user->user_id == $order->order_user) {
                    echo $user->user_company;
                }
            endforeach; ?></div>
            <div class="address" style="text-transform: capitalize"></div>
            <div class="order-date">Order Date: <?php echo date("d/m/Y H:i:s A", strtotime($order['order_date'])); ?></div>
            <div style="font-weight: bold" contenteditable="true">Customer ABN: <span class="ABN"></span></div>
        </div>
        <div class="col-lg-3 col-md-3 invoice-number">
            <div style="font-weight: bold; text-align: left;">Invoice Number:
                A<?php echo str_pad($order['order_id'], 6, "0", STR_PAD_LEFT); ?></div>
            <div style="font-weight: bold; text-align: left;">Sale Date: <?php echo date("d/m/Y H:i:s A"); ?></div>

        </div>
    </div>
    <br>

    <h5 style="text-align: left; margin-left: 5vw;">The following items in good order and condition :</h5>
    <div class="orderForm">
        <table id="orderTable" class="table table-hover table-bordered admin">
            <thead>
            <tr>
                <th scope="col" style="width: 30%">Brand</th>
                <th scope="col" style="width: 10%">Size</th>
                <th scope="col" style="width: 15%">Flavor</th>
                <th scope="col" style="width: 15%">Packet Price</th>
                <th scope="col" style="width: 5%">Packet Quantity</th>
                <th scope="col" style="width: 15%">Carton Price</th>
                <th scope="col" style="width: 5%">Carton Quantity</th>
                <th scope="col" style="width: 10%">Subtotal</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            <?php
            foreach ($orderCigarettes as $orderCigarette) {
                ?>
                <tr style="text-align:center">
                    <td><b contenteditable="true"><?= h($orderCigarette->cigarette->Cig_brand) ?></b>*</td>
                    <td><?= h($orderCigarette->cigarette->Cig_size) ?></td>
                    <td contenteditable="true"><?= h($orderCigarette->cigarette->Cig_flavor) ?></td>
                    <td>$<span class="pPrice"
                               contenteditable="true"><?= $this->Number->format($orderCigarette->packet_price) ?></span>
                    </td>
                    <td><input class="packet quantity" style="border: 0;font-weight:bold; text-align:center;"
                               type="text"
                               value="<?= $this->Number->format($orderCigarette->packet_quantity) ?>" min="0"
                        /></td>
                    <td>$<span class="cPrice"
                               contenteditable="true"><?= $this->Number->format($orderCigarette->cigarette->Cig_carton_price) ?></span>
                    </td>
                    <td><input class="carton quantity" style="border: 0;font-weight:bold; text-align:center;"
                               type="text"
                               value="<?= $this->Number->format($orderCigarette->carton_quantity) ?>" min="0"
                        /></td>
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
                <td style="font-weight: bold; font-size: larger">$<span id="total" contenteditable="true">0.00</span></td>
            </tr>
            <tr id="action">
                <td><label for="comment">Comment: </label></td>
                <td colspan="4">
                    <textarea id="comment" rows="3"
                              readonly="readonly"><?php echo $order['order_comment']; ?></textarea>
                </td>
                <td style="vertical-align:middle">
                    <input type="button" class="btn btn-success btn-sm" id="doPrint" value="Print Invoice"/>

                </td>
                <td style="vertical-align:middle">
                    <input type="button" class="btn btn-primary btn-sm" id="doPrint2" value="Print"/>

                </td>
                <td style="vertical-align:middle">
                    <?= $this->Html->link('Back', ['action' => 'adminList'], ['class' => 'btn btn-warning btn-sm']) ?>
                </td>
            </tr>

            </tfoot>
        </table>
    </div>
    <div class="gst" style="margin: 2vw 5vw;">Items marked with * have GST included --- GST included in Sale Total = $<span class="gst-amount"  contenteditable="true"  >0</span></div>
    <div class="transfer" style="margin-left: 5vw; border-top: 1px solid black">
        <p>Please transfer payment to: </p>
        <p>Account Name: AUSIO PTY LTD </p>
        <p>BSB: 063109 </p>
        <p>Account Number: 11190582 </p>
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
        updateGST();
    }

    function updateGST() {
        $(".gst-amount").html(($("#total").html() - $("#total").html() / 1.1).toFixed(2));
    }

    $("td").change(function () {
        $('tbody > tr').each(function () {
            var row = $(this);
            updateSubtotal(row);
        })
    });

    document.getElementById("doPrint").addEventListener("click", function () {
        $("#topNav").remove();
        $(".b-container").remove();
        $("#scrollDown").remove();
        $("#scrollTop").remove();
        $("#container").css("top", "0px");
        $("#content").css({"top": "0", "left": "0", "width": "100%"});
        $("#action").remove();
        $(".order-date").remove();
        $(".select2").remove();
        if (window.stop) {
            location.reload(); //triggering unload (e.g. reloading the page) makes the print dialog appear
            window.stop(); //immediately stop reloading
        }
    });

    document.getElementById("doPrint2").addEventListener("click", function () {
        $("#topNav").remove();
        $(".b-container").remove();
        $("#scrollDown").remove();
        $("#scrollTop").remove();
        $(".gst").remove();
        $(".transfer").remove();
        $(".content .ausio").remove();
        $(".invoice-number").remove();
        $(".company").css("font-size", "30px");
        $(".company").css("font-weight", "bold");
        $("#container").css("top", "0px");
        $("#content").css({"top": "0", "left": "0", "width": "100%"});
        $(".select2").remove();
        if (window.stop) {
            location.reload(); //triggering unload (e.g. reloading the page) makes the print dialog appear
            window.stop(); //immediately stop reloading
        }
    });

    $("#client").select2({
        placeholder: 'Search and select a company'
    });

    $("#client").change(function () {
        $(".company").html($("#client option:selected").attr("company"));
        $(".ABN").html($("#client option:selected").attr("ABN"));
        $(".address").html($("#client option:selected").attr("address"));

    })
</script>
<style>
    .select2{
        margin-left: 10vw;
    }
</style>