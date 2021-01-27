<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Announcement[]|\Cake\Collection\CollectionInterface $announcement
 */
?>
<div id="content">
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <?= $this->Html->link('+ New Announcement', ['action' => 'add'], ['class' => 'createLinks btn btn-success btn-lg']) ?>
    </ul>
</nav>
<div class="announcement index large-9 medium-8 columns content">
    <h3><?= __('Announcement') ?></h3>
    <?= $this->Flash->render() ?>
    <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col" style="width: 20%">Title</th>
                <th scope="col" style="width: 30%">Content</th>
                <th scope="col" style="width: 20%">File</th>
                <th scope="col" style="width: 15%">Date</th>
                <th scope="col" class="actions" style="width: 15%"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($announcements as $announcement): ?>
            <tr>
                <td><?= h($announcement->announcement_title) ?></td>
                <td><?= h($announcement->announcement_content) ?></td>
                <td><?= h($announcement->announcement_file) ?>
                    <?php
                    if ($announcement->announcement_file) {
                        ?>
                        <a href="<?php echo $announcement->announcement_file_dir . $announcement->announcement_file; ?>">Download</a>
                        <?php
                    }
                    ?>
                </td>
                <td>
                    <?php echo $announcement; ?>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $announcement->announcement_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $announcement->announcement_id], ['confirm' => __('Are you sure you want to delete # {0}?', $announcement->announcement_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
