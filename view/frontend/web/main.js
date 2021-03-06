// 2017-02-05
define([
	'Df_StripeClone/main', 'https://bridge.paymill.com/'
], function(parent) {'use strict';
/** 2017-09-06 @uses Class::extend() https://github.com/magento/magento2/blob/2.2.0-rc2.3/app/code/Magento/Ui/view/base/web/js/lib/core/class.js#L106-L140 */	
return parent.extend({
	// 2017-02-06
	// Cardholder name is mandatory for PAYMILL Bridge:
	// https://developers.paymill.com/guides/reference/bridge#2-creating-a-token
	defaults: {df: {card: {requireCardholder: true}}},
	/**
	 * 2017-02-05
	 * 1) Which bank card networks does Paymill support? https://mage2.pro/t/2646
	 * 2) The bank card network codes: https://mage2.pro/t/2647
	 * @override
	 * @see Df_Payment/main::getCardTypes()
	 * @used-by https://github.com/mage2pro/core/blob/3.9.12/Payment/view/frontend/web/template/card/fields.html#L4
	 * @returns {String[]}
	 */
	getCardTypes: function() {return ['VI', 'MC', 'AE', 'JCB', 'DI', 'DN'];},
	/**
	 * 2017-02-07
	 * https://developers.paymill.com/guides/introduction/payment-form#1-collecting-credit-card-data
	 * https://developers.paymill.com/guides/introduction/getting-started#create-a-token
	 * @override
	 * @see Df_Payment/card::initialize()
	 * https://github.com/mage2pro/core/blob/2.4.21/Payment/view/frontend/web/card.js#L77-L110
	 * @returns {exports}
	*/
	initialize: function() {
		this._super();
		window.PAYMILL_PUBLIC_KEY = this.publicKey();
		return this;
	},
    /**
	 * 2017-02-16
	 * @override
	 * @see Df_StripeClone/main::tokenCheckStatus()
	 * https://github.com/mage2pro/core/blob/2.7.9/StripeClone/view/frontend/web/main.js?ts=4#L8-L15
	 * @used-by Df_StripeClone/main::placeOrder()
	 * https://github.com/mage2pro/core/blob/2.7.9/StripeClone/view/frontend/web/main.js?ts=4#L75
	 * @param {*} status
	 * @returns {Boolean}
	 */
	tokenCheckStatus: function(status) {return !status;},
    /**
	 * 2017-02-16
	 * @override
	 * @see https://github.com/mage2pro/core/blob/2.0.11/StripeClone/view/frontend/web/main.js?ts=4#L21-L29
	 * @used-by Df_StripeClone/main::placeOrder()
	 * https://github.com/mage2pro/core/blob/2.7.9/StripeClone/view/frontend/web/main.js?ts=4#L73
	 * @param {Object} params
	 * @param {Function} callback
	 */
	tokenCreate: function(params, callback) {paymill.createToken(params, callback);},
    /**
	 * 2017-02-16
	 * https://developers.paymill.com/guides/reference/bridge#2-creating-a-token
	 * @override
	 * @see https://github.com/mage2pro/core/blob/2.0.11/StripeClone/view/frontend/web/main.js?ts=4#L31-L39
	 * @used-by placeOrder()
	 * @param {Object|Number} status
	 * @param {Object} resp
	 * @returns {String}
	 */
	tokenErrorMessage: function(status, resp) {return status.message;},
    /**
	 * 2017-02-16
	 * Пример response при успешном получении токена:
	 * {
	 *		bin: "401288"
	 *		,binCountry: "DE"
	 *		,brand: "VISA"
	 *		,ip: "80.147.111.188"
	 *		,ipCountry: ""
	 *		,last4Digits: "1881"
	 *		,token: "tok_48b61d2a802477e42dde2ad9874e"
	 * }
	 * @override
	 * @see https://github.com/mage2pro/core/blob/2.0.11/StripeClone/view/frontend/web/main.js?ts=4#L41-L48
	 * @used-by placeOrder()
	 * @param {Object} resp
	 * @returns {String}
	 */
	tokenFromResponse: function(resp) {return resp.token;},
    /**
	 * 2017-02-16
	 * https://developers.paymill.com/guides/reference/transactions#direct-tokenization
	 * @override
	 * @see Df_StripeClone/main::tokenParams()
	 * https://github.com/mage2pro/core/blob/2.7.9/StripeClone/view/frontend/web/main.js?ts=4#L42-L48
	 * @used-by Df_StripeClone/main::placeOrder()
	 * https://github.com/mage2pro/core/blob/2.7.9/StripeClone/view/frontend/web/main.js?ts=4#L73
	 * @returns {Object}
	 */
	tokenParams: function() {return {
		/**
		 * 2017-02-06 https://blog.paymill.com/en/clarification-on-amount-int/#content-wrapper
		 * 2017-02-07
		 * «Whether all the Paymill-supported currencies are 2-decimal or some currencies are zero-decimal?»
		 * https://mage2.pro/t/2675
		 * 2017-11-05
		 * «A payment's amount could be changed client-side (e.g., on a discount code application),
		 * and `amount_int: this.amountF()` will produce a wrong result in such case»
		 * https://github.com/mage2pro/paymill/issues/3
		 */
		amount_int: this.amountF()
		,cardholder: this.cardholder()
		,currency: this.paymentCurrency().code
		,cvc: this.creditCardVerificationNumber()
		,exp_month: this.creditCardExpMonth()
		,exp_year: this.creditCardExpYear()
		,number: this.creditCardNumber()
	};},
	/**
	 * 2017-02-07
	 * @override
	 * @see https://github.com/mage2pro/core/blob/1.12.12/Payment/view/frontend/web/card.js?ts=4#L131-L139
	 * @used-by https://github.com/mage2pro/core/blob/1.12.12/Payment/view/frontend/web/card.js?ts=4#L127
	 */
	prefillWithAFutureData: function() {
		this._super();
		if (this.config('errorCardNumber') === this.creditCardNumber()) {
			// 2017-02-07
			// https://developers.paymill.com/guides/reference/testing#how-do-i-test-credit-card-specific-error-codes-
			this.creditCardExpYear(2020);
		}
	},
});});