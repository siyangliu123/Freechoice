<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerOrder $customerOrder
 */
?>

<?php
$this->Layout = 'logout';
echo $this->Html->css('index');
?>
<div id="loginContainer">
    <?= $this->Flash->render() ?>

    <?= $this->Form->create($customerOrder) ?>
    <h1>Order & Collect</h1>
    <table id="signUpTable">
        <tr class="formElement">
            <td align="right"><label for="customer_name">Customer Name: </label></td>
            <td><input class="form-control" type="text" id="customer_name" name="customer_name" placeholder="Please provide your name"/>
            </td>
        </tr>
        <tr class="formElement">
            <td align="right"><label for="customer_contact">Contact Mobile: </label></td>
            <td>
                <div class="input-group customer_contact">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+61(0)</span>
                    </div>
                    <input class="form-control" type="text" id="customer_contact" name="customer_contact" placeholder="4 xxxx xxxx"
                </div>
            </td>
        </tr>
        <tr class="formElement">
            <td align="right"><label for="customer_order_detail">Order Detail: </label></td>
            <td><textarea id="customer_order_detail" name="customer_order_detail" placeholder="E.g. 1 Packet/Carton of Winfield 20s Blue"></textarea></td>
        </tr>
    </table>
    <div id="checkbox-group">
        <input type="checkbox" id="agree" name="agree">
        <label for="agree">I confirm I'm over 18 years old and able to provide valid ID to prove.</label>
    </div>
    <br>
    <div id="hover">
    <button type="submit" class="btn btn-success btn-md" id="submit" disabled><div id="button-submit">Submit</div></button>
    </div>
    <div id="hover-submit">Please confirm that you are over 18 by check the above checkbox.</div>
    <?= $this->Form->end() ?>
</div>

<script>
    $(document).ready(function () {
        $('#hover-submit').hide();
        $('#agree').change(function() {
            if(this.checked) {
                $("#submit").prop("disabled", false);
            }
            else{
                $("#submit").prop("disabled", true);
            }
        })
        $(function() {
            $('#button-submit,#hover').hover(function() {
                $('#hover-submit').show();
            }, function() {
                $('#hover-submit').hide();
            });
        });
    })
</script>
