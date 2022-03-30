<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Kontak
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contact query()
 * @mixin \Eloquent
 * @property int $contact_id
 * @property string|null $label
 * @property string|null $icon
 * @property string|null $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contact whereUpdatedAt($value)
 */
class Contact extends Model
{

    use HasFactory;

    protected $guarded = [];

    protected $table = "contact";

    protected $primaryKey = "contact_id";


}
