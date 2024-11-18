<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemService extends Model
{
    /**
     * ITEM SERVICE ATTRIBUTES
     * $this->attributes['id'] - int - contains the item primary key (id)
     * $this->attributes['quantity'] - int - contains the item quantity
     * $this->attributes['price'] - int - contains the item price
     * $this->attributes['order_service_id'] - int - contains the referenced order service id
     * $this->attributes['service_id'] - int - contains the referenced service id
     * $this->attributes['created_at'] - timestamp - contains the item creation date
     * $this->attributes['updated_at'] - timestamp - contains the item update date
     * RELATIONS
     * $this->orderService - OrderService - contains the associated OrderService
     * $this->service - Service - contains the associated Service
     */
    
    protected $table = 'service-items';

    public static function validate($request)
    {
        $request->validate([
            'price' => 'required|numeric|gt:0',
            'quantity' => 'required|numeric|gt:0',
            'service_id' => 'required|exists:services,id',
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

    public function getOrderServiceId(): int
    {
        return $this->attributes['order_id'];
    }

    public function setOrderServiceId(int $orderServiceId): void
    {
        $this->attributes['order_id'] = $orderServiceId;
    }

    public function getServiceId(): int
    {
        return $this->attributes['service_id'];
    }

    public function setServiceId(int $serviceId): void
    {
        $this->attributes['service_id'] = $serviceId;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    public function orderService(): BelongsTo
    {
        return $this->belongsTo(OrderService::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}