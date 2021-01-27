<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Announcement Entity
 *
 * @property int $announcement_id
 * @property string $announcement_title
 * @property string $announcement_content
 * @property string|null $announcement_file
 * @property string|null $announcement_file_dir
 */
class Announcement extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'announcement_title' => true,
        'announcement_content' => true,
        'announcement_file' => true,
        'announcement_file_dir' => true,
        'announcement_date' => true
    ];
}
