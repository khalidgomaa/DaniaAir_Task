<?php

namespace App\Repositories\Checklist;

use App\Models\User;
use App\Models\Answer;
use App\Models\Category;
use App\Models\Checklist;
use Illuminate\Support\Facades\DB;

class ChecklistRepository implements ChecklistRepositoryInterface
{
    public function getAll()
    {
        // return Checklist::with('user')->latest()->get();   
        return Checklist::with('user')->orderBy('created_at', 'desc')->get();

    }

    public function find($id)
    {
        return Checklist::with(relations: ['answers.question', 'user'])->findOrFail($id);

        
    }


    public function getCreateData()
    {
     
        $categories = Category::with('questions')->get();
        $users = User::all();
        
        return compact('categories', 'users'); 
    }

    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            $checklist = Checklist::create([
                'inspector' => $data['inspector'],
                'date' => $data['date'],
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
        $checklist = $this->find($id);
      return  $checklist->delete();
    }
}
