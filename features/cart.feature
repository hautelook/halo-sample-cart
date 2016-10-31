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
  And I add a "100" dollar item named "jewerly"
  And I add a "5" dollar item named "belt"
  And I add a "100" dollar item named "jewerly"
  Then My quantity of products named "jewerly" should be "2"

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

##############
#Added  
##############
Scenario: [Added] Just changed items of this scenario. > When order is $100 or more, and each individual item is more than 10 lb, then cost $20 each to ship
  Given I have an empty cart
  When I add a "1000" dollar "1" lb item named "iPhone 7"
  And I add a "1000" dollar "1" lb item named "iPhone 7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "25" lb item named "iMac 27-inch Core i5"
  And I add a "2000" dollar "25" lb item named "iMac 27-inch Core i5"
  Then My subtotal should be "8000" dollars
  And My total should be "8040" dollars
  And My quantity of products named "MacBook Pro 15-inch Core i7" should be "1"
  And My quantity of products named "iMac 27-inch Core i5" should be "2"

Scenario: [Added] Shipping is free no matter how heavy the total weight is (101 lb.), As far as following this rule. > When order is $100 or more, and each individual item is under 10 lb, then shipping is free
  Given I have an empty cart
  When I add a "1000" dollar "1" lb item named "iPhone 7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  Then My subtotal should be "41000" dollars
  And My total should be "41000" dollars
  And My quantity of products named "MacBook Pro 15-inch Core i7" should be "20"

Scenario: [Added] Items with extremely high cost and weight
  Given I have an empty cart
  When I add a "150000000" dollar "43340" lb item named "Lockheed Martin F-22 Raptor"
  And I add a "150000000" dollar "43340" lb item named "Lockheed Martin F-22 Raptor"
  And I add a "150000000" dollar "43340" lb item named "Lockheed Martin F-22 Raptor"
  And I add a "150000000" dollar "43340" lb item named "Lockheed Martin F-22 Raptor"
  And I add a "150000000" dollar "43340" lb item named "Lockheed Martin F-22 Raptor"
  And I add a "150000000" dollar "43340" lb item named "Lockheed Martin F-22 Raptor"
  And I add a "150000000" dollar "43340" lb item named "Lockheed Martin F-22 Raptor"
  And I add a "150000000" dollar "43340" lb item named "Lockheed Martin F-22 Raptor"
  And I add a "150000000" dollar "43340" lb item named "Lockheed Martin F-22 Raptor"
  And I add a "150000000" dollar "43340" lb item named "Lockheed Martin F-22 Raptor"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "98000000" dollar "29098" lb item named "Lockheed Martin F-35 Lightning II"
  And I add a "90000000" dollar "3132301" lb item named "SpaceX Falcon Heavy"
  And I add a "90000000" dollar "3132301" lb item named "SpaceX Falcon Heavy"
  And I add a "90000000" dollar "3132301" lb item named "SpaceX Falcon Heavy"
  And I add a "90000000" dollar "3132301" lb item named "SpaceX Falcon Heavy"
  And I add a "90000000" dollar "3132301" lb item named "SpaceX Falcon Heavy"
  And I add a "10440000000" dollar "200000000" lb item named "Gerald R. Ford-class aircraft carrier"
  Then My subtotal should be "14350000000" dollars
  And My total should be "14350000720" dollars
  And My quantity of products named "Lockheed Martin F-22 Raptor" should be "10"
  And My quantity of products named "Lockheed Martin F-35 Lightning II" should be "20"
  And My quantity of products named "SpaceX Falcon Heavy" should be "5"
  And My quantity of products named "Gerald R. Ford-class aircraft carrier" should be "1"

Scenario: [Added] Price and weight with fractions
  Given I have an empty cart
  When I add a "10.10" dollar "1.10" lb item named "tee"
  And I add a "25.20" dollar "15.20" lb item named "lamp"
  And I add a "50.30" dollar "25.20" lb item named "end table"
  Then My subtotal should be "85.60" dollars
  And My total should be "130.60" dollars

Scenario: [Added] Price and weight with long fractional digits. Subtotal and total are rounded to two decimal places.
  Given I have an empty cart
  When I add a "10.09999" dollar "1.1011111" lb item named "tee"
  And I add a "25.201111" dollar "15.2022222" lb item named "lamp"
  And I add a "50.29501111" dollar "25.203333" lb item named "end table"
  Then My subtotal should be "85.60" dollars
  And My total should be "130.60" dollars

Scenario: [Added] Very small orders
  Given I have an empty cart
  When I add a "0.50" dollar "0.05" lb item named "Gum"
  And I add a "0.25" dollar "0.02" lb item named "Candy"
  And I add a "0.25" dollar "0.02" lb item named "Candy"
  Then My subtotal should be "1" dollars
  And My total should be "6" dollars

Scenario: [Added] Same items with different prices and weight
  Given I have an empty cart
  When I add a "1000" dollar "1" lb item named "iPhone 7"
  And I add a "1100" dollar "1.1" lb item named "iPhone 7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2100" dollar "25" lb item named "iMac 27-inch Core i5"
  And I add a "2200" dollar "26" lb item named "iMac 27-inch Core i5"
  Then My subtotal should be "8400" dollars
  And My total should be "8440" dollars
  And My quantity of products named "iPhone 7" should be "2"
  And My quantity of products named "MacBook Pro 15-inch Core i7" should be "1"
  And My quantity of products named "iMac 27-inch Core i5" should be "2"

Scenario: [Added] Negative price means discount or payment to the buyer (coupon, refund)
  Given I have an empty cart
  When I add a "1000" dollar "1" lb item named "iPhone 7"
  And I add a "1000" dollar "1" lb item named "iPhone 7"
  And I add a "2000" dollar "5" lb item named "MacBook Pro 15-inch Core i7"
  And I add a "2000" dollar "25" lb item named "iMac 27-inch Core i5"
  And I add a "-1000" dollar item named "Special discount coupon"
  And I add a "-2000" dollar item named "Refund : iMac 27-inch Core i5"
  Then My subtotal should be "3000" dollars
  And My total should be "3020" dollars
  And My quantity of products named "MacBook Pro 15-inch Core i7" should be "1"
  And My quantity of products named "iMac 27-inch Core i5" should be "1"
  
Scenario: [Added] Shipping fee rule also applied to items with negative prices.(Using discount coupon is just regarded as 'purchase with negative price')
  Given I have an empty cart
  When I add a "-10" dollar item named "Special discount coupon"
  And I add a "-10" dollar item named "Special discount coupon"
  Then My subtotal should be "-20" dollars
  And My total should be "-15" dollars
  And My quantity of products named "Special discount coupon" should be "2"

Scenario: [Added] Negative percent coupon means price increase
  Given I have an empty cart
  When I add a "1000" dollar "1" lb item named "iPhone 7 Jet Black - very rare"
  Then I apply a "-10" percent coupon code
  Then My subtotal should be "1100" dollars
  
Scenario: [Added] Shipping fee rule also applied to free items(0 dollars) without weight.
  Given I have an empty cart
  When I add a "0" dollar item named "Free account"
  And I add a "0" dollar item named "Free account"
  Then My subtotal should be "0" dollars
  And My total should be "5" dollars
  And My quantity of products named "Free account" should be "2"
  
Scenario: [Added] $20 shipping fee applied even after refund.
  Given I have an empty cart
  When I add a "78" dollar "2" lb item named "dress"
  And I add a "20" dollar "1" lb item named "skirt"
  And I add a "2000" dollar "25" lb item named "iMac 27-inch Core i5"
  And I add a "-2000" dollar item named "Refund : iMac 27-inch Core i5"
  Then My subtotal should be "98" dollars
  And My total should be "123" dollars  
  
Scenario: [Added] Customer's payment can be avoided by issuing shipping fee refund. (negative price)
  Given I have an empty cart
  When I add a "0" dollar item named "Free account"
  And I add a "0" dollar item named "Free account"
  And I add a "-5" dollar item named "Shipping fee refund"
  Then My subtotal should be "-5" dollars
  And My total should be "0" dollars
  And My quantity of products named "Free account" should be "2"

Scenario: [Added] If order is under $100 with negative price (for example, $1000 -$1000), this rule is applicable. > When order is under $100, and all items under 10 lb., then shipping is $5 flat
  Given I have an empty cart
  When I add a "78" dollar "2" lb item named "dress"
  And I add a "20" dollar "1" lb item named "skirt"
  And I add a "1000" dollar "1" lb item named "iPhone 7"
  And I add a "-1000" dollar item named "Refund : iPhone 7"
  Then My subtotal should be "98" dollars
  And My total should be "103" dollars

Scenario: [Added] Applying a price and discount with long fractional digits. (13 digits) Total and subtotal will be rounded. 
  Given I have an empty cart
  When I add a "999.999999999" dollar item named "tank"
  Then My subtotal should be "1000" dollars
  And I apply a "33.33333333333" percent coupon code
  And I add a "2999.999999999" dollar item named "dress"
  Then My subtotal should be "2666.67" dollars
  And My total should be "2666.67" dollars

Scenario: [Added] Throws InvalidArgumentException when the subtotal exceeded 13 digits after adding an item
  Given I have an empty cart
  When I add a "2649890000000" dollar item named "GDP of United Kingdom"
  And I add a "2649890000000" dollar item named "GDP of United Kingdom"
  And I add a "2649890000000" dollar item named "GDP of United Kingdom"
  And I add a "2649890000000" dollar item named "GDP of United Kingdom", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
   
Scenario: [Added] Order with non-numeric price, non-numeric weight or empty product name throws InvalidArgumentException
  Given I have an empty cart  
  When I add a "Free is free." dollar "Account doesnt have weight." lb item named "Free account", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
  When  I add a "10" dollar "No weight." lb item named "Not-free account", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
  When  I add a "This is free anyway." dollar "0" lb item named "Free account", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
  When  I add a "10" dollar "5" lb item named "", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
  
Scenario: [Added] Check number of fractional digits of valid given value.
  When Numberic value is "0.123", number of fractional digits is "3"
  When Numberic value is "123", number of fractional digits is "0"
  When Numberic value is "123.456", number of fractional digits is "3"
  When Numberic value is "0.1234567890123", number of fractional digits is "13"
  When Numberic value is "1234567890123", number of fractional digits is "0"
  When Numberic value is "-0.1234567890123", number of fractional digits is "13"
  When Numberic value is "-1234567890123", number of fractional digits is "0"

Scenario: [Added] Attempt to check number of fractional digits of invalid given value and throws InvalidArgumentException (For NumberUtils::getNumberOfFractionalDigits)
  When Numberic value is "abc", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
  When Numberic value is "abc123", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
  When Numberic value is "123abc", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
  When Numberic value is "123,456", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
  When Numberic value is "192.168.0.1", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
  When Numberic value is "12345678901234", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
  When Numberic value is "1234567890123.4", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
  When Numberic value is "0.12345678901234", throws InvalidArgumentException
  Then InvalidArgumentException Occured: "yes"
 