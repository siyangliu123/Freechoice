<style>
    .table td{
        vertical-align: middle;
    }
</style>
<div class="orderForm" style="padding: 5vh 10vw">
    <table id="orderTable" class="table table-hover table-bordered admin" >
        <thead>
        <tr>
            <th scope="col" style="width:10%">Order By</th>
            <th scope="col" style="width:15%">Date</th>
            <th scope="col" style="width:5%">C</th>
            <th scope="col">Brand</th>
            <th scope="col">Size</th>
            <th scope="col">Flavor</th>
            <th scope="col" style="width:5%">Packet Quantity</th>
            <th scope="col" style="width:5%">Carton Quantity</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($orders as $order) {
            ?>
            <tr style="text-align:center">
                <td><?php echo $order['user_company']; ?></td>
                <td><?php echo $order['order_date']; ?></td>
                <td><?php echo $order['order_comment']; ?></td>
                <td><?php echo $order['Cig_brand']; ?></td>
                <td><?php echo $order['Cig_size']; ?></td>
                <td><?php echo $order['Cig_flavor']; ?></td>
                <td><?php echo $order['packet_quantity']; ?></td>
                <td><?php echo $order['carton_quantity']; ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <button id="export" class="btn btn-success">Export to CSV</button>

</div>
<script>
    $("#orderTable").DataTable({
        "pageLength": 100,
        "ordering": false
    });

    $('#export').click(function() {
        var titles = [];
        var data = [];

        $('#orderTable th').each(function() {
            titles.push($(this).text());
        });

        $('#orderTable td').each(function() {
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
