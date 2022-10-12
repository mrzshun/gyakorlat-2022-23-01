<?php

namespace App\Models;

// Post: id, userId, userName, title, text

class Blogpost {
    public static function all() {
        return [
            [
                'id' => '1',
                'userId' => '2',
                'userName' => 'Gipsz Jakab',
                'title' => 'Title text 1',
                'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s'
            ],
            [
                'id' => '2',
                'userId' => '2',
                'userName' => 'Gipsz Jakab',
                'title' => 'Title text 2',
                'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s'
            ],
            [
                'id' => '3',
                'userId' => '1',
                'userName' => 'Devenér Olga',
                'title' => 'Title text 3',
                'text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s'
            ]
        ];
    }

    public static function find($id){
        $blogposts = self::all();
        foreach($blogposts as $blogpost){
            if($blogpost['id'] == $id) return $blogpost;
        }
        return [];
    }
}

?>