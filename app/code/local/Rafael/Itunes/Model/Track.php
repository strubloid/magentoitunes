<?php
/**
 * Entity class for Itunes_Track Table.
 *
 * Class Rafael_Itunes_Model_Track
 */
class Rafael_Itunes_Model_Track extends Mage_Core_Model_Abstract
{

    protected function _construct()
    {
        $this->_init('rafael_itunes/track');
    }

    /**
     * Method that will create a data array to insert or
     * update data.
     *
     * @param $data
     * @return array
     */
    private function _buildData($data)
    {
        return array(
            'trackId' => $data['trackId'],
            'collectionId' => $data['collectionId'],
            'collectionName' => $data['collectionName'],
            'trackName' => $data['trackName'],
            'trackPrice' => $data['trackPrice'],
            'trackNumber' => $data['trackNumber'],
            'currency' => $data['currency'],
        );
    }

    /**
     * Method that will persist a data into a Itunes Tracks table.
     *
     * @param $data
     * @return string
     * @throws Mage_Core_Exception
     */
    public function persistData($data)
    {
        try
        {
            $data = $this->_buildData($data);

            // searching for the id into magento system
            $trackObject = $this->load($data['trackId'], 'trackId');

            // loading ID
            $id = $trackObject->getId();

            // checking if it will update or create a new record on it
            if(!empty($id))
            {
                $this->load($id)->addData($data)->setId($id)->save();
                return 'Updated';
            } else {
                $this->setData($data)->save();
                return 'Created';
            }

        } catch (Exception $exception) {

            throw Mage::exception('Rafael_Itunes_Exception_CantCreateTrack', $data['trackName']);

        }
    }

}