<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    /**
     * SERVICE ATTRIBUTES
     * $this->attributes['id'] - int - contains the service primary key (id)
     * $this->attributes['name'] - string - contains the service name
     * $this->attributes['description'] - string - contains the service description
     * $this->attributes['category'] - string - contains the service category
     * $this->attributes['image'] - string - contains the service image
     * $this->attributes['price'] - int - contains the service price
     * $this->attributes['created_at'] - timestamp - contains the order creation date
     * $this->attributes['updated_at'] - timestamp - contains the order update date
     * RELATIONS
     * $this->itemsService - ItemService[] - contains the associated items
     */
    public static function validate($request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'image' => 'image',
            'price' => 'required|numeric|gt:0',
        ]);
    }

    protected $fillable = ['name', 'description', 'category', 'image', 'price'];

    public static function sumPricesByQuantities($services, $servicesInSession): int
    {
        $total = 0;
        foreach ($services as $service) {
            $total += $service->getPrice() * $servicesInSession[$service->getId()];
        }

        return $total;
    }

    public function getId(): int
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription(string $description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getImage(): string
    {
        return $this->attributes['image'];
    }

    public function setImage(string $image): void
    {
        $this->attributes['image'] = $image;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice(int $price): void
    {
        $this->attributes['price'] = $price;
    }

    public function itemsService(): HasMany
    {
        return $this->hasMany(ItemService::class);
    }

    public function getItemsService()
    {
        return $this->itemsService()->get();
    }

    public function setItemsService($itemsService): void
    {
        $this->itemsService = $itemsService;
    }

    public function getCreatedAt(): string
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
}
