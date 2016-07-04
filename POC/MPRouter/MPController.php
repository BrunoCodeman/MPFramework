<?php 

class MPController
{
    private $mptools;
    private $config;
    function __construct($mptools)
    {
        $config_file = file_get_contents('views.json');
        $this->config = json_decode($config_file, true);
        $this->mptools = $mptools;
    }

    function getAdminView($checkoutType)
    {
        $file = $this->config['admin'][$checkoutType];
        return require $file;
    }

    function getBuyerView($checkoutType)
    {
        return require $this->config['buyer'][$checkoutType];
    }
}