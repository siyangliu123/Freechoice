
<?php
/**
 * @var \App\View\AppView $this
 */
?>

<?php
$this->Layout= 'logout';
echo $this->Html->css('index');
?>
<?= $this->Flash->render('auth') ?>
<div id="loginContainer">
    <?= $this->Form->create($user) ?>
    <h1>Sign up</h1>
    <table  id="signUpTable">
    <tr class="formElement">
        <td align="right"><label for="username">Username: </label></td>
        <td><input class="form-control" type="text" id="username" name="username" placeholder="Username"/></td>
    </tr>
    <tr class="formElement">
        <td align="right"><label for="password">Password: </label></td>
        <td ><input type="password" id="password" name="password" placeholder="Password"/></td>
    </tr>
    <tr class="formElement">
        <td align="right"><label for="user_company">Company Name: </label></td>
        <td><input type="text" id="user_company" name="user_company" placeholder="Company"/></td>
    </tr>
    <tr class="formElement">
        <td align="right"><label for="user_contact">Contact: </label></td>
        <td><input type="text" id="user_contact" name="user_contact" placeholder="04xxxxxxxx"/></td>
    </tr>
    </table>
    <?= $this->Flash->render() ?>
    <button type="submit" class="btn btn-success btn-md" id="loginBtn">Sign up</button>
    <?php echo $this->Form->end();; ?>
</div>
