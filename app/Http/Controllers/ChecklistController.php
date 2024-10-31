<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateChecklistRequest;
use App\Repositories\Checklist\ChecklistRepositoryInterface;

class ChecklistController extends Controller
{

    protected $checklistRepository;

    public function __construct(ChecklistRepositoryInterface $checklistRepository)
    {
        $this->checklistRepository = $checklistRepository;
    }


    public function create()
    {
        $createData = $this->checklistRepository->getCreateData(); 
        return view('checklist.create', $createData); 
    }


    public function store(CreateChecklistRequest $request)
    {
        $data = $request->validated();
        
        try {
            $checklist = $this->checklistRepository->store($data);
            
            return redirect()->back()->with('success', 'Checklist submitted successfully!');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create the checklist. Please try again.');

            return redirect()->back()->withErrors(['error' => 'Unable to add checklist.']);

         
        }
    }
    
}
