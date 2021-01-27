<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cigarette $cigarette
 */
echo $this->Html->css('cigaretteView');

?>
<div id="content">
    <br>
    <?= $this->Html->link(__('List Cigarette'), ['action' => 'index'], ['class' => 'createLinks btn btn-primary btn-lg']) ?>
    <div class="cigaretteForm">
        <?= $this->Form->create($cigarette) ?>
        <h1><?= __('Edit Cigarette') ?></h1>
        <table id="editTable" class="table table-hover table-bordered">
            <tr>
                <td><label for="Cig_brand">Brand</label></td>
                <td><?php echo $this->Form->control('Cig_brand', ['class' => 'form-control', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_size">Size</label></td>
                <td><?php echo $this->Form->control('Cig_size', ['class' => 'form-control', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_flavor">Flavor</label></td>
                <td><?php echo $this->Form->control('Cig_flavor', ['class' => 'form-control', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_packet_price">Packet Price</label></td>
                <td><?php echo $this->Form->control('Cig_packet_price', ['class' => 'form-control', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_carton_price">Carton Price</label></td>
                <td><?php echo $this->Form->control('Cig_carton_price', ['class' => 'form-control', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_company">Company</label></td>
                <?php $companies = ['BATA' => 'BATA', 'PML' => 'PML', 'ITA' => 'ITA', 'ZZZ' => 'ZZZ']; ?>
                <td><?php echo $this->Form->select('Cig_company', $companies, ['class' => 'form-control', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_warehouse_stock">Warehouse Stock (in packet)</label></td>
                <td><?php echo $this->Form->control('Cig_warehouse_stock', ['class' => 'form-control', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_shop_stock">Stock in Shop (in packet)</label></td>
                <td><?php echo $this->Form->control('Cig_shop_stock', ['class' => 'form-control', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_packet_barcode">Packet Barcode</label></td>
                <td><?php echo $this->Form->control('Cig_packet_barcode', ['class' => 'form-control', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_carton_barcode">Carton Barcode</label></td>
                <td><?php echo $this->Form->control('Cig_carton_barcode', ['class' => 'form-control', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_packet_in_carton">Packet in a carton</label></td>
                <td><?php echo $this->Form->control('Cig_packet_in_carton', ['class' => 'form-control', 'placeholder' => 'e.g. if 20/200, enter 10', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_retail_price">Retail price ($)</label></td>
                <td><?php echo $this->Form->control('Cig_retail_price', ['class' => 'form-control', 'placeholder' => 'Retail price', 'label' => false]); ?></td>
            </tr>
            <tr>
                <td><label for="Cig_base_number">Base Number</label></td>
                <td><?php echo $this->Form->control('Cig_base_number', ['class' => 'form-control', 'placeholder' => 'Base number', 'label' => false]); ?></td>
            </tr>
        </table>
        <br>
        <?= $this->Form->button(__('Submit'), ["class" => "btn btn-success btn-lg"]) ?>
        <?= $this->Form->end() ?>
        <br>
        <button class="btn btn-danger btn-lg"><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cigarette->Cig_id],
                ['class' => 'createLinks', 'confirm' => __('Are you sure you want to delete {0} {1}?', $cigarette->Cig_brand, $cigarette->Cig_flavor)]
            )
            ?>
        </button>
    </div>
</div>
