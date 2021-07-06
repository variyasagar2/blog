<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        "title",
        "user_id",
        "image",
        "tags",
        "description"
    ];

    protected $attributes = [
        "image" => null
    ];
    protected $filepath = 'images/';

    public function setImageAttribute($value)
    {


        $fileName = time() . '.' . $value->extension();

        $value->move(public_path($this->filepath), $fileName);
        if ($this->attributes['image'] != null) {
            \File::delete('public/' . $this->attributes['image']);
//                if(Fil)
        }
        $this->attributes['image'] = $this->filepath . $fileName;
//        dd($value, $this->attributes);
    }


    public function getImageAttribute()
    {
        return asset('public/' . $this->attributes['image']);
    }

    public function getDescriptionShortAttribute()
    {
        $desc = $this->attributes['description'];
        if (strlen($desc) > 100) {
            return substr($desc, 0, 100) . "...";

        }
        return $desc;
    }

    public function getHashTagAttribute()
    {
        $tags = $this->attributes['tags'];
        $tags = explode(',', $tags);
        return $tags;
    }

}
