<?php

use WireUi\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for("categories.index")
    ->push("Home", route("home"));

Breadcrumbs::for("categories.show")
    ->push("Home", route("home"))
    ->push("Categories", route("categories.index"));
