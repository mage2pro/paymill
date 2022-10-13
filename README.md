The module integrates a Magento 2 based webstore with the **[Paymill](https://www.paymill.com)** payment service.  
The module is **free** and **open source**.

## Screenshots
### 1. Frontend. The payment form
![](https://mage2.pro/uploads/default/original/2X/2/2f9eabe9c2420606e9316cea917f9210876fce7e.png)

![](https://mage2.pro/uploads/default/original/2X/0/08287f77e94626e8720c7ed9b6fa684a133573f3.png)

### 2. Backend. The extension's settings
![](https://mage2.pro/uploads/default/original/2X/c/cb381083de2b229fcf749b0d980f1ab548309c86.png)

## Demo videos

1. [**Capture** a card payment](https://mage2.pro/t/2732).
2. [**Authorize** a card payment, and **capture** it from the **Magento** side](https://mage2.pro/t/2733).
3. [**Authorize** a card payment, and **void** it from the **Magento** side](https://mage2.pro/t/2737).
4. [Partial and multiple **refunds** from the **Magento** side](https://mage2.pro/t/2739).
5. [**Capture** a card payment with the **3D Secure** verification](https://mage2.pro/t/2740).
6. [Capture and refund a card payment from the **Paymill** side (using a **webhook**)](https://mage2.pro/t/2752).

## How to install
[Hire me in Upwork](https://www.upwork.com/fl/mage2pro), and I will: 
- install and configure the module properly on your website
- answer your questions
- solve compatiblity problems with third-party checkout, shipping, marketing modules
- implement new features you need 

### 2. Self-installation
```
bin/magento maintenance:enable
rm -f composer.lock
composer clear-cache
composer require mage2pro/paymill:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy -f en_US <additional locales, e.g.: de_DE>
bin/magento maintenance:disable
```

## How to update
```
bin/magento maintenance:enable
composer remove mage2pro/paymill
rm -f composer.lock
composer clear-cache
composer require mage2pro/paymill:*
bin/magento setup:upgrade
bin/magento cache:enable
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
rm -rf pub/static/*
bin/magento setup:static-content:deploy -f en_US <additional locales, e.g.: de_DE>
bin/magento maintenance:disable
```