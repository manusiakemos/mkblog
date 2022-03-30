<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @mixin \Eloquent
 */
class Menu extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "menu";

    protected $primaryKey = "id";


}
