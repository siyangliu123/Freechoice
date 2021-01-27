<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cigarette[]|\Cake\Collection\CollectionInterface $cigarette
 */
echo $this->Html->css('recordView');

?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<div id="content">
    <h1>Scan Shop In/Out</h1>
    <?= $this->Flash->render() ?>
    <?= $this->Form->create($stockRecords, ["id" => "stockForm"]) ?>


    <div class="form-check row">
        <h5 class="col-md-5 col-lg-5">Please select stock in/out:</h5>
        <div class="col-md-7 col-lg-7">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="shop-in" name="shop" value="in">
                <label class="custom-control-label" for="shop-in">Stock In</label>
            </div>
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="shop-out" name="shop" value="out">
                <label class="custom-control-label" for="shop-out">Stock Out</label>
            </div>
        </div>
    </div>

    <div class="searchCigarette">
        <input class="form-control" id="barCode" placeholder="Scan your barcode here">
        <div style="margin-top: 10px">OR</div>
        <select id="cigaretteSelect">
            <?php foreach ($cigarettes as $cigarette): ?>
                <option></option>
                <option><?php echo $cigarette->Cig_brand . " " . $cigarette->Cig_size . " " . $cigarette->Cig_flavor; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <table id="cigaretteTable" class="table table-hover table-bordered table-centered stock">
        <thead>
        <tr>
            <th scope="col" style="display: none">Carton Barcode</th>
            <th scope="col" style="display: none">Packet Barcode</th>
            <th scope="col" style="display: none">Packet in Carton</th>
            <th scope="col">Cigarette</th>
            <th scope="col">Current Stock</th>
            <th scope="col">Quantity</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cigarettes as $cigarette): ?>
            <tr class="cigaretteTr">
                <input type="hidden" class="itemId" value="<?php echo $cigarette->Cig_id; ?>"/>
                <td style="display: none"><span
                            class="cartonBarcode"><?php echo $cigarette->Cig_carton_barcode; ?></span></td>
                <td style="display: none"><span
                            class="packetBarcode"><?php echo $cigarette->Cig_packet_barcode; ?></span></td>
                <td style="display: none"><span
                            class="packetInCarton"><?php echo $cigarette->Cig_packet_in_carton; ?></span></td>
                <td>
                    <span class="cigaretteName"><?php echo $cigarette->Cig_brand . " " . $cigarette->Cig_size . " " . $cigarette->Cig_flavor; ?></span>
                </td>
                <td><span class="cigaretteStock"><?php echo $cigarette->Cig_shop_stock; ?></td>
                <td>
                    <button class="buttonQuantity cartonMinus" pInC="<?php echo $cigarette->Cig_packet_in_carton; ?>" type="button">-<?php echo $cigarette->Cig_packet_in_carton; ?></button>
                    <button class="buttonQuantity minus" type="button">-1</button>
                    <input class="cigaretteQuantity" value="0">
                    <button class="buttonQuantity plus" type="button">+1</button>
                    <button class="buttonQuantity cartonPlus" pInC="<?php echo $cigarette->Cig_packet_in_carton; ?>" type="button">+<?php echo $cigarette->Cig_packet_in_carton; ?></button>

                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    <input type="hidden" name="json" id="json"/>


    <?= $this->Form->end() ?>
    <button type="button" id="submit" class="btn btn-success">Submit</button>


</div>

<script>
    $(document).ready(function () {
        $("#barCode").focus();
        $('#cigaretteSelect').select2(
            {
                placeholder: 'Search and select an item'
            }
        );
        $(".searchCigarette,#cigaretteTable,#submit").hide();
        $("input[name='shop']").change(function () {
            $("input[name='shop']").attr("disabled", "disabled");
            if ($("input[name='shop']:checked").val() === "in") {
                limitPositive();
            }
            else if ($("input[name='shop']:checked").val() === "out") {
                limitNegative();
            }
            $(".searchCigarette,#cigaretteTable,#submit").show();
        });
        $("#barCode").on("focus", function () {
            $("#barCode").val("");
        });

        $(".buttonQuantity").on("click", function () {
            var quantity = $(this).parent().find(".cigaretteQuantity");
            if ($(this).hasClass("minus")) {
                quantity.val(parseInt(quantity.val()) - 1);
                if($("input[name='shop']:checked").val() === "in"){
                    if (parseInt(quantity.val()) < 0) {
                        alert("Please enter a positive integer");
                        quantity.val(0);
                    }
                    else{
                        quantity.parent().parent().addClass("changed");
                    }
                }
                else{
                    quantity.parent().parent().addClass("changed");
                }
                quantity.focus();
            }
            else if ($(this).hasClass("plus")) {
                quantity.val(parseInt(quantity.val()) + 1);
                if($("input[name='shop']:checked").val() === "out"){
                    if (parseInt(quantity.val()) > 0) {
                        alert("Please enter a negative integer");
                        quantity.val(0);
                    }
                    else{
                        quantity.parent().parent().addClass("changed");
                    }
                }
                else{
                    quantity.parent().parent().addClass("changed");
                }
                quantity.focus();
            }
            else if ($(this).hasClass("cartonMinus")) {
                var pInC = $(this).attr("pInC");
                quantity.val(parseInt(quantity.val()) - parseInt(pInC));
                if($("input[name='shop']:checked").val() === "in"){
                    if (parseInt(quantity.val()) < 0) {
                        alert("Please enter a positive integer");
                        quantity.val(0);
                    }
                    else{
                        quantity.parent().parent().addClass("changed");
                    }
                }
                else{
                    quantity.parent().parent().addClass("changed");
                }
                quantity.focus();
            }
            else if ($(this).hasClass("cartonPlus")) {
                var pInC = $(this).attr("pInC");
                quantity.val(parseInt(quantity.val()) + parseInt(pInC));
                if($("input[name='shop']:checked").val() === "out"){
                    if (parseInt(quantity.val()) > 0) {
                        alert("Please enter a negative integer");
                        quantity.val(0);
                    }
                    else{
                        quantity.parent().parent().addClass("changed");
                    }
                }
                else{
                    quantity.parent().parent().addClass("changed");
                }
                quantity.focus();
            }

            if(parseInt(quantity.val())===0){
                $(this).parent().parent().removeClass("changed");
            }
            quantity.on('keypress',function(e) {
                if(e.which === 13) {
                    quantity.trigger("change");
                }
            });
        });


        $('#cigaretteSelect').on('select2:select', function (e) {
            var data = e.params.data.text;
            $(".cigaretteTr").each(function () {
                var row = $(this);
                if (row.find(".cigaretteName").text() === data) {
                    row.find(".cigaretteQuantity").focus();
                }
            });
        });

        $("#barCode").on("change", function () {
            var barCode = $("#barCode").val();
            $(".cigaretteTr").each(function () {
                var row = $(this);

                if (row.find(".packetBarcode").text() === barCode && barCode !== "") {
                    row.find(".cigaretteQuantity").focus();
                }
                else if (row.find(".cartonBarcode").text() === barCode && barCode !== "") {
                    if($("input[name='shop']:checked").val() === "in"){
                        row.find(".cigaretteQuantity").val(row.find(".packetInCarton").text());
                    }
                    else{
                        row.find(".cigaretteQuantity").val(0-parseInt(row.find(".packetInCarton").text()));
                    }
                    row.find(".cigaretteQuantity").focus();
                    row.find(".cigaretteQuantity").on('keypress',function(e) {
                        if(e.which === 13) {
                            row.find(".cigaretteQuantity").trigger("change");
                        }
                    });
                }
            });
        });

        $('.cigaretteQuantity').on('focus', function () {
            this.selectionStart = 0;
            this.selectionEnd = this.value.length;
        });

        $("#submit").on("click", function () {
            var json = [];
            var row,stockItem, stockQuantity, stockId, jsonRow;
            $(".changed").each(function(){
                row = $(this);
                jsonRow = {};
                stockId = row.find(".itemId").val();
                stockItem = row.find(".cigaretteName").text();
                stockQuantity = row.find(".cigaretteQuantity").val();
                jsonRow.stockId = parseInt(stockId);
                jsonRow.stockItem = stockItem;
                jsonRow.stockQuantity = parseInt(stockQuantity);
                json.push(jsonRow);
            });
            var jsonString = JSON.stringify(json);
            $("#json").val(jsonString);
            $("#stockForm").submit();
        });

        function limitPositive() {
            $(".cigaretteQuantity").on("change",function () {
                if (Number.isInteger(parseFloat($(this).val())) !== true) {
                    alert("Please enter an integer");
                    $(this).val(0);
                }
                else if (parseInt($(this).val()) < 0) {
                    alert("Please enter a positive integer");
                    $(this).val(0);
                }
                else{
                    $(this).parent().parent().addClass("changed");
                    $("#barCode").focus();
                }
            });
        }

        function limitNegative() {
            $(".cigaretteQuantity").on("change", function () {
                if (Number.isInteger(parseFloat($(this).val())) !== true) {
                    alert("Please enter an integer");
                    $(this).val(0);
                }
                else if (parseInt($(this).val()) > 0) {
                    alert("Please enter a negative integer");
                    $(this).val(0);
                }
                else {
                    $(this).parent().parent().addClass("changed");
                    $("#barCode").focus();
                }
            });
        }
    });
</script>
