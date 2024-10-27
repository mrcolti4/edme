<?php

namespace App\Services\Review;

use App\Http\Requests\ReviewRequest;
use App\Models\Course;

interface ReviewInterface
{
    public function store(object $data, Course $course): void;

    public function update(array $data): void;

    public function destroy(): void;
}
