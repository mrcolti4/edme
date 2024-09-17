<?php

use App\Models\Category;
use App\Models\Course;
use WireUi\Breadcrumbs\Breadcrumbs;
use WireUi\Breadcrumbs\Trail;

Breadcrumbs::for("categories.index")
    ->push("Home", route("home"));

Breadcrumbs::for("categories.show")
    ->push("Home", route("home"))
    ->push("Categories", route("categories.index"));

Breadcrumbs::for("courses.index")
    ->push("Home", route("home"));

Breadcrumbs::for("courses.show")
    ->push("Home", route("home"))
    ->push("Categories", route("categories.index"))
    ->callback(function (Trail $trail, Course $course) {
        return $trail->push($course->category->name, route("categories.show", ["category" => $course->category]))
            ->push($course->name, route("courses.show", ["course" => $course]));
    });
