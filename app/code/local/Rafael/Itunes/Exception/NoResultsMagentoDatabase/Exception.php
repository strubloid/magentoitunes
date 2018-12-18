<?php
/**
 * Exception that will be thrown if a request from  magento database and came without any results.
 *
 * Class Rafael_Itunes_Exception_NoResultsMagentoDatabase_Exception
 */
class Rafael_Itunes_Exception_NoResultsMagentoDatabase_Exception extends Mage_Core_Exception
{
    /**
     * Rewriting constructor to be able to set a message for this exception.
     *
     * Rafael_Itunes_Exception_MissingSearchParam_Exception constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setMessage("Try to type another artist, this is missing from our database.");
    }


}