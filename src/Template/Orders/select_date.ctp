<div id="content">
    <h1>Select orders to view</h1>
    <br/>
    <?php if (!isset($orders)){
    echo $this->Form->create(null, ["id" => "selectDateForm"]) ?>
    <h5>Start Date: <input type="text" name="startDate" id="startDate" autocomplete="off"></h5>
    <h5>End Date: <input type="text" name="endDate" id="endDate" autocomplete="off"></h5>
    <button type="submit" class="btn btn-success">Submit</button>
    <?php echo $this->Form->end();
    }
    else {
        echo $this->Form->create(null,['url' => ['action' => 'ViewOrders'], "id" => "ordersForm"]);
        ?>
        <div style="border: 1px solid gray; margin: 5vh 10vw; padding: 5vh">

            <div class="widget">
                <fieldset>
                <?php
                foreach ($orders as $order) {
                    ?>
                    <input type="checkbox" id="<?php echo $order['order_id']; ?>" name="orders"
                           value="<?php echo $order['order_id']; ?>">
                    <label
                        for="<?php echo $order['order_id']; ?>"><?php echo $order['user_company'] . " " . $order['order_date'] . " " . $order['order_comment']; ?></label>
                <?php } ?>
                </fieldset>
            </div>
            <input type="hidden" id="selected-orders" name="selected-orders">
            <button id="submit-form" type="button" class="btn btn-success">Submit</button>

        </div>
        <?php echo $this->Form->end();
    } ?>


</div>
<script>
    $(function () {
        $("#startDate").datepicker({
            dateFormat: "yy-mm-dd"
        });
        $("#endDate").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });


    $('input[name="orders"]').each(function () {
        this.checked = true;
    });

    $(".widget input").checkboxradio({

    })

    $("#submit-form").on('click', function (){
        let orderList = [];
        $('input[name="orders"]').each(function () {
            if(this.checked === true){
                orderList.push(parseInt($(this).val()));
            }
        })
        let orderListStr = JSON.stringify(orderList);
        $("#selected-orders").val(orderListStr);
        $("#ordersForm").submit();
    })
</script>
