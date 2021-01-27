<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cigarette[]|\Cake\Collection\CollectionInterface $cigarette
 */
echo $this->Html->css('cigaretteView');

?>

<div id="content">
    <?= $this->Flash->render() ?>
    <div class="cigaretteForm">
        <h1>Stock</h1>
        <button id="export" class="btn btn-success">Export to CSV</button>
        <br/>
        <br/>
        <table id="cigaretteTable" class="table table-hover table-bordered table-centered stock">
            <thead>
            <tr>
                <th scope="col">Brand</th>
                <th scope="col">Size</th>
                <th scope="col">Flavor</th>
                <th scope="col">Packet in Carton</th>
                <th scope="col">Warehouse Stock</th>
                <th scope="col">Shop Stock</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            <?php foreach ($cigarette as $cigarette): ?>
                <tr>
                    <td><?= h($cigarette->Cig_brand) ?></td>
                    <td><?= h($cigarette->Cig_size) ?></td>
                    <td><?= h($cigarette->Cig_flavor) ?></td>
                    <td><?= h($cigarette->Cig_packet_in_carton) ?></td>
                    <td><?= $cigarette->Cig_warehouse_stock ?></td>
                    <td><?= $cigarette->Cig_shop_stock ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#export').click(function() {
        var titles = [];
        var data = [];

        $('#cigaretteTable th').each(function() {
            titles.push($(this).text());
        });

        $('#cigaretteTable td').each(function() {
            data.push($(this).text());
        });


        var CSVString = prepCSVRow(titles, titles.length, '');
        CSVString = prepCSVRow(data, titles.length, CSVString);

        var downloadLink = document.createElement("a");
        var blob = new Blob(["\ufeff", CSVString]);
        var url = URL.createObjectURL(blob);
        downloadLink.href = url;
        downloadLink.download = "stock.csv";

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
