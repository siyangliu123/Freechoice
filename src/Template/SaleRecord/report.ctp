<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cigarette[]|\Cake\Collection\CollectionInterface $cigarette
 */
echo $this->Html->css('recordView');

?>
<div id="content">
    <?php if($startDate == $endDate){ ?>
    <h1>Sales Report for <?php echo $startDate; ?></h1>
    <?php }
    else{
        ?>
    <h1>Sales Report between <?php echo $startDate; ?> to <?php echo $endDate; ?></h1>
    <?php } ?>
    <br/>
    <?= $this->Flash->render() ?>
    <table id="recordTable" class="table table-hover table-bordered table-centered">
        <thead>
        <tr>
            <th scope="col">Item Sold</th>
            <th scope="col">Quantity Sold</th>
            <th scope="col">Retail Price</th>
            <th scope="col">Total</th>
        </tr>
        </thead>
<tbody>
        <?php foreach ($saleRecords as $saleRecord): ?>
            <tr class="saleRecords">
                <td><?php echo $saleRecord['Cig_brand']." ".$saleRecord["Cig_size"]." ".$saleRecord["Cig_flavor"]; ?></td>
                <td><span class="quantity"><?php echo $saleRecord['record_sold_quantity']; ?></span></td>
                <td><span class="price"><?php echo $saleRecord['Cig_retail_price']; ?></span></td>
                <td><span class="total"></span></td>
            </tr>
        <?php endforeach; ?>
</tbody>
        <tfoot>
        <tr>
            <td><b>Total Quantity:</b></td>
            <td><span id="totalQuantity"></span></td>
            <td><b>Total Sale:</b></td>
            <td><span id="totalSale"></span></td>
        </tr>
        </tfoot>
    </table>
    <button id="export" class="btn btn-success">Export to CSV</button>
</div>

<script>
    $(document).ready(function () {
        var totalQuantity = 0;
        var totalSale = 0;
        $(".saleRecords").each(function(){
            var tr = $(this);
            var quantity = parseFloat(tr.find(".quantity").text());
            var price = parseFloat(tr.find(".price").text());
            var total = quantity * price;
            tr.find(".total").text(total.toFixed(2));
            totalQuantity+=quantity;
            totalSale += total;
        });
        $("#totalQuantity").text(totalQuantity);
        $("#totalSale").text(totalSale.toFixed(2));

    });

    $('#export').click(function() {
        var titles = [];
        var data = [];

        $('#recordTable th').each(function() {
            titles.push($(this).text());
        });

        $('#recordTable td').each(function() {
            data.push($(this).text());
        });


        var CSVString = prepCSVRow(titles, titles.length, '');
        CSVString = prepCSVRow(data, titles.length, CSVString);

        var downloadLink = document.createElement("a");
        var blob = new Blob(["\ufeff", CSVString]);
        var url = URL.createObjectURL(blob);
        downloadLink.href = url;
        downloadLink.download = "data.csv";

        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    });

    function prepCSVRow(arr, columnCount, initial) {
        var row = ''; // this will hold data
        var delimeter = ','; // data slice separator, in excel it's `;`, in usual CSv it's `,`
        var newLine = '\r\n'; // newline separator for CSV row

        function splitArray(_arr, _count) {
            var splitted = [];
            var result = [];
            _arr.forEach(function(item, idx) {
                if ((idx + 1) % _count === 0) {
                    splitted.push(item);
                    result.push(splitted);
                    splitted = [];
                } else {
                    splitted.push(item);
                }
            });
            return result;
        }
        var plainArr = splitArray(arr, columnCount);
        plainArr.forEach(function(arrItem) {
            arrItem.forEach(function(item, idx) {
                row += item + ((idx + 1) === arrItem.length ? '' : delimeter);
            });
            row += newLine;
        });
        return initial + row;
    }
</script>
