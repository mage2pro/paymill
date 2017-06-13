// 2017-02-05
define([
	'Df_StripeClone/main', 'https://bridge.paymill.com/'
], function(parent) {'use strict'; return parent.extend({
	// 2017-02-06
	// Cardholder name is mandatory for PAYMILL Bridge:
	// https://developers.paymill.com/guides/reference/bridge#2-creating-a-token
	defaults: {df: {card: {requireCardholder: true}}},
	/**
	 * 2017-02-05
	 * Which bank card networks does Paymill support? https://mage2.pro/t/2646
	 * The bank card network codes: https://mage2.pro/t/2647
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
	 * @returns {Object}
	*/
	initialize: function() {
		this._super();
		window.PAYMILL_PUBLIC_KEY = this.publicKey();
		return this;
	},
    /**
	 * 2017-02-16
	 * @override
	 * @see https://github.com/mage2pro/core/blob/2.0.11/StripeClone/view/frontend/web/main.js?ts=4#L12-L19
	 * @used-by placeOrder()
	 * @param {Object|Number} status
	 * @returns {Boolean}
	 */
	tokenCheckStatus: function(status) {return !status;},
    /**
	 * 2017-02-16
	 * @override
	 * @see https://github.com/mage2pro/core/blob/2.0.11/StripeClone/view/frontend/web/main.js?ts=4#L21-L29
	 * @used-by placeOrder()
	 * @param {Object} params
	 * @param {Function} callback
	 * @returns {Function}
	 */
	tokenCreate: function(params, callback) {return paymill.createToken(params, callback);},
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
	 * https://github.com/mage2pro/core/blob/2.7.8/StripeClone/view/frontend/web/main.js?ts=4#L42-L48
	 * @used-by Df_StripeClone/main::placeOrder()
	 * https://github.com/mage2pro/core/blob/2.7.8/StripeClone/view/frontend/web/main.js?ts=4#L73
	 * @returns {Object}
	 */
	tokenParams: function() {return {
		// 2017-02-06
		// https://blog.paymill.com/en/clarification-on-amount-int/#content-wrapper
		// 2017-02-07
		// Whether all the Paymill-supported currencies are 2-decimal
		// or some currencies are zero-decimal?
		// https://mage2.pro/t/2675
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