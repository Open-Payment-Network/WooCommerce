(function () {
    const settings = window.wc.wcSettings.getSetting(
        'paymentnetwork_data',
        {}
    );

    const label = window.wp.htmlEntities.decodeEntities(
        settings.title || 'HandePay'
    );

    const Content = function () {
        return window.wp.element.createElement(
            'div',
            {
                className: 'wc-payment-network-description'
            },
            window.wp.htmlEntities.decodeEntities(
                settings.description || ''
            )
        );
    };

    window.wc.wcBlocksRegistry.registerPaymentMethod({
        name: 'paymentnetwork',
        label: label,
        content: window.wp.element.createElement(Content),
        edit: window.wp.element.createElement(Content),
        canMakePayment: function () {
            return true;
        },
        ariaLabel: label,
        supports: {
            features: settings.supports || ['products']
        }
    });
})();