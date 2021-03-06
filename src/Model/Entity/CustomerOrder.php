<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CustomerOrder Entity
 *
 * @property int $customer_order_id
 * @property string $customer_name
 * @property string $customer_contact
 * @property string $customer_order_detail
 */
class CustomerOrder extends Entity
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
        'customer_name' => true,
        'customer_contact' => true,
        'customer_order_detail' => true
    ];
}
