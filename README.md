## Coding Task - Inventory Management

Simple product inventory system and pricing engine example.

- Products have title, description, price, and category.
- Certain categories have fixed percentage discounts
- Certain categories have fixed value discounts
- Certain customers have additional percentage discount rules, for the purpose of a coding test these will be fixed.
    - Customer has no discount
    - Wholesale has an additional 20%

# Notes

- Product prices are displayed in GBP using Brick\Money.
- Product prices and calculations are stored as minor units to avoid floating point precision issues.
- Products have been added with a minimum price of £20 and categories will have no value of more than £10 to discount. Minimal protection has been used to prevent discounts making items negative.
- We are doing a simple round to the nearest penny in the PercentageDiscountType class.
- The 'Your Price' column of the inventory table shows the total discounted price for the logged in user.
- I initially created a super simple pricing engine but then refactored to use contracts and separate classes to handle different discount types. This was to demonstrate a more extensible solution
  than the original task scope.
- There are a number of improvements which I would have liked to make, but keeping it to a less complex solution for the purpose of the coding task.
    - I would have liked to make would be the ability to see which discounts ran on the product and the value before and after rather than just a calculated price.

# Setup

I have used [DDEV](https://ddev.com/) to manage the local development environment. Please see their documentation for installation instructions.

**Please run the following scripts:**

- ddev start
- ddev npm install
- ddev npm run build
- ddev composer install
- ddev artisan migrate:fresh --seed
- ddev launch

**Running Tests:**

- ddev exec pest

**Login details for testing are:**

- **User:** customer@example.com | **Password:** password
- **User:** wholesale@example.com | **Password:** password
