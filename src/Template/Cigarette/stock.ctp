<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cigarette[]|\Cake\Collection\CollectionInterface $cigarette
 */
echo $this->Html->css('cigaretteView');

?>
<div id="content">
    <?= $this->Flash->render() ?>
    <br>
    <?= $this->Html->link('Convert To CSV(Excel)', ['action' => 'convert'], ['class' => 'createLinks btn btn-success btn-lg']) ?>
    <div class="cigaretteForm">
        <?php echo $this->Form->create($cigarette, ['id' => 'stockForm']); ?>
        <h1>Stock Management</h1>
        <table id="cigaretteTable" class="table table-hover table-bordered table-centered stock">
            <colgroup>
                <col width="15%" align="center">
                <col width="10%" align="center">
                <col width="10%" align="center">
                <col width="5%" align="center">
                <col width="20%" align="center">
                <col width="5%" align="center">
                <col width="20%" align="center">
                <col width="15%" align="center">
            </colgroup>
            <thead>
            <tr>
                <th scope="col">Brand</th>
                <th scope="col">Size</th>
                <th scope="col">Flavor</th>
                <th scope="col">Packet in Carton</th>
                <th scope="col">Warehouse Stock</th>
                <th scope="col">Base Number</th>
                <th scope="col">Shop Stock</th>
                <th scope="col">Total Stock</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            <?php foreach ($cigarette as $cigarette): ?>
                <tr>
                    <input class="id" type="hidden" value="<?= h($cigarette->Cig_id) ?>"/>
                    <td><?= h($cigarette->Cig_brand) ?></td>
                    <td><?= h($cigarette->Cig_size) ?></td>
                    <td><?= h($cigarette->Cig_flavor) ?></td>
                    <td class="packetInQuantity"><?= h($cigarette->Cig_packet_in_carton) ?></td>
                    <td>
                        <span
                            class="stockQuantitySpan warehouse"><b><?= $cigarette->Cig_warehouse_stock ?></b> (<?php echo number_format(($cigarette->Cig_warehouse_stock / $cigarette->Cig_packet_in_carton), 2) ?>)</span>-><input
                            class="stockQuantity warehouse"
                            value="<?= $this->Number->format($cigarette->Cig_warehouse_stock) ?>"/>
                    </td>
                    <td>
                        <span class="baseNumber"><?= $this->Number->format($cigarette->Cig_base_number) ?></span>
                    </td>
                    <td>
                        <span
                            class="stockQuantitySpan shop"><b><?= $cigarette->Cig_shop_stock ?></b> (<?php echo number_format(($cigarette->Cig_shop_stock / $cigarette->Cig_packet_in_carton), 2) ?>)</span>-><input
                            class="stockQuantity shop"
                            value="<?= $this->Number->format($cigarette->Cig_shop_stock) ?>"/>
                    </td>
                    <td><span class="stockQuantitySpan total"></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <input type="hidden" name="json" id="json"/>
        <br/>
        <button type="submit" class="btn btn-success">Submit</button>
        <?php $this->Form->end(); ?>

    </div>
</div>

<script>
    $(document).ready(function () {
        updateTotal();
    });

    $(".stockQuantity").on("change", function () {
        var inputQuantity = $(this);
        var diff = parseInt(inputQuantity.val()) - parseInt(inputQuantity.parent().find(".stockQuantitySpan").text());
        inputQuantity.parent().parent().addClass("changed");


        if (inputQuantity.attr("class").includes("shop")) {
            var totalQuantity = inputQuantity.parent().parent().find(".stockQuantity.total");
            totalQuantity.val(parseInt(inputQuantity.parent().parent().find(".stockQuantitySpan.total").text()) + diff);
        }

        updateTotal();
    });

    function updateTotal() {
        $("#tableBody tr").each(function () {
            var warehouseInt = parseInt($(this).find(".stockQuantity.warehouse").val());
            var shopInt = parseInt($(this).find(".stockQuantity.shop").val());
            var quantity = parseInt($(this).find(".packetInQuantity").text());
            var totalInt = warehouseInt + shopInt;
            $(this).find(".stockQuantitySpan.total").text(totalInt + "(" + (totalInt / quantity).toFixed(2) + ")");
        });
    }

    $('.stockQuantity').on('focus', function () {
        this.selectionStart = 0;
        this.selectionEnd = this.value.length;
    });

    $(".stockQuantitySpan.shop").each(function () {
        let stock = $(this).find("b").text();
        let baseNumber = $(this).parent().parent().find(".baseNumber").text()
        if (parseInt(stock) < parseInt(baseNumber)) {
            console.log(stock + " " + baseNumber);
            $(this).css("color", "red");
        }
    });

    $("#stockForm").submit(function () {
        var json = [];
        var row, id, warehouseStock, shopStock, jsonRow;
        $(".changed").each(function () {
            row = $(this);
            jsonRow = {};
            id = row.find(".id").val();
            warehouseStock = row.find(".stockQuantity.warehouse").val();
            shopStock = row.find(".stockQuantity.shop").val();
            jsonRow.Cig_id = parseInt(id);
            jsonRow.Cig_warehouse_stock = parseInt(warehouseStock);
            jsonRow.Cig_shop_stock = parseInt(shopStock);
            json.push(jsonRow);
        });
        $("#json").val(JSON.stringify(json));
    });
</script>


