<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Berita
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $user_id
 * @property int|null $kategori_id
 * @property string|null $judul
 * @property string|null $url
 * @property string|null $gambar
 * @property string|null $isi
 * @property int|null $hit
 * @property int|null $aktif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereHit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @property int $berita_id
 * @property-read \App\Models\Category|null $kategori
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereBeritaId($value)
 * @property int $post_id
 * @property int|null $category_id
 * @property string|null $title
 * @property string|null $image
 * @property string|null $content
 * @property int|null $active
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 */
class Post extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "post";

    protected $primaryKey = "post_id";

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "user_id");
    }

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id", "category_id");
    }
}
