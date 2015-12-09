<?php
namespace Hautelook;

class Cart
{
    protected $subtotal;
    protected $products;
    protected $modifier;
    protected $totalWeight;
    protected $shipping;
    protected $total;

    public function __construct() {
        $this->modified = 1; // 100% modifier for discounted products
        $this->subtotal = 0;
        $this->shipping = 0;
        $this->total = 0;
        $this->totalWeight = 0;
        $this->products = ['items' => []];
    }

    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function addItem($price, $itemName = '', $weight = 1, $qty = 1) {
        if (!empty($price) && ($price >= 0)) {
            // Generate a fake name just in case.
            $itemName = '' ? mb_strtolower('item' . rand(0, 10000)) : mb_strtolower($itemName);
            $this->products['items'][$itemName] = ['price' => $price, 'weight' => $weight];
            if (!empty($this->products['items'][$itemName]['qty'])) {
                $this->products['items'][$itemName]['qty'] = 1;
            } else {
                $this->products['items'][$itemName]['qty'] += 1;
            }
            $this->addSubtotal($price);
        } else {
            throw new \Exception('Price cannot be null or less than 0.', 998);
        }

        return $this->products;
    }

    public function applyCoupon($coupon, $item = [], $global = false) {
        if (!empty($coupon) && ((int)$coupon <= 100 && (int)$coupon >= 0)) {
            if (!$global) {
                if (!empty($item)) {
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
                    throw new \Exception("Item cannot be empty when not applying a global discount.", 995);
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

        if (!empty($products['items'])) {
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
        }

        $this->products['shipping'] = $this->shipping;
        $this->products['total_weight'] = $this->totalWeight;

        return $this->shipping; // Return $this->products if front-end is handling all the pretty calculations.
    }

    public function getCartContents() {
        return $this->products;
    }

    public function getTotal() {
        $this->calculateShipping();
        $this->total = $this->subtotal + $this->shipping;

        return $this->total;
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
