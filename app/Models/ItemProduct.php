<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemProduct extends Model
{
    /**
     * ITEM ATTRIBUTES
     * $this->attributes['id'] - int - contains the item primary key (id)
     * $this->attributes['quantity'] - int - contains the item quantity
     * $this->attributes['price'] - int - contains the item price
     * $this->attributes['order_product_id'] - int - contains the referenced order product id
     * $this->attributes['product_id'] - int - contains the referenced product id
     * $this->attributes['created_at'] - timestamp - contains the item creation date
     * $this->attributes['updated_at'] - timestamp - contains the item update date
     * $this->order - OrderProduct - contains the associated OrderProduct
     * $this->product - Product - contains the associated Product
     */
    protected $table = 'product-items';

    public static function validate($request)
    {
        $request->validate([
            'price' => 'required|numeric|gt:0',
            'quantity' => 'required|numeric|gt:0',
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',

        ]);
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getQuantity(): int
    {
        return $this->attributes['quantity'];
    }

    public function setQuantity(int $quantity): void
    {
        $this->attributes['quantity'] = $quantity;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getOrderProductId(): int
    {
        return $this->attributes['order_id'];
    }

    public function setOrderProductId(int $orderProductId): void
    {
        $this->attributes['order_id'] = $orderProductId;
    }

    public function getProductId(): int
    {
        return $this->attributes['product_id'];
    }

    public function setProductId(int $productId): void
    {
        $this->attributes['product_id'] = $productId;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    public function orderProduct(): BelongsTo
    {
        return $this->belongsTo(OrderProduct::class);
    }

    public function getOrderProduct(): OrderProduct
    {
        return $this->product_orders;

    }

    public function setOrderProduct(OrderProduct $orderProduct): void
    {
        $this->orderProduct = $orderProduct;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}
