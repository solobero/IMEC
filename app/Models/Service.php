<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    /**
     * service ATTRIBUTES
     * $this->attributes['id'] - int - contains the service primary key (id)
     * $this->attributes['name'] - string - contains the service name
     * $this->attributes['description'] - string - contains the service description
     * $this->attributes['category'] - string - contains the service description
     * $this->attributes['image'] - string - contains the service image
     * $this->attributes['price'] - int - contains the service price
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
            $total = $total + ($service->getPrice() * $servicesInSession[$service->getId()]);
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

    public function setName($name): void
    {
        $this->attributes['name'] = $name;
    }

    public function getDescription(): string
    {
        return $this->attributes['description'];
    }

    public function setDescription($description): void
    {
        $this->attributes['description'] = $description;
    }

    public function getImage(): string
    {
        return $this->attributes['image'];
    }

    public function setImage($image): void
    {
        $this->attributes['image'] = $image;
    }

    public function getPrice(): int
    {
        return $this->attributes['price'];
    }

    public function setPrice($price): void
    {
        $this->attributes['price'] = $price;
    }

    public function getCategory(): string
    {
        return $this->attributes['category'];
    }

    public function setCategory($category): void
    {
        $this->attributes['category'] = $category;
    }

    public function itemsService(): HasMany
    {
        return $this->hasMany(ItemService::class);
    }

    public function getItemsService()
    {
        return $this->service_items;
    }

    public function setItemsService($service_items)
    {
        $this->service_items = $service_items;
    }
}
