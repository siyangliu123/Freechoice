<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CigaretteFixture
 */
class CigaretteFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'cigarette';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'Cig_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'Cig_brand' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Cig_flavor' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Cig_size' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Cig_packet_price' => ['type' => 'decimal', 'length' => 6, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'Cig_carton_price' => ['type' => 'decimal', 'length' => 7, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'Cig_company' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Cig_warehouse_stock' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Cig_shop_stock' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Cig_packet_barcode' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Cig_carton_barcode' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Cig_packet_in_carton' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '10', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Cig_retail_price' => ['type' => 'decimal', 'length' => 6, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => ''],
        'Cig_base_number' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['Cig_id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'MyISAM',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'Cig_id' => 1,
                'Cig_brand' => 'Lorem ipsum dolor sit amet',
                'Cig_flavor' => 'Lorem ipsum dolor sit amet',
                'Cig_size' => 'Lorem ipsum dolor sit amet',
                'Cig_packet_price' => 1.5,
                'Cig_carton_price' => 1.5,
                'Cig_company' => 'Lorem ipsum dolor sit amet',
                'Cig_warehouse_stock' => 1,
                'Cig_shop_stock' => 1,
                'Cig_packet_barcode' => 'Lorem ipsum dolor sit amet',
                'Cig_carton_barcode' => 'Lorem ipsum dolor sit amet',
                'Cig_packet_in_carton' => 1,
                'Cig_retail_price' => 1.5,
                'Cig_base_number' => 1
            ],
        ];
        parent::init();
    }
}
