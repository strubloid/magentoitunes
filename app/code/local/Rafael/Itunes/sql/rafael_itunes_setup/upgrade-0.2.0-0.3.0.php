<?php

try
{

    $installer = $this;

    $installer->startSetup();

    // loading the table name by the rafael_itunes module
    $tablename = $installer->getTable('rafael_itunes/track');

    // loading the new table instance
    $itunesTrack = $installer->getConnection()->newTable($tablename);

    // creating the table structure
    $itunesTrack->addColumn(
        'id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'identity' => true,
            'nullable' => false,
        ),
        'Magento Track ID'

    )->addColumn(
        'trackId', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'nullable' => false,
            'primary'  => true,
        ),
        'Track ID from Itunes'

    )->addColumn(
        'collectionId', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'nullable' => false,
            'primary'  => true,
        ),
        'FK to collectionId on Itunes_Album'

    )->addColumn(
        'collectionName', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
        array(
            'nullable'  => false,
        ),
        'Itunes album name from the API'

    )->addColumn(
        'trackName', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
        array(
            'nullable'  => false,
        ),
        'Itunes track name from the API'

    )->addColumn(
        'trackPrice', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4',
        array(
            'nullable'  => false,
            'default'   => '0.0000',
        ),
        'Itunes track price from the API'
    )->addColumn(
        'trackNumber', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'nullable' => false,
        ),
        'Itunes track number sequence from the API'
    )->addColumn(
        'currency', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
        array(
            'nullable'  => false,
        ),
        'Itunes track currency from the API'

    )->addIndex($installer->getIdxName('rafael_itunes/track', array('id', 'trackId', 'collectionId')),
        array('id', 'trackId', 'collectionId')
    )->addIndex($installer->getIdxName('rafael_itunes/track', array('id')),
        array('id')
    )->addIndex($installer->getIdxName('rafael_itunes/track', array('trackId')),
        array('trackId')
    )->addIndex($installer->getIdxName('rafael_itunes/track', array('collectionId')),
        array('collectionId')
    )->addForeignKey($installer->getFkName('rafael_itunes/track', 'collectionId', 'rafael_itunes/album', 'collectionId'),
        'collectionId',
        $installer->getTable('rafael_itunes/album'),
        'collectionId',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    );

    if (!$installer->getConnection()->isTableExists($itunesTrack->getName())) {
        $installer->getConnection()->createTable($itunesTrack);
    }

} catch (Exception $exception) {

    Mage::log($exception->getMessage(),null, 'setup-exceptions.log', true);

} finally {

    $installer->endSetup();
}


