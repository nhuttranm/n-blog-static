<?php

return [
    'production' => false,
    'baseUrl' => '',
    'selected' => function ($page, $section) {
        return str_contains($page->getPath(), $section) ? 'selected' : '';
    },
    'collections' => [
        'posts' => [
            'extends' => '_layouts.posts',
            'items' => function () {
                $posts = json_decode(file_get_contents('http://n-blog.local/api/posts'));
                return collect($posts->data)->map(function ($post) {
                    return [
                        'id' => $post->id,
                        'title' => $post->title,
                        'slug' => $post->slug,
                        'content' => $post->body,
                        'tags' => $post->tags,
                        'meta' => $post->meta
                    ];
                });
            },
            'path' => 'blog/{slug}'
        ],
    ],
];
