<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class productPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, ?Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        foreach ($user->role->permissions as $p) {
            if ($p->permission=="add product") {
                return true;
            }
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        $c=false;
        foreach ($user->role->permissions as $p) {
            if ($p->permission=="update all products") {
                $c=true;
            }
        }

        return $c || $user->id == $product->seller_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        $c=false;
        foreach ($user->role->permissions as $p) {
            if ($p->permission=="delete all products") {
                $c=true;
            }
        }

        return $c || $user->id == $product->seller_id;    
    }

 
}
