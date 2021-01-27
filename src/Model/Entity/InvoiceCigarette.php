<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InvoiceCigarette Entity
 *
 * @property int $invoice_cigarette_id
 * @property string $cigarette_brand
 * @property string $cigarette_size
 * @property string $cigarette_flavor
 * @property float $packet_price
 * @property int $packet_from_shop
 * @property int $packet_from_warehouse
 * @property float $carton_price
 * @property int $carton_from_shop
 * @property int $carton_from_warehouse
 * @property int $invoice_id
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Order $order
 */
class InvoiceCigarette extends Entity
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
        'cigarette_brand' => true,
        'cigarette_size' => true,
        'cigarette_flavor' => true,
        'packet_price' => true,
        'packet_from_shop' => true,
        'packet_from_warehouse' => true,
        'carton_price' => true,
        'carton_from_shop' => true,
        'carton_from_warehouse' => true,
        'invoice_id' => true,
        'client' => true,
        'order' => true
    ];
}
