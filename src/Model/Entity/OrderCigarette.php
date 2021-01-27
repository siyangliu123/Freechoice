<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderCigarette Entity
 *
 * @property int $order_cigarette_id
 * @property int $order_id
 * @property int $cigarette_id
 * @property float $packet_price
 * @property int $packet_quantity
 * @property float $carton_price
 * @property int $carton_quantity
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Cigarette $cigarette
 */
class OrderCigarette extends Entity
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
        'order_id' => true,
        'cigarette_id' => true,
        'packet_price' => true,
        'packet_quantity' => true,
        'carton_price' => true,
        'carton_quantity' => true,
        'order' => true,
        'cigarette' => true
    ];
}
