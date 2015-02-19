<?php

class PushON_VarnishFix_Helper_Core_Url extends Mage_Core_Helper_Url {
    
    //removing 8080 from URL to stop page redirecting to home when a user removes a product from basket
    public function getCurrentUrl() {
        $request = Mage::app()->getRequest();
        $port = $request->getServer('SERVER_PORT');
        if ($port) {
            $defaultPorts = array(
                Mage_Core_Controller_Request_Http::DEFAULT_HTTP_PORT,
                Mage_Core_Controller_Request_Http::DEFAULT_HTTPS_PORT
            );
            $port = (in_array($port, $defaultPorts)) ? '' : ':' . $port;
        }
        $url = $request->getScheme() . '://' . $request->getHttpHost() . $port . $request->getServer('REQUEST_URI');
        return str_replace(':8080', '', $url);
    }

}
