<?php

namespace App\Helpers;

use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

class CartManagement {
    static public function addCartItemsToCookie($cart_items){
        Cookie::queue('cart_items', json_encode($cart_items), 60 * 24 * 30);
    }

    static public function clearCartItems(){
        Cookie::queue(Cookie::forget("cart_items"));
    }

    static public function getCartItemsFromCookie()
    {
        $cart_items = json_decode(Cookie::get('cart_items'), true);
        if(!$cart_items){
            $cart_items = [];
        }

        return $cart_items;
    }   

    static public function addItemToCart($product_id) {
        $cart_items = self::getCartItemsFromCookie();
    
        $existing_item = null;
    
        // Check if the product is already in the cart
        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                $existing_item = $key;
                break;
            }
        }
    
        // If the product is already in the cart, increase the quantity and recalculate the total
        if($existing_item !== null){
            $cart_items[$existing_item]['quantity']++;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['pro_price'];
        } else {
            // If the product is not in the cart, add it to the cart
            $product = Product::where('id', $product_id)->first(['id', 'pro_name', 'pro_price', 'pro_image_url']);
            if($product){
                $cart_items[] = [
                    'product_id' => $product_id,
                    'pro_name' => $product->pro_name,
                    'pro_price' => $product->pro_price,
                    'pro_image_url' => $product->pro_image_url,
                    'quantity' => 1,
                    'total_amount' => $product->pro_price * 1
                ];
            }
        }
    
        // Save the updated cart items back to the cookie
        self::addCartItemsToCookie($cart_items);
    
        return count($cart_items);
    }


    static public function addItemToCartWithQty($product_id, $qty) {
        $cart_items = self::getCartItemsFromCookie();
    
        $existing_item = null;
    
        // Check if the product is already in the cart
        foreach($cart_items as $key => $item){
            if($item['product_id'] == $product_id){
                $existing_item = $key;
                break;
            }
        }
    
        // If the product is already in the cart, increase the quantity and recalculate the total
        if($existing_item !== null){
            $cart_items[$existing_item]['quantity'] = $qty = 1;
            $cart_items[$existing_item]['total_amount'] = $cart_items[$existing_item]['quantity'] * $cart_items[$existing_item]['pro_price'];
        } else {
            // If the product is not in the cart, add it to the cart
            $product = Product::where('id', $product_id)->first(['id', 'pro_name', 'pro_price', 'pro_image_url']);
            if($product){
                $cart_items[] = [
                    'product_id' => $product_id,
                    'pro_name' => $product->pro_name,
                    'pro_price' => $product->pro_price,
                    'pro_image_url' => $product->pro_image_url,
                    'quantity' => $qty,
                    'total_amount' => $product->pro_price * $qty
                ];
            }
        }
    
        // Save the updated cart items back to the cookie
        self::addCartItemsToCookie($cart_items);
    
        return count($cart_items);
    }

    static public function removeCartItem( $product_id){
        $cart_items = self::getCartItemsFromCookie();

        foreach($cart_items as $key => $item){
            if($item['product_id']== $product_id){
                unset($cart_items[$key]);
            }
        }
        self::addCartItemsToCookie($cart_items);

        return $cart_items;
    }

    static public function incrementQuantity($product_id){
        $cart_items = self::getCartItemsFromCookie();

        foreach($cart_items as $key => $item){
            if($item["product_id"] === $product_id){
                $cart_items[$key]['quantity']++;
                $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]["pro_price"];
            }
        }
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }

    static public function decrementQuantity($product_id) {
        $cart_items = self::getCartItemsFromCookie();
    
        foreach($cart_items as $key => $item){
            if($item["product_id"] == $product_id){
                // Only decrement if the quantity is greater than 1
                if($cart_items[$key]['quantity'] > 1){
                    $cart_items[$key]['quantity']--;
                    $cart_items[$key]['total_amount'] = $cart_items[$key]['quantity'] * $cart_items[$key]["pro_price"];
                }
            }
        }
    
        self::addCartItemsToCookie($cart_items);
        return $cart_items;
    }


    static public function calculateTotal($items){
        return array_sum(array_column($items, 'total_amount'));
    }
}
