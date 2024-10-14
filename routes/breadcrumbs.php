<?php

use App\Models\Course;
use App\Models\User;
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

Breadcrumbs::for("teachers.index")
    ->push("Home", route("home"))
    ->push("Teachers", route("teachers.index"));

Breadcrumbs::for("teachers.show")
    ->push("Home", route("home"))
    ->callback(function (Trail $trail, User $teacher) {
        return $trail->push($teacher->name, route("teachers.show", ["teacher" => $teacher->id]));
    });
