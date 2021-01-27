<div id="content">
    <h1>Generate Report</h1>
    <br/>
    <?= $this->Form->create(null, ["id" => "generateReportForm"]) ?>
    <h5>Start Date: <input type="text" name="startDate" id="startDate" autocomplete="off"></5>
    <h5>End Date: <input type="text" name="endDate" id="endDate" autocomplete="off"></h5>
    <button type="submit" class="btn btn-success">Submit</button>
    <?= $this->Form->end() ?>



</div>
<script>
    $( function() {
        $( "#startDate" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
        $( "#endDate" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );
</script>
