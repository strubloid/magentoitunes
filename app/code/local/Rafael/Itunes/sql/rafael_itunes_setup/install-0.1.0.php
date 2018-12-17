<?php

try
{

    $installer = $this;

    $installer->startSetup();

    // loading the table name by the rafael_itunes module
    $tablename = $installer->getTable('rafael_itunes/tracks');

    // loading the new table instance
    $itunesTracks = $installer->getConnection()->newTable($tablename);

    // creating the table structure
    $itunesTracks->addColumn(
        'id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true,
        ),
        'Itunes ID into magento structure'

    )->addColumn(
        'itunes_trackId', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
        array(
            'nullable'  => false,
        ),
        'Itunes track ID from the API'

    )->addColumn(
        'itunes_artistname', Varien_Db_Ddl_Table::TYPE_TEXT, 300,
        array(
            'nullable'  => false,
        ),
        'Artist Name'

    )->addColumn(
        'itunes_albumname', Varien_Db_Ddl_Table::TYPE_TEXT, 300,
        array(
            'nullable'  => false,
        ),
        'Album Name'
    )->addColumn(
        'itunes_trackname', Varien_Db_Ddl_Table::TYPE_TEXT, 300,
        array(
            'nullable'  => false,
        ),
        'Track Name'
    )->addColumn(
        'itunes_trackprice', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4',
        array(
            'nullable'  => false,
            'default'   => '0.0000',
        ),
        'Price of this track'
    )->addColumn(
        'itunes_image_30', Varien_Db_Ddl_Table::TYPE_TEXT, 2000,
        array(
            'nullable'  => false,
        ),
        'Image size 30x30'
    )->addColumn(
        'itunes_image_60', Varien_Db_Ddl_Table::TYPE_TEXT, 2000,
        array(
            'nullable'  => false,
        ),
        'Image size 60x60'
    )->addColumn(
        'itunes_image_100', Varien_Db_Ddl_Table::TYPE_TEXT, 2000,
        array(
            'nullable'  => false,
        ),
        'Image size 100x100'
    );

    if (!$installer->getConnection()->isTableExists($itunesTracks->getName())) {
        $installer->getConnection()->createTable($itunesTracks);
    }

} catch (Exception $exception) {

    Mage::log($exception->getMessage(),null, 'setup-exceptions.log', true);

} finally {

    $installer->endSetup();
}


