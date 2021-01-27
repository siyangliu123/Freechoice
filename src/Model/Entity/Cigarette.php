<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cigarette Entity
 *
 * @property int $Cig_id
 * @property string $Cig_brand
 * @property string $Cig_flavor
 * @property string $Cig_size
 * @property float $Cig_packet_price
 * @property float $Cig_carton_price
 * @property string $Cig_company
 * @property int $Cig_warehouse_stock
 * @property int $Cig_shop_stock
 * @property string|null $Cig_packet_barcode
 * @property string|null $Cig_carton_barcode
 * @property int $Cig_packet_in_carton
 * @property float $Cig_retail_price
 * @property int $Cig_base_number
 */
class Cigarette extends Entity
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
        'Cig_brand' => true,
        'Cig_flavor' => true,
        'Cig_size' => true,
        'Cig_packet_price' => true,
        'Cig_carton_price' => true,
        'Cig_company' => true,
        'Cig_warehouse_stock' => true,
        'Cig_shop_stock' => true,
        'Cig_packet_barcode' => true,
        'Cig_carton_barcode' => true,
        'Cig_packet_in_carton' => true,
        'Cig_retail_price' => true,
        'Cig_base_number' => true
    ];
}
