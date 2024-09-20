<?php namespace App\Models; 
use Illuminate\Database\Eloquent\Model; 
use App\Models\User; 
use App\Models\Item;

class OrderProduct extends Model { 
    
    /** 
     * ORDERPRODUCT ATTRIBUTES
     * $this->attributes['id'] - int - contains the order primary key (id) 
     * $this->attributes['total'] - string - contains the order name 
     * $this->attributes['user_id'] - int - contains the referenced user id 
     * $this->attributes['created_at'] - timestamp - contains the order creation date 
     * $this->attributes['updated_at'] - timestamp - contains the order update date 
     * $this->user - User - contains the associated User
     * $this->items - Item[] - contains the associated items 
     */ 
    
    public static function validate($request) 
    { 
        $request->validate([
            "total" => "required|numeric", 
            "user_id" => "required|exists:users,id", 
        ]); 
    } 

    public function getId() : string
    { 
        return $this->attributes['id']; 
    } 

    public function getTotal() : int
    { 
        return $this->attributes['total']; 
    } 
    
    public function setTotal(int $total) : void
    { 
        $this->attributes['total'] = $total; 
    } 

    public function getUserId() : string
    { 
        return $this->attributes['user_id']; 
    } 

    public function setUserId(string $userId) : void
    { 
        $this->attributes['user_id'] = $userId; 
    } 
    
    public function getCreatedAt() : timestamp 
    { 
        return $this->attributes['created_at']; 
    } 
    
    public function setCreatedAt($createdAt) : void
    { 
        $this->attributes['created_at'] = $createdAt; 
    } 

    public function getUpdatedAt() : timestamp
    { 
        return $this->attributes['updated_at']; 
    } 
    
    public function setUpdatedAt($updatedAt) : void
    { 
        $this->attributes['updated_at'] = $updatedAt; 
    } 
    
    public function user() : User
    { 
        return $this->belongsTo(User::class); 
    } 

    public function getUser() : User
    { 
        return $this->user; 
    } 

    public function setUser($user) : void
    { 
        $this->user = $user;
    } 

    public function itemsProduct() : ItemProduct
    { 
        return $this->hasMany(ProductItem::class); 
    } 
    
    public function getItemsProduct() : ItemProduct
    { 
        return $this->product_items; 
    } 
    
    public function setItemsProduct($product_items) : void 
    { 
        $this->product_items = $product_items; 
    } 
}