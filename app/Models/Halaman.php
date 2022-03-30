<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Halaman
 *
 * @property int $halaman_id
 * @property string|null $judul
 * @property int|null $custom
 * @property string|null $gambar
 * @property string|null $url
 * @property int|null $aktif
 * @property string|null $isi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman query()
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman whereCustom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman whereGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman whereHalamanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman whereIsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Halaman whereUrl($value)
 * @mixin \Eloquent
 */
class Halaman extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "halaman";

    protected $primaryKey = "halaman_id";


}
