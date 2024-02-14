<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;


// Dashboard
Breadcrumbs::for('Databoard', function ($trail) {
    $trail->push('Trang chủ', route('dashboard.index'));
});


// Categories
Breadcrumbs::for('Categories', function ($trail) {
    $trail->push('Trang chủ', route('categories.index'));
});

// Categories > Create
Breadcrumbs::for('CategoriesCreate', function ($trail) {
    $trail->parent('Categories');
    $trail->push('Thêm danh mục', route('categories.create'));
});

// Categories > Edit > [Category]
Breadcrumbs::for('CategoriesEdit', function ($trail, $category) {
    $trail->parent('Categories');
    $trail->push('Sửa danh mục: ' . $category->title, route('categories.edit', $category));
});


// Banner
Breadcrumbs::for('Banner', function ($trail) {
    $trail->push('Trang chủ', route('banner.index'));
});

// Banner > Create
Breadcrumbs::for('BannerCreate', function ($trail) {
    $trail->parent('Banner');
    $trail->push('Thêm Banner', route('banner.create'));
});

// Banner > Edit > [Banner]
Breadcrumbs::for('BannerEdit', function ($trail, $banner) {
    $trail->parent('Banner');
    $trail->push('Sửa Banner: ' . $banner->title, route('banner.edit', $banner));
});



// Slide
Breadcrumbs::for('Slide', function ($trail) {
    $trail->push('Trang chủ', route('slide.index'));
});

// Slide > Create
Breadcrumbs::for('SlideCreate', function ($trail) {
    $trail->parent('Slide');
    $trail->push('Thêm Slide', route('slide.create'));
});

// Slide > Edit > [Slide]
Breadcrumbs::for('SlideEdit', function ($trail, $slide) {
    $trail->parent('Slide');
    $trail->push('Sửa Slide: ' . $slide->title, route('slide.edit', $slide));
});


// Post
Breadcrumbs::for('Post', function ($trail) {
    $trail->push('Trang chủ', route('post.index'));
});

// Post > Create
Breadcrumbs::for('PostCreate', function ($trail) {
    $trail->parent('Slide');
    $trail->push('Thêm tin tức', route('post.create'));
});

// Post > Edit > [Post]
Breadcrumbs::for('PostEdit', function ($trail, $post) {
    $trail->parent('Post');
    $trail->push('Cập nhật tin tức', route('post.edit', $post));
});


// groupPost
Breadcrumbs::for('groupPost', function ($trail) {
    $trail->push('Trang chủ', route('groupPost.index'));
});

// groupPost > Create
Breadcrumbs::for('groupPostCreate', function ($trail) {
    $trail->parent('groupPost');
    $trail->push('Thêm nhóm tin tức', route('groupPost.create'));
});

// groupPost > Edit > [groupPost]
Breadcrumbs::for('groupPostEdit', function ($trail, $post) {
    $trail->parent('groupPost');
    $trail->push('Cập nhật nhóm tin tức', route('groupPost.edit', $post));
});

// groupPost > listPost > [groupPost]
Breadcrumbs::for('groupPostListPost', function ($trail, $post) {
    $trail->parent('groupPost');
    $trail->push('Danh sách tin tức trong nhóm', route('groupPost.edit', $post));
});
