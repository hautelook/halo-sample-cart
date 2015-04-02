Feature: A sample e-commerce shopping cart that is similar to what NordstromRack.com | HauteLook uses in production.

  Scenario: Add a 10 dollar item to an empty cart
    Given I have an empty cart
     When I add a $10 item named "shirt"
     Then My subtotal should be $10

  Scenario: Add an item twice
    Given I have a cart with a $5 item named "tee"
     When I add a $5 item named "tee"
     Then My quantity of products named "tee" should be 2

  Scenario: Add a 10 dollar item to a cart with a 5 dollar item
    Given I have a cart with a $5 item named "tee"
     When I add a $10 item named "shirt"
     Then My subtotal should be $15

  Scenario: Apply a 10 percent coupon code to a cart with 10 dollars of items
    Given I have a cart with a $10 item named "shirt"
     When I apply a 10% coupon code
     Then My subtotal should be $9

  Scenario: Add a 2nd item to a cart after applying a discount
    Given I have an empty cart
     When I add a $10 item named "tank"
      And I apply a 10% coupon code
      And I add a $30 item named "dress"
     Then My subtotal should be $36

  Scenario: When order is under $100, and all items under 10 lb, then shipping is $5 flat
    Given I have an empty cart
     When I add a $78 2 lb item named "dress"
      And I add a $20 1 lb item named "skirt"
     Then My subtotal should be $98
      And My total should be $103

  Scenario: When order is $100 or more, and each individual item is under 10 lb, then shipping is free
    Given I have an empty cart
     When I add a $68 2 lb item named "dress"
      And I add a $20 1 lb item named "skirt"
      And I add a $20 1 lb item named "skirt"
     Then My subtotal should be $108
      And My total should be $108
      And My quantity of products named "skirt" should be 2

  Scenario: Items over 10 lb always cost $20 each to ship
    Given I have an empty cart
     When I add a $80 2 lb item named "dress"
      And I add a $10 1 lb item named "tee"
      And I add a $50 100 lb item named "couch"
     Then My subtotal should be $140
      And My total should be $160

  Scenario: Orders under $100 with 2 items over 10 lb should be $45 in shipping
    Given I have an empty cart
     When I add a $10 1 lb item named "tee"
      And I add a $25 15 lb item named "lamp"
      And I add a $50 25 lb item named "end table"
     Then My subtotal should be $85
      And My total should be $130
