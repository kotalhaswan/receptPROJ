<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['name','origin','ingredients','instructions'];

    public function user():BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

}
