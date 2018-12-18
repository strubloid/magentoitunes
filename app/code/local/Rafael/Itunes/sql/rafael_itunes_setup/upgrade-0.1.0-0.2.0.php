<?php

try
{

    $installer = $this;

    $installer->startSetup();

    // loading the table name by the rafael_itunes module
    $tablename = $installer->getTable('rafael_itunes/album');

    // loading the new table instance
    $itunesAlbum = $installer->getConnection()->newTable($tablename);

    // creating the table structure
    $itunesAlbum->addColumn(
        'id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'identity' => true,
            'nullable' => false,
        ),
        'Magento Album ID'

    )->addColumn(
        'collectionId', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'nullable' => false,
            'primary'  => true,
        ),
        'Album ID from Itunes'

    )->addColumn(
        'artistId', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'nullable' => false,
            'primary'  => true,
        ),
        'FK to artistId on Itunes_Artist'

    )->addColumn(
        'collectionName', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
        array(
            'nullable'  => false,
        ),
        'Itunes album name'

    )->addColumn(
        'artworkUrl100', Varien_Db_Ddl_Table::TYPE_TEXT, 300,
        array(
            'nullable'  => false,
        ),
        'Itunes album cover image'

    )->addColumn(
        'currency', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,
        array(
            'nullable'  => false,
        ),
        'Itunes album currency'

    )->addColumn(
        'collectionPrice', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4',
        array(
            'nullable'  => false,
            'default'   => '0.0000',
        ),
        'Itunes album price'
    )->addColumn(
        'trackCount', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'nullable'  => false,
        ),
        'Itunes album track count'
    )->addIndex($installer->getIdxName('rafael_itunes/artist', array('id','collectionId', 'artistId')),
        array('id','collectionId', 'artistId')
    )->addIndex($installer->getIdxName('rafael_itunes/artist', array('id')),
        array('id')
    )->addIndex($installer->getIdxName('rafael_itunes/artist', array('collectionId')),
        array('collectionId')
    )->addIndex($installer->getIdxName('rafael_itunes/artist', array('artistId')),
        array('artistId')
    )->addForeignKey($installer->getFkName('rafael_itunes/album', 'artistId', 'rafael_itunes/artist', 'artistId'),
        'artistId',
        $installer->getTable('rafael_itunes/artist'),
        'artistId',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE
    );

    if (!$installer->getConnection()->isTableExists($itunesAlbum->getName())) {
        $installer->getConnection()->createTable($itunesAlbum);
    }

} catch (Exception $exception) {

    Mage::log($exception->getMessage(),null, 'setup-exceptions.log', true);

} finally {

    $installer->endSetup();
}


