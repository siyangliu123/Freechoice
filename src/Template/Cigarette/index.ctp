<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cigarette[]|\Cake\Collection\CollectionInterface $cigarette
 */
echo $this->Html->css('cigaretteView');

?>
<div id="content">
    <?= $this->Flash->render() ?>
    <br>
    <?= $this->Html->link('+ New Cigarette', ['action' => 'add'], ['class' => 'createLinks btn btn-success btn-lg']) ?>
    <div class="cigaretteForm">
        <h1>View Cigarette</h1>
        <table id="cigaretteTable" class="table table-hover table-bordered">
            <colgroup>
                <col width="30%" align="center">
                <col width="10%" align="center">
                <col width="20%" align="center">
                <col width="10%" align="center">
                <col width="10%" align="center">
                <col width="20%" align="center">
            </colgroup>
            <thead>
            <tr>
                <th scope="col">Brand</th>
                <th scope="col">Size</th>
                <th scope="col">Flavor</th>
                <th scope="col">Packet Price</th>
                <th scope="col">Carton Price</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody id="tableBody">
            <?php foreach ($cigarette as $cigarette): ?>
                <tr>
                    <td><?= h($cigarette->Cig_brand) ?></td>
                    <td><?= h($cigarette->Cig_size) ?></td>
                    <td><?= h($cigarette->Cig_flavor) ?></td>
                    <td><?= $this->Number->format($cigarette->Cig_packet_price) ?></td>
                    <td><?= $this->Number->format($cigarette->Cig_carton_price) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cigarette->Cig_id], ["class" => "btn btn-primary btn-md"]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cigarette->Cig_id], ["class" => "btn btn-danger", 'confirm' => __('Are you sure you want to delete # {0} {1} {2}?', $cigarette->Cig_brand, $cigarette->Cig_size, $cigarette->Cig_flavor)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


