<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pengumuman
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement query()
 * @mixin \Eloquent
 * @property int $announcement_id
 * @property string|null $judul
 * @property string|null $tanggal
 * @property int|null $rutin
 * @property int|null $aktif
 * @property string|null $isi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereAktif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereIsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement wherePengumumanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereRutin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereTanggal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereUpdatedAt($value)
 * @property string|null $title
 * @property string|null $date
 * @property int|null $repeat
 * @property int|null $active
 * @property string|null $content
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereAnnouncementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereRepeat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Announcement whereTitle($value)
 */
class Announcement extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "announcement";

    protected $primaryKey = "announcement_id";


}
