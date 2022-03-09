<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','image','comercio_id'];

    public function products()
    {
    	return $this->hasMany(Product::class);
    }

    public function getImagenAttribute()
	{
        if($this->image != null)
        {
		if(file_exists('storage/categorias/' . $this->image))
			return $this->image;
		else
			return 'noimg.jpg';
        } else {
            return 'noimg.jpg';
        }
	}


}
