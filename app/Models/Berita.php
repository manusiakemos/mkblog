<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Berita
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Berita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Berita query()
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
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereHit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereIsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereUserId($value)
 * @property int $berita_id
 * @property-read \App\Models\KategoriBerita|null $kategori
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Berita whereBeritaId($value)
 */
class Berita extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "berita";

    protected $primaryKey = "berita_id";

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "user_id");
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, "kategori_id", "kategori_id");
    }
}
