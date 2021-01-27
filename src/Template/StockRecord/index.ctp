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
    <h1>Stock Record</h1>
    <?= $this->Html->link('Shop Stock In/Out', ['action' => 'add-shop'], ['class' => 'createLinks btn btn-success btn-lg']) ?>
    <?= $this->Html->link('Warehouse Stock In/Out', ['action' => 'add-warehouse'], ['class' => 'createLinks btn btn-success btn-lg']) ?>
    <?= $this->Flash->render() ?>
    <div class="filter row">
        <div class="date col-md-4">
            <label for="dateFilter"><b>Transaction Time:</b></label>
            <select id="dateFilter">
                <option>All</option>
                <?php
                foreach ($recordDates as $recordDate) {
                    ?>
                    <option><?php echo $recordDate['stock_record_date']; ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="location col-md-4">
            <label for="quantityFilter"><b>Stock In/Out:</b></label>
            <select id="quantityFilter" class="form-control">
                <option value="All">All</option>
                <option value="In">In</option>
                <option value="Out">Out</option>
            </select>
        </div>

        <div class="location col-md-4">
            <label for="locationFilter"><b>Stock Location:</b></label>
            <select id="locationFilter" class="form-control">
                <option value="All">All</option>
                <option value="Warehouse">Warehouse</option>
                <option value="Shop">Shop</option>
            </select>
        </div>
    </div>
    <table id="recordTable" class="table table-hover table-bordered table-centered">
        <thead>
        <tr>
            <th scope="col">Time</th>
            <th scope="col">Item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Location</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($stockRecords as $stockRecord): ?>
            <tr>
                <td><?php echo $stockRecord->stock_record_date; ?></td>
                <td><?php echo $stockRecord->stock_record_item; ?></td>
                <td><?php echo $stockRecord->stock_record_quantity; ?></td>
                <td>
                    <?php
                    if ($stockRecord->stock_location == 1) {
                        echo "Shop";
                    } else if ($stockRecord->stock_location == 0) {
                        echo "Warehouse";
                    }
                    ?>
                </td>
                <td>
                    <?php echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $stockRecord->stock_record_id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete {1} * {0} ? The In/Out stock number will not be reverted.', $stockRecord->stock_record_item, $stockRecord->stock_record_quantity)]); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>

</div>

<script>
    $(document).ready(function () {

        var table = $("#recordTable").DataTable(
            {
                "order": [[0, "desc"]],
                "pageLength": 50,
            }
        );

        $("#dateFilter").select2({
            width: '10vw'
        });

        $("#dateFilter").change(function () {
            var selected = $("#dateFilter option:selected").val();
            if (selected !== "All") {
                table
                    .column(0)
                    .search(selected)
                    .draw();
            }
            else {
                table
                    .column(0)
                    .search("")
                    .draw();
            }
        });

        $("#locationFilter").change(function () {
            var selected = $("#locationFilter option:selected").val();
            if (selected !== "All") {
                table
                    .column(3)
                    .search(selected)
                    .draw();
            }
            else {
                table
                    .column(3)
                    .search("")
                    .draw();
            }

        });

        $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
                var selected = $("#quantityFilter option:selected").val();


                if ( selected === "In" && data[2] > 0)
                {
                    return true;
                }
                else if ( selected === "Out" && data[2] < 0)
                {
                    return true;
                }
                else if( selected === "All")
                {
                    return true;
                }
                return false;
            }
        );

        $("#quantityFilter").change(function () {
            table.draw();
        });
    });
</script>

