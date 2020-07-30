# Magento 2 Customer Avatar
This is an awesome module, it allows the customers the opportunity to personalize their account by uploading an avatar.


## The features of this extension:
### Frontend:
- The customer can upload a new avatar.
- The avatar can be displayed in the header of the website.
- The avatar can be displayed in the reviews list.

### Backend:
- Display the avatar of the customer in the customer's grid of Magento Admin.
- Upload a new avatar or delete an avatar of the customer.

## Introduction installation:

### 1 - Using Composer

```
composer require landofcoder/magento2-customer-avatar:dev-master

```

### 2- Enable the Customer Avatar extension
 * php bin/magento setup:upgrade
 * php bin/magento setup:static-content:deploy
 * php bin/magento indexer:reindex
 * php bin/magento cache:flush

### 3 - See results
#### Frontend
Log into your customer account, go to Edit Account Information

##### The avatar in the header


##### The avatar in the edit account information


##### The avatar in the reviews list


#### Backend
Log into your Magento admin, go to Customers -> All Customers

##### The avatar in the customer's grid of Magento Admin


##### Upload a new avatar or delete an avatar of the customer


## Checkout more extensions
Please donate if you enjoy my extension.

https://landofcoder.com/magento/magento-2-extensions.html


