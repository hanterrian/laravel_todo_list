<?php

declare(strict_types=1);

namespace App\Interfaces\Service;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface TodoListServiceInterface
{
    public function getAll(Request $request): Collection;

    public function getOne(int $id): Todo;

    public function markAsDone(int $id): bool;

    public function store(Request $request): Todo;

    public function update(int $id, Request $request): Todo;

    public function delete(int $id): bool;
}
