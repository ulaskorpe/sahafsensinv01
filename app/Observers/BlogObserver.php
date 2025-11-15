<?php

namespace App\Observers;
use App\Models\Blog;
class BlogObserver
{
    public function saved(Blog $blog){
        // if($blog->isDirty('slug')){
        //     if(!empty($blog->getOriginal('id'))){
        //         rename('files/blogs/'.$blog->getOriginal('slug'),'files/blogs/'.$blog['slug']);
        //     }
        //     //  Log::channel('data_check')->info($blog->getOriginal('id').">>".$blog['id']);
        // }
    }
}
