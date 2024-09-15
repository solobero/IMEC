<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * USER ATTRIBUTES 
     * $this->attributes['id'] - int - contains the user primary key (id)
     * $this->attributes['name'] - string - contains the user name 
     * $this->attributes['email'] - string - contains the user email 
     * $this->attributes['email_verified_at'] - timestamp - contains the user email verification date 
     * $this->attributes['password'] - string - contains the user password 
     * $this->attributes['remember_token'] - string - contains the user password 
     * $this->attributes['role'] - string - contains the user role (client or admin) 
     * $this->attributes['balance'] - int - contains the user balance 
     * $this->attributes['created_at'] - timestamp - contains the user creation date 
     * $this->attributes['updated_at'] - timestamp - contains the user update date
    */
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
    ];

    // Getter and Setter for name
    public function getName(): string
    {
        return $this->attributes['name'];
    }

    public function setName(string $name): void
    {
        $this->attributes['name'] = $name;
    }

    // Getter and Setter for email
    public function getEmail(): string
    {
        return $this->attributes['email'];
    }

    public function setEmail(string $email): void
    {
        $this->attributes['email'] = $email;
    }

    // Getter and Setter for email_verified_at
    /** 
    public function getEmailVerifiedAt(): ?string
    {
        return $this->attributes['email_verified_at'];
    }

    public function setEmailVerifiedAt(?string $emailVerifiedAt): void
    {
        $this->attributes['email_verified_at'] = $emailVerifiedAt;
    }
    */

    // Getter and Setter for password
    public function getPassword(): string
    {
        return $this->attributes['password'];
    }

    public function setPassword(string $password): void
    {
        $this->attributes['password'] = $password;
    }

    // Getter and Setter for remember_token
    /** 
    public function getRememberToken(): ?string
    {
        return $this->attributes['remember_token'];
    }

    public function setRememberToken(?string $rememberToken): void
    {
        $this->attributes['remember_token'] = $rememberToken;
    }
    */

    // Accessor for role
    public function getRoleAttribute(): string
    {
        return $this->attributes['role'];
    }

    // Mutator for role
    public function setRoleAttribute(string $role): void
    {
        $this->attributes['role'] = $role;
    }

    // Getter and Setter for balance
    public function getBalance(): int
    {
        return $this->attributes['balance'];
    }

    public function setBalance(int $balance): void
    {
        $this->attributes['balance'] = $balance;
    }

    // Getter and Setter for created_at
    public function getCreatedAt(): ?string
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt): void
    {
        $this->attributes['created_at'] = $createdAt;
    }

    // Getter and Setter for updated_at
    public function getUpdatedAt(): ?string
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt): void
    {
        $this->attributes['updated_at'] = $updatedAt;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
