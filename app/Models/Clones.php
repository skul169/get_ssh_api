<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Brand
 *
 * @property integer $id
 * @property string $name
 * @property integer $logo_image_id
 * @property integer $display_order
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Image $logoImage
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Outlet[] $outlets
 */
class Clones extends Base
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clone';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid',
        'first',
        'last',
        'email',
        'pass',
        'cookie',
        'token',
        'sex',
        'birthday',
        'updated_at',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['deleted_at'];

    protected $dates  = ['deleted_at'];

    public function __construct()
    {
        parent::__construct();
    }

    // API Presentation

    public function toAPIArray()
    {
        $array = [
            'id'   => $this->id,
            'name' => $this->name,
        ];
        if (!empty($this->logoImage)) {
            $array['logoImageUrl'] = $this->logoImage->url;
        }
    }
}
