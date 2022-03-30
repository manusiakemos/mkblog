<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KategoriBerita
 *
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBerita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBerita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBerita query()
 * @mixin \Eloquent
 * @property int $kategori_id
 * @property string|null $nama
 * @property int|null $aktif
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBerita whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBerita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBerita whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBerita whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|KategoriBerita whereUpdatedAt($value)
 */
class KategoriBerita extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "kategori_berita";

    protected $primaryKey = "kategori_id";

}
