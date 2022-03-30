<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pengumuman
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Pengumuman newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengumuman newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pengumuman query()
 * @mixin \Eloquent
 * @property int $pengumuman_id
 * @property string|null $judul
 * @property string|null $tanggal
 * @property int|null $rutin
 * @property int|null $aktif
 * @property string|null $isi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Pengumuman whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengumuman whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengumuman whereIsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengumuman whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengumuman wherePengumumanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengumuman whereRutin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengumuman whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pengumuman whereUpdatedAt($value)
 */
class Pengumuman extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "pengumuman";

    protected $primaryKey = "pengumuman_id";


}
