<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Menu
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $type
 * @property string|null $name
 * @property string|null $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu query()
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereUrl($value)
 * @mixin \Eloquent
 * @property string|null $label
 * @method static \Illuminate\Database\Eloquent\Builder|Menu whereLabel($value)
 */
class Menu extends Model
{
    use HasFactory;

    protected $table = "menu";

    protected $primaryKey = "id";

    public static $menuType = [
        [
            "id" =>  "link",
            "name" => "link",
        ],
        [
            "id" =>  "page",
            "name" => "page",
        ],
        [
            "id" =>  "fixed",
            "name" => "fixed",
        ],
        [
            "id" =>  "dropdown",
            "name" => "dropdown",
        ],
    ];

    public static $menuFixed = [
        [
            "id" =>  "post",
            "name" => "post",
        ],
        [
            "id" =>  "home",
            "name" => "home",
        ],
    ];
}
