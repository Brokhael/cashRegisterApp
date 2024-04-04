# Cash Register 💰🛒
This project implements a simple cash register that can add productos to a cart and calculate the total price of the purchase, following certain pricing rules.
## Project description:
### The cash register consists of the following main classes:

- **Product**: Represents a product with a unique code, name and price
- **PricingRules**: Contains the pricing rules applied to the products:
  - BOGOF: Buy one, get one free
  - Volume Discount:
    - Constants are used to determine the prices in special cases
    - For strawberries if you have 3 or more the price of each of them is reduced to 4.50 instead of 5
    - For coffee if you have 3 or more the price of each coffee is reduced to 2/3 of the original price.
- **Cart**: Represents the shopping cart where the products are added
- **CashRegister**: Manages the process of scanning products, and calculating the total price of the purchase

## Project Structure:

- **Entity**: contains  the `Product` entity
- **Service**: contains the `PricingRules`, `Cart` and `CashRegister` classes

## How to run the project:
1. Clone the project ```git clone https://github.com/Brokhael/cashRegisterApp.git```
2. Install Composer dependencies ```composer install```
3. Run the unit tests: ```php vendor\bin\phpunit tests ```

## Technical Requirements
- PHP 8.0 or higher
- Composer