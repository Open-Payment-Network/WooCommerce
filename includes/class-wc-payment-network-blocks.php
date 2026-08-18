<?php

use Automattic\WooCommerce\Blocks\Payments\Integrations\AbstractPaymentMethodType;

final class WC_Payment_Network_Blocks extends AbstractPaymentMethodType
{
    protected $name = 'paymentnetwork';

    public function initialize()
    {
        $this->settings = get_option(
            'woocommerce_' . $this->name . '_settings',
            []
        );
    }

    public function is_active()
    {
        $gateways = WC()->payment_gateways()->payment_gateways();

        return isset($gateways[$this->name])
            && $gateways[$this->name]->is_available();
    }

    public function get_payment_method_script_handles()
    {
        wp_register_script(
            'wc-payment-network-blocks',
            plugins_url(
                '../assets/js/payment-network-blocks.js',
                __FILE__
            ),
            [
                'wc-blocks-registry',
                'wc-settings',
                'wp-element',
                'wp-html-entities',
            ],
            defined('WC_VERSION') ? WC_VERSION : '1.0.0',
            true
        );

        return ['wc-payment-network-blocks'];
    }

    public function get_payment_method_data()
    {
        return [
            'title'       => $this->get_setting(
                'title',
                'HandePay'
            ),
            'description' => $this->get_setting(
                'description',
                ''
            ),
            'supports'    => ['products'],
        ];
    }
}