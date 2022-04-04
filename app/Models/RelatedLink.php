<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LinkTerkait
 *
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedLink query()
 * @mixin \Eloquent
 * @property int $related_link_id
 * @property string|null $label
 * @property string|null $url
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedLink whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedLink whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedLink whereLinkTerkaitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedLink whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RelatedLink whereRelatedLinkId($value)
 */
class RelatedLink extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "related_link";

    protected $primaryKey = "related_link_id";


}
