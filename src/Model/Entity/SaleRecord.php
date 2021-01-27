<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SaleRecord Entity
 *
 * @property int $record_id
 * @property string $record_date
 * @property int $record_item
 * @property int $record_sold_quantity
 */
class SaleRecord extends Entity
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
        'record_date' => true,
        'record_item' => true,
        'record_sold_quantity' => true
    ];
}
