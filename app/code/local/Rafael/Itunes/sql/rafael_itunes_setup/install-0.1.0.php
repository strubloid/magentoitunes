<?php

try
{
    $installer = $this;

    $installer->startSetup();

    // loading the table name by the rafael_itunes module
    $tablename = $installer->getTable('rafael_itunes/artist');

    // loading the new table instance
    $itunesArtist = $installer->getConnection()->newTable($tablename);

    // creating the table structure
    $itunesArtist->addColumn(
        'artistId', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'nullable' => false,
            'primary'  => true,
        ),
        'Itunes artist ID'

    )->addColumn(
        'artistName', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
        array(
            'nullable'  => false,
        ),
        'Itunes Artist Name'

    );

    if (!$installer->getConnection()->isTableExists($itunesArtist->getName())) {
        $installer->getConnection()->createTable($itunesArtist);
    }

} catch (Exception $exception) {

    Mage::log($exception->getMessage(),null, 'setup-exceptions.log', true);

} finally {

    $installer->endSetup();
}


