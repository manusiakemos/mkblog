<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Gallery
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery query()
 * @mixin \Eloquent
 * @property int $gallery_id
 * @property string|null $judul
 * @property string|null $keterangan
 * @property string|null $slug
 * @property string|null $filename
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereGalleryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Gallery whereUpdatedAt($value)
 */
class Gallery extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "gallery";

    protected $primaryKey = "gallery_id";


}
