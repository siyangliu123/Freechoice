<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Announcement[]|\Cake\Collection\CollectionInterface $announcement
 */
?>
<div id="content">
    <div class="announcement index large-6 medium-6 columns content" style="margin-bottom: 50px;">
        <h3><?= __('View Announcements') ?></h3>
        <?= $this->Flash->render() ?>
        <table cellpadding="0" cellspacing="0" class="table table-hover table-bordered" style="margin:auto; width: 90%;">
            <thead>
            <tr>
                <th scope="col" style="width: 20%">Title</th>
                <th scope="col" style="width: 60%">Content</th>
                <th scope="col" style="width: 20%">File</th>
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
                            <a href="<?php echo "/".$announcement->announcement_file_dir . $announcement->announcement_file; ?>">Download</a>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
