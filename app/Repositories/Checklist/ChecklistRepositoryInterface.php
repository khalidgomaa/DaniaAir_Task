<?php

namespace App\Repositories\Checklist;

use App\Models\Checklist;

interface ChecklistRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function store(array $data);
    public function getCreateData();

    public function update($id, array $data);

    public function delete($id);
}
