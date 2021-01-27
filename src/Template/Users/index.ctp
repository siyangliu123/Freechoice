<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
echo $this->Html->css('orderCreate');
?>

<div id="content">
    <div class="orderForm">
        <h3>Manage Users</h3>
        <table id="orderTable" class="table table-hover table-bordered">
            <thead>
            <tr >
                <th scope="col" style ="width: 10%;" >Username</th>
                <th scope="col" style ="width: 20%;">Company</th>
                <th scope="col" style ="width: 20%;">Contact</th>
                <th scope="col" style ="width: 20%;">Status</th>
                <th scope="col" style ="width: 30%;">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td style ="word-break:break-all;"><?= h($user->username) ?></td>
                    <td><?= h($user->user_company) ?></td>
                    <td><?= h($user->user_contact) ?></td>
                    <td class="userStatus"><?php
                        $userStatus = $this->Number->format($user->user_status);
                        if ($userStatus == 0) {
                            echo "Not Activated";
                        } else {
                            echo "Activated";
                        }
                        ?></td>
                    <td class="actions">
                        <?php if ($user->user_id != 1) {
                            echo $this->Form->postLink(__('Activate'), ['action' => 'activate', $user->user_id], ['class' => 'btn btn-warning btnActivation']);
                            echo " ";
                            echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->user_id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $user->user_id)]);
                        } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        var userStatus;
        $(".btnActivation").each(function () {
            userStatus = $(this).parent().parent().find(".userStatus").html();
            if (userStatus === "Activated") {
                $(this).html("Deactivate");
            }
            else {
                $(this).html("Activate");
            }
        })
    });
</script>