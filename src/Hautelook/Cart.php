<?php
namespace Hautelook;

class Cart
{
    protected $subtotal;
    protected $products = array();
    protected $modifier;
    protected $totalWeight;
    protected $shipping;

    public function __construct() {
        $this->modified = 1; // 100% modifier for discounted products
        $this->subtotal = 0;
        $this->shipping = 0;
        $this->totalWeight = 0;
    }

    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function addItem($itemName, $price, $weight) {
        if (!empty($itemName) && !empty($price) && !empty($weight)) {
            $this->products['items'][mb_strtolower($itemName)] = ['price' => $price, 'weight' => $weight];
            $this->addSubtotal($price);
        } else {
            throw new \Exception('itemName and itemPrice cannot be null.', 998);
        }

        return $this->products;
    }

    public function applyCoupon($item, $coupon, $global = false) {
        if (!empty($item) && !empty($coupon) && ((int)$coupon <= 100 && (int)$coupon >= 0)) {
            if (!$global) {
                if (array_key_exists(mb_strtolower($item), $this->products)) {
                    $percentDiscount = $coupon / 100;
                    $discount = 1;
                    $discount = $discount - $percentDiscount;
                    $this->products[mb_strtolower($item)]['price'] *= $discount;
                    $item['discount'] = 100 - ($discount * 100);
                } else {
                    throw new \Exception('No such item in cart.');
                }
            } else {
                // This is a global coupon for every product
                $this->modifier = $this->modifier - ($coupon / 100);

                foreach ($this->products['items'] as $key => $item) {
                    $item['price'] *= $this->modifier;
                    $item['discount'] += 100 - ($this->modifier * 100);
                    $this->products['global_discount'] = 100 - ($this->modifier * 100);
                }
            }
        } else {
            throw new \Exception('Coupon and item cannot be null or empty. Coupons cannot be less than 0 or greater than 100%', 997);
        }

        return $this->products;
    }

    public function calculateShipping() {
        $overweight = false;
        $this->shipping = 5;
        foreach ($this->products['items'] as $item) {
            if ($item['weight'] > 10) {
                $overweight = true;
                $this->shipping += 10;
            }

            $this->totalWeight += $item['weight'];
        }

        if (!$overweight) {
            if ($this->subtotal > 100) {
                $this->shipping = 0;
            }
        }

        $this->products['shipping'] = $this->shipping;
        $this->products['total_weight'] = $this->totalWeight;

        return $this->shipping; // Return $this->products if front-end is handling all the pretty calculations.
    }

    private function addSubtotal($price) {
        if (!empty($price) && is_numeric($price)) {
            $this->subtotal += (float)$price;
            $this->products['subtotal'] = $this->subtotal;
        } else {
            throw new \Exception('Price cannot be numeric when adding subtotals.', 999);
        }
    }
}
