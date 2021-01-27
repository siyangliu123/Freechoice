<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cigarette $cigarette
 */
echo $this->Html->css('cigaretteView');

?>
<div id="content">
<br>
<?= $this->Html->link(__('List Cigarette'), ['action' => 'index'],['class' => 'createLinks btn btn-primary btn-lg']) ?>

</ul>
</nav>
<div class="cigaretteForm">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create($cigarette) ?>

    <h1><?= __('Add Cigarette') ?></h1>
    <table id="editTable" class="table table-hover table-bordered">
        <tr>
            <td><label for="Cig_brand">Brand</label></td>
            <td><?php echo $this->Form->control('Cig_brand', ['class' => 'form-control', 'label' => false]); ?></td>
        </tr>
        <tr>
            <td><label for="Cig_size">Size</label></td>
            <td><?php echo $this->Form->control('Cig_size', ['class' => 'form-control', 'placeholder' =>   'e.g. 20/200', 'label' => false]); ?></td>
        </tr>
        <tr>
            <td><label for="Cig_flavor">Flavor</label></td>
            <td><?php echo $this->Form->control('Cig_flavor', ['class' => 'form-control', 'label' => false]); ?></td>
        </tr>
        <tr>
            <td><label for="Cig_packet_price">Packet Price ($)</label></td>
            <td><?php echo $this->Form->control('Cig_packet_price', ['class' => 'form-control', 'placeholder' =>   'e.g. 20.00', 'label' => false]); ?></td>
        </tr>
        <tr>
            <td><label for="Cig_carton_price">Carton Price ($)</label></td>
            <td><?php echo $this->Form->control('Cig_carton_price', ['class' => 'form-control', 'placeholder' =>   'e.g. 100.00', 'label' => false]); ?></td>
        </tr>
        <tr>
            <td><label for="Cig_company">Company</label></td>
            <td><?php echo $this->Form->select('Cig_company', ["BATA", "PML", "ITA", "ZZZ"],['class' => 'form-control', 'label' => false]); ?></td>
        </tr>
        <tr>
            <td><label for="Cig_warehouse_stock">Warehouse Stock (in packet)</label></td>
            <td><?php echo $this->Form->control('Cig_warehouse_stock', ['class' => 'form-control', 'value' => 0, 'label' => false]); ?></td>
        </tr>
        <tr>
            <td><label for="Cig_shop_stock">Stock in Shop</label></td>
            <td><?php echo $this->Form->control('Cig_shop_stock', ['class' => 'form-control', 'value' => 0, 'label' => false]); ?></td>
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
            <td><label for="Cig_packet_in_carton">Packet in a Carton</label></td>
            <td><?php echo $this->Form->control('Cig_packet_in_carton', ['class' => 'form-control', 'placeholder' => 'e.g. if 20/200, enter 10', 'label' => false]); ?></td>
        </tr>
        <tr>
            <td><label for="Cig_retail_price">Retail price ($)</label></td>
            <td><?php echo $this->Form->control('Cig_retail_price', ['class' => 'form-control', 'value' => 0, 'placeholder' => 'Retail price', 'label' => false]); ?></td>
        </tr>
        <tr>
            <td><label for="Cig_base_number">Base Number</label></td>
            <td><?php echo $this->Form->control('Cig_base_number', ['class' => 'form-control', 'value' => 0, 'placeholder' => 'Base number', 'label' => false]); ?></td>
        </tr>
    </table>
    <br>
    <?= $this->Form->button(__('Submit'), ["class" => "btn btn-success btn-lg"] ) ?>
    <?= $this->Form->end() ?>
</div>
</div>
