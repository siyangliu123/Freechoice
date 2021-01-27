<?= $this->Html->script("PapaParse-5.0.2/papaparse"); ?>
<script>
    var csvData;
</script>
<?= $this->Html->script("PapaParse-5.0.2/player/player"); ?>


<div id="content">
    <div id="fileUpload" style="margin: 20px;">
        <input type="file" id="files"/>
        <button id="submit-parse" disabled="disabled">Upload</button>
    </div>
    <?php echo $this->Form->create(null, ['url' => ['action' => 'Update'], 'type' => 'post', 'id' => 'cigaretteForm']); ?>
    <div>
        <?= $this->Flash->render() ?>
        <textarea name="csvData" style="display:none;" id="result" style="width: 80%;" rows="50"></textarea>
        <table id="viewCsvTable" class="table table-hover table-bordered">
            <tr>
                <th>Brand</th>
                <th>Size</th>
                <th>Packet Price</th>
                <th>Carton Price</th>
                <th>Retail Price</th>
            </tr>
        </table>
    </div>
    <button type="submit" id="updateTable" disabled="disabled">Submit</button>
    <?php echo $this->Form->end(); ?>
</div>

<script>
    $("#files").change(function(){
        if($("#files").val() !== ""){
            $("#submit-parse").removeAttr('disabled');
        }
    })

</script>


