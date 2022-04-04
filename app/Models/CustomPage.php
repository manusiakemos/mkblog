<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\CustomPage
 *
 * @property int $custom_page_id
 * @property string|null $title
 * @property string|null $url
 * @property string|null $content
 * @property int|null $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage query()
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereCustomPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CustomPage whereUrl($value)
 * @mixin \Eloquent
 */
class CustomPage extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "custom_page";

    protected $primaryKey = "custom_page_id";


}
