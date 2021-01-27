<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
echo $this->Html->css('admin');
?>

<div class="b-nav row">

    <ul class="col-lg-3">
        <li id="homeNav"><?php echo $this->Html->Link("Home", ["controller" => "Users", "action" => "admin"], ['class' => 'b-link']); ?></li>
        <li><h3>Order</h3></li>
        <li><?php echo $this->Html->Link("List Orders", ["controller" => "Orders", "action" => "adminList"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("Create Orders", ["controller" => "Orders", "action" => "add"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("Manage Invoice", ["controller" => "Invoice", "action" => "index"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("Retail Orders", ["controller" => "CustomerOrder", "action" => "index"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("List Selected Orders", ["controller" => "Orders", "action" => "selectDate"], ['class' => 'b-link']); ?></li>

    </ul>
    <ul class="col-lg-3">
        <li><h3>Sales</h3></li>
        <li><?php echo $this->Html->Link("Daily Scan", ["controller" => "SaleRecord", "action" => "index"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("Sale Report", ["controller" => "SaleRecord", "action" => "generateReport"], ['class' => 'b-link']); ?></li>
        <li><h3>Cigarette</h3></li>
        <li><?php echo $this->Html->Link("Manage Cigarette", ["controller" => "Cigarette", "action" => "index"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("Add Cigarette", ["controller" => "Cigarette", "action" => "add"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("Update Cigarettes", ["controller" => "Cigarette", "action" => "update"], ['class' => 'b-link']); ?></li>

    </ul>
    <ul class="col-lg-3">
        <li><h3>Stock</h3></li>
        <li><?php echo $this->Html->Link("Stock Take", ["controller" => "Cigarette", "action" => "stock"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("Stock In/Out Record", ["controller" => "StockRecord", "action" => "index"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("Warehouse In/Out", ["controller" => "StockRecord", "action" => "addWarehouse"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("Shop In/Out", ["controller" => "StockRecord", "action" => "addShop"], ['class' => 'b-link']); ?></li>

    </ul>
    <ul class="col-lg-3">
        <li><h3>Users</h3></li>
        <li><?php echo $this->Html->Link("Manage Users", ["controller" => "Users", "action" => "index"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("Manage Wholesale Clients", ["controller" => "Clients", "action" => "index"], ['class' => 'b-link']); ?></li>
        <li><h3>Announcements</h3></li>
        <li><?php echo $this->Html->Link("Add Announcement", ["controller" => "Announcement", "action" => "add"], ['class' => 'b-link']); ?></li>
        <li><?php echo $this->Html->Link("Manage Announcement", ["controller" => "Announcement", "action" => "index"], ['class' => 'b-link']); ?></li>
    </ul>
</div>

<!-- Burger-Icon -->
<div class="b-container">
    <div class="b-menu">
        <div class="b-bun b-bun--top"></div>
        <div class="b-bun b-bun--mid"></div>
        <div class="b-bun b-bun--bottom"></div>
    </div>
</div>


<script>
    'use strict';

    (function () {
        var body = document.body;
        var burgerMenu = document.getElementsByClassName('b-menu')[0];
        var burgerContain = document.getElementsByClassName('b-container')[0];
        var burgerNav = document.getElementsByClassName('b-nav')[0];

        burgerMenu.addEventListener('click', function toggleClasses() {
            [body, burgerContain, burgerNav].forEach(function (el) {
                el.classList.toggle('open');
            });
        }, false);
    })();
</script>
