<?php

namespace App\Services\Review;

use Illuminate\Http\RedirectResponse;

interface ReviewInterface
{
    public function store(): ?RedirectResponse;

    public function update(): ?RedirectResponse;

    public function destroy(): ?RedirectResponse;
}
