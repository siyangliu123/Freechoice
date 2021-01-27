<?php
/**
 * @var \App\View\AppView $this
 */
?>

<?php
echo $this->Html->css('index');
?>
<?= $this->Flash->render('auth') ?>
<?= $this->Html->image('shopImage1.jpg', ['id' => 'shopImage1', 'class' => 'shopImage', 'alt' => 'Shop Image']); ?>
<?= $this->Html->image('shopImage2.jpg', ['id' => 'shopImage2', 'class' => 'shopImage', 'alt' => 'Shop Image']); ?>
<?= $this->Html->image('shopImage3.jpg', ['id' => 'shopImage3', 'class' => 'shopImage', 'alt' => 'Shop Image']); ?>
<?= $this->Html->image('shopImage4.jpg', ['id' => 'shopImage4', 'class' => 'shopImage', 'alt' => 'Shop Image']); ?>



<div id="loginContainer">
    <?php echo $this->Form->create(); ?>
    <h1>Welcome</h1>
    <br>
    <h4>Click & Collect Customer order please click <?= $this->Html->link(__('here'), ['controller' => 'customer_order', 'action' => 'add']) ?>
    </h4>
    <br>
    <br>
    <?= $this->Flash->render() ?>
    <div class="wholesale-login">
        <h5>- Wholesale Login -</h5>
    <div class="formElement">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username" placeholder="Username"/>
    </div>
    <div class="formElement">
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" placeholder="Password"/>
    </div>
    <center><button type="submit" class="btn btn-success btn-md" id="loginBtn">Login</button></center>
    <div>Click here to <a href="<?php echo $this->Url->build([
            "controller" => "Users",
            "action" => "add",
        ]); ?>">Sign up</a></div>
    <?php echo $this->Form->end();; ?>
    </div>
</div>
