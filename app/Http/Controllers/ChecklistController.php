<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateChecklistRequest;
use App\Repositories\Checklist\ChecklistRepositoryInterface;

class ChecklistController extends Controller
{

    protected $checklistRepository;

    public function __construct(ChecklistRepositoryInterface $checklistRepository)
    {
        $this->checklistRepository = $checklistRepository;
    }
    public function index()
    {
        $checklists = $this->checklistRepository->getAll();
        return view('checklist.index', compact('checklists'));
    }

    public function show($id)
    {
        $checklist = $this->checklistRepository->find($id);
        return view('checklist.show', compact('checklist'));
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
            session()->flash('success', 'Checklist created successfully.');
            return redirect()->back()->withInput()->with('success', 'Checklist created successfully.');

            // return redirect()->route('checklists.index');
        } catch (\Exception $e) {
            Log::error('Error creating checklist: ' . $e->getMessage()); 
         
            return redirect()->back()->withInput()->with('error', 'failed creating Checklist  .');
      
        }
    }
    
}
