<?php

namespace App\Repositories\Checklist;

use App\Models\Checklist;

interface ChecklistRepositoryInterface
{
    public function all();

    public function find($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}
