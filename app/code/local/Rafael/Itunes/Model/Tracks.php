<?php
/**
 * Model class of Itunes Track.
 * User: strubloid
 */ 
class Rafael_Itunes_Model_Tracks extends Mage_Core_Model_Abstract
{
    /**
     * Method that will load the first 20 items from tracks collection.
     *
     * @param $request
     * @return mixed
     */
    public function loadTracks($request)
    {
        // loading the core resource
        $coreResource = Mage::getSingleton('core/resource');

        // getting the reading connection
        $dbConex = $coreResource->getConnection('core_read');

        $limit = $request->getParam('rowCount');
        $offset = ($request->getParam('current') - 1) * $limit;

        // mounting the query, binding the data with ?
        $select = $dbConex->select()
            ->from(
                array(
                    'artist' => $coreResource->getTableName('rafael_itunes/artist')
                ),
                new Zend_Db_Expr('artist.artistName')
            )->join(
                array('album' => $coreResource->getTableName('rafael_itunes/album')),
                'artist.artistId = album.artistId',
                new Zend_Db_Expr('album.collectionName, album.artworkUrl100')
            )->joinLeft(
                array('track' => $coreResource->getTableName('rafael_itunes/track')),
                'album.collectionId = track.collectionId',
                new Zend_Db_Expr('track.trackName, track.trackNumber, track.trackPrice')
            )
            ->limit($limit, $offset);

        // adding the sort of this select
        if($sort = $request->getParam('sort'))
        {
            $select->order(implode( ' ', array(key($sort), $sort[key($sort)])));
        }

        // loading the results for the jquery bootgrid
        $arrayCollection['rows'] = $dbConex->fetchAll($select);
        $arrayCollection['current'] = (int) $request->getParam('current');
        $arrayCollection['total'] = (int) current($dbConex->fetchRow($dbConex->select()->from(array('track' => $coreResource->getTableName('rafael_itunes/track')),new Zend_Db_Expr('count(*) as count'))));

        // getting the data
        return $arrayCollection;
    }
}