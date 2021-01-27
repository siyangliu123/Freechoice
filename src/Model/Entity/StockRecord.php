<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * StockRecord Entity
 *
 * @property int $stock_record_id
 * @property string $stock_record_item
 * @property int $stock_location
 * @property int $stock_record_quantity
 * @property string $stock_record_date
 */
class StockRecord extends Entity
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
        'stock_record_item' => true,
        'stock_location' => true,
        'stock_record_quantity' => true,
        'stock_record_date' => true
    ];
}
