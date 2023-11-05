<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    //public function getByLimit(int $limit_count = 10)
//{
    //updated_atで降順に並べたあと、limitで件数制限をかける
    //return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
//}

    protected $fillable=[
        'title',
        'body',
        'prefecture',
        'city',
        'after_address',
        'image_url',
        'user_id',
        'category_id',
    ];
    
    public function user(){
        return $this -> belongsTo(User::class);
    }
    
    public function category(){
        return $this -> belongsTo(Category::class);
    }
}
