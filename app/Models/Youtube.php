<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Youtube
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Youtube newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Youtube newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Youtube query()
 * @mixin \Eloquent
 * @property int $youtube_id
 * @property string|null $judul
 * @property string $embed
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Youtube whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Youtube whereEmbed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Youtube whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Youtube whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Youtube whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Youtube whereYoutubeId($value)
 * @property string|null $title
 * @property string|null $desc
 * @method static \Illuminate\Database\Eloquent\Builder|Youtube whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Youtube whereTitle($value)
 */
class Youtube extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "youtube";

    protected $primaryKey = "youtube_id";


}
