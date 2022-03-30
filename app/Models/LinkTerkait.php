<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\LinkTerkait
 *
 * @method static \Illuminate\Database\Eloquent\Builder|LinkTerkait newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkTerkait newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LinkTerkait query()
 * @mixin \Eloquent
 * @property int $link_terkait_id
 * @property string|null $label
 * @property string|null $url
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LinkTerkait whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkTerkait whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkTerkait whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkTerkait whereLinkTerkaitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkTerkait whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LinkTerkait whereUrl($value)
 */
class LinkTerkait extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "link_terkait";

    protected $primaryKey = "link_terkait_id";


}
