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
