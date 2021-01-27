<?php

echo $this->Html->css('orderCreate');


?>


<?php echo $this->Form->create($invoice, ["id" => "invoiceForm"]); ?>
<div class="invoice">
    <br/>
    <br/>
    <?php echo $this->Flash->render(); ?>
    <h3 style="text-align:left;margin-left: 5vw;">Order from:</h3>

    <div class="row">
        <select id="client" name="client" required>
            <?php foreach ($clients as $client): ?>
                <option></option>
                <option value="<?php echo $client->detail_id ?>" ABN="<?php echo $client->company_ABN ?>" company="<?php echo $client->company_name ?>"
                        address="<?php echo $client->company_address ?>"><?php echo $client->company_name ?></option>
            <?php endforeach; ?>
        </select>
        <?= $this->Html->link(__('+ Add Company'), ['controller' => 'clients', 'action' => 'add'], ['id' => 'addCompany', 'class'=> 'btn btn-success btn-sm','target' => '_blank']) ?>
        <div contenteditable="true" class="col-lg-6 col-md-6" style="text-align: left; margin-left: 15vw;">
            <div class="company" style="text-transform: capitalize">
                <?php
                echo $orderUser->user_company;
                ?></div>
            <div class="address" style="text-transform: capitalize"></div>
            <div class="order-date">Order
                Date: <?php echo date("d/m/Y H:i:s A", strtotime($order['order_date'])); ?></div>
            <div style="font-weight: bold" contenteditable="true">Customer ABN: <span class="ABN"></span></div>
        </div>
    </div>
    <input id="clientID" type="hidden" value="0"/>

    <br>
    <div class="orderForm">
        <table id="invoiceAdd" class="table table-hover table-bordered invoiceAdd">
            <thead>
            <tr>
                <th scope="col">Brand</th>
                <th scope="col">Size</th>
                <th scope="col">Flavor</th>
                <th scope="col">Packet Price</th>
                <th scope="col">Packet Shop+Warehouse</th>
                <th scope="col">Carton Price</th>
                <th scope="col">Carton Shop+Warehouse</th>
                <th scope="col">Subtotal</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            <?php
            foreach ($orderCigarettes as $orderCigarette) {
                ?>
                <tr style="text-align:center">
                    <td><input class="brand" value="<?= h($orderCigarette->cigarette->Cig_brand) ?>"/></td>
                    <td><input class="size" value="<?= h($orderCigarette->cigarette->Cig_size) ?>"/></td>
                    <td><input class="flavor" value="<?= h($orderCigarette->cigarette->Cig_flavor) ?>"</td>
                    <td><input class="pPrice" value="<?= $this->Number->format($orderCigarette->packet_price) ?>"/>
                    </td>
                    <td><input class="packetFromShop" value="0"/>
                        +
                        <input class="packetFromWarehouse" value="<?= $orderCigarette->packet_quantity ?>"/>
                        =
                        <input class="packet quantity" disabled="disabled" type="text" value="<?= $orderCigarette->packet_quantity ?>" min="0"/>
                    </td>

                    <td><input class="cPrice"
                               value="<?= $this->Number->format($orderCigarette->cigarette->Cig_carton_price) ?>"/>
                    </td>
                    <td><input class="cartonFromShop" value="0"/>
                        +
                        <input class="cartonFromWarehouse" value="<?= $orderCigarette->carton_quantity ?>"/>
                        =
                        <input class="carton quantity" disabled="disabled" type="text" value="<?= $orderCigarette->carton_quantity ?>" min="0"/>
                    </td>
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
                <td style="font-weight: bold; font-size: larger">$<span id="total" contenteditable="true">0.00</span>
                </td>
            </tr>
            <tr id="action">
                <td><label for="comment">Comment: </label></td>
                <td colspan="5">
                    <textarea id="comment" rows="3"
                              readonly="readonly"><?php echo $order['order_comment']; ?></textarea>
                </td>
                <td style="vertical-align:middle">
                    <input type="button" class="btn btn-success btn-md" id="submitInvoice" value="Generate Invoice"/>

                </td>
                <td style="vertical-align:middle">
                    <input type="button" class="btn btn-primary btn-md" id="doPrint" value="Print Order"/>
                </td>
            </tr>

            </tfoot>
        </table>
    </div>
    <input id="submitData" name="submitData" type="hidden"/>
</div>
<?php echo $this->Form->end(); ?>
<script>
    $(document).ready(function () {
        $('tbody > tr').each(function () {
            var row = $(this);
            updateSubtotal(row);
        })
        $("#tableBody input").each(function() {
            this.style.width = ((this.value.length + 1) * 10+ 10) + 'px';
        })
    })

    function updateSubtotal(tr) {
        var pPrice = parseFloat(tr.find(".pPrice").val());
        var cPrice = parseFloat(tr.find(".cPrice").val());
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

    function updateQuantity(tr){
        var packetFromShop = parseInt(tr.find(".packetFromShop").val());
        var packetFromWarehouse = parseInt(tr.find(".packetFromWarehouse").val());
        var cartonFromShop = parseInt(tr.find(".cartonFromShop").val());
        var cartonFromWarehouse = parseInt(tr.find(".cartonFromWarehouse").val());
        var pQuantity = tr.find(".quantity.packet");
        var cQuantity = tr.find(".quantity.carton");
        var packetTotal = packetFromShop + packetFromWarehouse;
        var cartonTotal = cartonFromShop + cartonFromWarehouse;
        pQuantity.val(packetTotal);
        cQuantity.val(cartonTotal);
    }

    $("td input").on("keyup", function () {
        $('tbody > tr').each(function () {
            var row = $(this);
            updateQuantity(row);
            updateSubtotal(row);
        })
    });

    $("#submitInvoice").on("click", function () {
        if($("#client option:selected").val()===""){
            alert("Please select a company or add company details")
            $(".select2-selection").focus();
            return false;
        }
        let json = [];
        $("#tableBody tr").each(function(){
            let row = $(this);
            let jsonItem = {};
            jsonItem.cigarette_brand = row.find(".brand").val();
            jsonItem.cigarette_size = row.find(".size").val();
            jsonItem.cigarette_flavor = row.find(".flavor").val();
            jsonItem.packet_price = row.find(".pPrice").val();
            jsonItem.packet_from_shop = row.find(".packetFromShop").val();
            jsonItem.packet_from_warehouse = row.find(".packetFromWarehouse").val();
            jsonItem.carton_price = row.find(".cPrice").val();
            jsonItem.carton_from_shop = row.find(".cartonFromShop").val();
            jsonItem.carton_from_warehouse = row.find(".cartonFromWarehouse").val();
            json.push(jsonItem);
        })
        let jsonString = JSON.stringify(json);
        $("#submitData").val(jsonString);
        $("#invoiceForm").submit();
    });

    document.getElementById("doPrint").addEventListener("click", function () {
        $("#topNav").remove();
        $(".b-container").remove();
        $("#scrollDown,#scrollTop").remove();
        $(".gst,#addCompany").remove();
        $(".transfer").remove();
        $(".company").css("font-size", "30px");
        $(".company").css("font-weight", "bold");
        $("#container").css("top", "0px");
        $("#content").css({"top": "0", "left": "0", "width": "100%"});
        $(".select2").remove();
        $("#tableBody input").css("border", "0");
        if (window.stop) {
            location.reload();
            window.stop();
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

    $("#tableBody input").on("keyup", function () {
        this.style.width = ((this.value.length + 1) * 10 + 10) + 'px';
    })
</script>
<style>
    .select2 {
        margin-left: 10vw;
    }
</style>
