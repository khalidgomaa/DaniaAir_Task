<?php

namespace App\Repositories\Checklist;

use App\Models\Answer;
use App\Models\Checklist;
use Illuminate\Support\Facades\DB;

class ChecklistRepository implements ChecklistRepositoryInterface
{
    public function all()
    {
        return Checklist::with('user')->get();
    }

    public function find($id)
    {
        return Checklist::with(relations: ['answers.question', 'user'])->findOrFail($id);

        
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $checklist = Checklist::create([
                'inspector' => $data['inspector'],
                'date' => $data['inspection_date'],
                'time' => $data['time'],
            ]);

            foreach ($data['answers'] as $answer) {
                Answer::create([
                    'checklist_id' => $checklist->id,
                    'question_id' => $answer['question_id'],
                    'response' => $answer['response'],
                    'comments' => $answer['comments'] ?? null,
                ]);
            }

            DB::commit();

            return $checklist;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($id, array $data)
    {

    }

    public function delete($id)
    {

    }
}
