<?php
class Canalweb_LimitCompare_Helper_Observer extends Mage_Catalog_Model_Product_Compare_List
{

    function getLimitNumber()
    {
        /* The limit you want, fetched from back-office conf. */
        return Mage::getStoreConfig('compare/limit/number');
    }

    function limitProductCompare($event)
    {
        if (Mage::helper('catalog/product_compare')->getItemCount() < static::getLimitNumber()) return;

        $session = Mage::getSingleton('catalog/session');
        Mage::getSingleton('catalog/product_compare_list')->removeProduct($event->getProduct());

        $session->getMessages()->clear();
        Mage::getSingleton('core/session')->addError(Mage::helper('limitCompare')->__('You can not compare more than %s products at once. Remove one and try again.', static::getLimitNumber()));
    }
}
