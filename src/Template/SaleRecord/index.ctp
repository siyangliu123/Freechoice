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
    <h1>Scan Sales</h1>
    <?= $this->Flash->render() ?>

    <div class="searchCigarette">
        <input class="form-control" id="barCode" placeholder="Scan your barcode here">
        <select id="cigaretteSelect">
            <?php foreach ($cigarettes as $cigarette): ?>
                <option></option>
                <option><?php echo $cigarette->Cig_brand . " " . $cigarette->Cig_size . " " . $cigarette->Cig_flavor; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <?= $this->Form->create($newSaleRecord, ["id" => "saleForm"]) ?>
    <table id="cigaretteTable" class="table table-hover table-bordered table-centered stock">
        <thead>
        <tr>
            <th scope="col" style="display: none">Carton Barcode</th>
            <th scope="col" style="display: none">Packet Barcode</th>
            <th scope="col" style="display: none">Packet in Carton</th>
            <th scope="col">Cigarette</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cigarettes as $cigarette): ?>
            <tr class="cigaretteTr">
                <input type="hidden" class="itemId" value="<?php echo $cigarette->Cig_id; ?>" />
                <td style="display: none"><span class="cartonBarcode"><?php echo $cigarette->Cig_carton_barcode; ?></span></td>
                <td style="display: none"><span class="packetBarcode"><?php echo $cigarette->Cig_packet_barcode; ?></span></td>
                <td style="display: none"><span class="packetInCarton"><?php echo $cigarette->Cig_packet_in_carton; ?></span></td>
                <td><span class="cigaretteName"><?php echo $cigarette->Cig_brand . " " . $cigarette->Cig_size . " " . $cigarette->Cig_flavor; ?></span></td>
                <td><input class="cigaretteQuantity" value="1"></td>
                <td><button class="btn btn-success confirm-button" type="button">Proceed</button></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    <input type="hidden" id="item_id" name="item_id"/>
    <input type="hidden" id="record_item" name="record_item"/>
    <input type="hidden" id="record_sold_quantity" name="record_sold_quantity"/>


    <?= $this->Form->end() ?>
    <h5 id="division-sale">Sales Record</h5>
    <table id="recordTable" class="table table-hover table-bordered table-centered">
        <tr>
            <th scope="col">Time</th>
            <th scope="col">P Barcode</th>
            <th scope="col">C Barcode</th>
            <th scope="col">Item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Action</th>
        </tr>

        <?php foreach ($saleRecords as $saleRecord): ?>
            <tr class="saleRecords">
                <td><?php echo $saleRecord->record_date; ?></td>
                <td class="clickToCopy"><?php echo $saleRecord->cigarette->Cig_packet_barcode ?></td>
                <td class="clickToCopy"><?php echo $saleRecord->cigarette->Cig_carton_barcode ?></td>
                <td><?php echo $saleRecord->cigarette->Cig_brand." ".$saleRecord->cigarette->Cig_size." ".$saleRecord->cigarette->Cig_flavor; ?></td>
                <td><?php echo $saleRecord->record_sold_quantity; ?></td>
                <td>
                    <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $saleRecord->record_id], ['class' => 'btn btn-danger']);
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
    <?= $this->Html->link(__('Generate Report'), ['action' => 'report', date("Y-m-d"), date("Y-m-d")], ['class' => 'btn btn-success']) ?>




</div>

<script>
    $(document).ready(function () {
        $("#barCode").focus();
        $('#cigaretteSelect').select2(
            {
                placeholder: 'Search and select an item'
            }
        );

        $("#cigaretteTable").hide();

        $('#cigaretteSelect').on('select2:select', function (e) {
            $("#cigaretteTable").show();
            $(".cigaretteTr").hide();
            var data = e.params.data.text;
            $(".cigaretteTr").each(function(){
                var row = $(this);
                if(row.find(".cigaretteName").text()===data) {
                    row.find(".cigaretteQuantity").val(row.find(".packetInCarton").text());
                    row.show();
                    row.find(".cigaretteQuantity").focus();
                }
            });
        });

        $("#barCode").on("change", function(){
            $("#cigaretteTable").show();
            $(".cigaretteTr").hide();
            var barCodeDom = document.getElementById("barCode");
            barCodeDom.select();
            barCodeDom.setSelectionRange(0, 99999);
            document.execCommand("copy");
            var barCode = barCodeDom.value;
            var found = 0;
            $(".cigaretteTr").each(function(){
                var row = $(this);

                if (row.find(".packetBarcode").text()===barCode&&barCode!==""){
                    row.find(".cigaretteQuantity").val(1);
                    row.show();
                    // row.find(".cigaretteQuantity").focus();
                    found++;
                }
                else if(row.find(".cartonBarcode").text()===barCode&&barCode!==""){
                    row.find(".cigaretteQuantity").val(row.find(".packetInCarton").text());
                    row.show();
                    // row.find(".cigaretteQuantity").focus();
                    found++;
                }
            });
            if(found===0){
                $(".cigaretteTr").hide();
            }
            setInterval(function (){submit();}, 10000);
        });

        $(".confirm-button").on('click', function () {
            submit();
        });



        function submit() {
            var tr = $(".cigaretteTr:visible");
            var recordSoldQuantity = tr.find(".cigaretteQuantity").val();
            var recordItem = tr.find(".itemId").val();
            $("#record_item").val(recordItem);
            $("#record_sold_quantity").val(recordSoldQuantity);
            tr.closest("form").submit();
        }

        $('.cigaretteQuantity').on('focus', function () {
            this.selectionStart = 0;
            this.selectionEnd = this.value.length;
        });

        $(".clickToCopy").on("click", function(e){
            var textToCopy = $(this).text();
            var textArea = document.createElement("textarea");
            textArea.value = textToCopy;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("Copy");
            textArea.remove();
        });

    })
</script>
