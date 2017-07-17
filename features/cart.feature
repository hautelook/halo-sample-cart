Feature: A sample e-commerce shopping cart that is similar to what NordstromRack.com | HauteLook uses in production.

Scenario: Empty cart subtotal
  Given I have an empty cart
  Then My subtotal should be "0" dollars

Scenario: Add a 10 dollar item to an empty cart
  Given I have an empty cart
  When I add a "10" dollar item named "shirt"
  Then My subtotal should be "10" dollars

Scenario: Add an item that already exists in the cart
  Given I have a cart with a "5" dollar item named "tee"
  When I add a "5" dollar item named "tee"
  Then My quantity of products named "tee" should be "2"

Scenario: Add an item twice should show quantity of 2
  Given I have an empty cart
  And I add a "100" dollar item named "jewelry"
  And I add a "5" dollar item named "belt"
  And I add a "100" dollar item named "jewelry"
  Then My quantity of products named "jewelry" should be "2"

Scenario: Add a 10 dollar item to a cart with a 5 dollar item
  Given I have a cart with a "5" dollar item named "tee"
  When I add a "10" dollar item named "shirt"
  Then My subtotal should be "15" dollars

Scenario: Apply a 10 percent coupon code to a cart with 10 dollars of items
  Given I have a cart with a "10" dollar item named "shirt"
  When I apply a "10" percent coupon code
  Then My subtotal should be "9" dollars

Scenario: Add a 2nd item to a cart after applying a discount
  Given I have an empty cart
  When I add a "10" dollar item named "tank"
  Then My subtotal should be "10" dollars
  And I apply a "10" percent coupon code
  And I add a "30" dollar item named "dress"
  Then My subtotal should be "36" dollars

Scenario: When order is under $100, and all items under 10 lb, then shipping is $5 flat
  Given I have an empty cart
  When I add a "78" dollar "2" lb item named "dress"
  And I add a "20" dollar "1" lb item named "skirt"
  Then My subtotal should be "98" dollars
  And My total should be "103" dollars

Scenario: When order is under $100, and all items are 10 lb or more, then flat rate should not be charged
  Given I have an empty cart
  When I add a "49" dollar "50" lb item named "dresser"
  When I add a "49" dollar "10" lb item named "indoor rug"
  Then My total should be "138" dollars

Scenario: When order is $100 or more, and each individual item is under 10 lb, then shipping is free
  Given I have an empty cart
  When I add a "68" dollar "2" lb item named "dress"
  And I add a "20" dollar "1" lb item named "skirt"
  And I add a "20" dollar "1" lb item named "skirt"
  Then My subtotal should be "108" dollars
  And My total should be "108" dollars
  And My quantity of products named "skirt" should be "2"

Scenario: Items that are 10 lb or more always cost $20 each to ship
  Given I have an empty cart
  When I add a "80" dollar "2" lb item named "dress"
  And I add a "10" dollar "1" lb item named "tee"
  And I add a "50" dollar "100" lb item named "couch"
  Then My subtotal should be "140" dollars
  And My total should be "160" dollars

Scenario: Orders under $100 with multiple items that are 10 lb or more
  Given I have an empty cart
  When I add a "10" dollar "1" lb item named "tee"
  And I add a "25" dollar "15" lb item named "lamp"
  And I add a "50" dollar "25" lb item named "end table"
  Then My subtotal should be "85" dollars
  And My total should be "130" dollars
