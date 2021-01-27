
<?php
echo $this->Html->css('announcementView');
?>
<div id="content">
    <br>
    <?= $this->Html->link(__('List Announcement'), ['action' => 'index'],['class' => 'createLinks btn btn-primary btn-lg']) ?>

    </ul>
    </nav>
    <div class="announcementForm">
        <?= $this->Form->create($announcement, ['type' => 'file']) ?>
        <h1><?= __('Edit Announcement') ?></h1>
        <table id="announcementTable" class="table table-hover table-bordered">
            <tr>
                <td><label for="announcement_title">Title</label></td>
                <td><?php echo $this->Form->control('announcement_title', ['label' => false, 'placeholder' =>   'Title']); ?></td>
            </tr>
            <tr>
                <td><label for="announcement_content">Content</label></td>
                <td><?php echo $this->Form->control('announcement_content', ['type' => 'textarea', 'placeholder' => 'Detail', 'label' => false, 'style' => 'width: 80%;']); ?></td>
            </tr>
            <tr>
                <td><label for="announcement_file">File</label></td>
                <td><?php echo $this->Form->control('announcement_file', ['type' => 'file', 'label' => false]); ?></td>
            </tr>
        </table>
        <br>
        <?= $this->Form->button(__('Submit'), ["class" => "btn btn-success btn-lg"] ) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

