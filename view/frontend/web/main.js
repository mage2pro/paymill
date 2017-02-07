// 2017-02-05
define([
	'Df_Payment/card', 'https://bridge.paymill.com/'
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
	 * 2017-02-05
	 * @returns {Object}
	*/
	initialize: function() {
		this._super();
		return this;
	},
	/**
	 * 2017-02-05
	 * @override
	 * @see https://github.com/magento/magento2/blob/2.1.0/app/code/Magento/Checkout/view/frontend/web/js/view/payment/default.js#L127-L159
	 * @used-by https://github.com/magento/magento2/blob/2.1.0/lib/web/knockoutjs/knockout.js#L3863
	 * @param {this} _this
	*/
	placeOrder: function(_this) {
		if (this.validate()) {
			if (!this.isNewCardChosen()) {
				this.token = this.currentCard();
				this.placeOrderInternal();
			}
			else {
				// 2017-02-06
				// https://developers.paymill.com/guides/reference/transactions#direct-tokenization
				paymill.createToken(
					{
						// 2017-02-06
						// https://blog.paymill.com/en/clarification-on-amount-int/#content-wrapper
						amount_int: 4200
						,cardholder: this.cardholder()
						,currency: this.paymentCurrency().code
						,cvc: this.creditCardVerificationNumber()
						,exp_month: this.creditCardExpMonth()
						,exp_year: this.creditCardExpYear()
						,number: this.creditCardNumber()
					},
					/**
					 * 2017-02-06
					 * @param {Number} status
					 * @param {Object} response
					 */
					function(status, response) {
						debugger;
					}
				);
			}
		}
	}
});});