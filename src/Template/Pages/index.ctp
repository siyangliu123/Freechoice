<?php
echo $this->Html->css('index');
?>
    <div id="loginContainer">
        <?php echo $this->Form->create(null, [
            'url' => ['controller' => 'Users', 'action' => 'login']
        ]); ?>
            <h1>Welcome</h1>
            <div class="formElement">
                <label for="username">Username: </label>
                <input type="text" id="username" name="username" placeholder="Username"/>
            </div>
            <div class="formElement">
                <label for="password">Password: </label>
                <input type="password" id="password" name="password" placeholder="Password"/>
            </div>
            <?= $this->Flash->render() ?>
            <button type="submit" class="btn btn-success btn-md" id="loginBtn">Login</button>
            <div>Click here to <a href="user/add">Sign up</a></div>
        <?php echo $this->Form->end();; ?>

    </div>