<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CreateChecklistRequest;
use App\Http\Requests\UpdateChecklistRequest;
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
        try {
        $createData = $this->checklistRepository->getCreateData(); 
        
        return view('checklist.create', $createData); 
    } catch (\Exception $e) {
        Log::error('Error get  checklist: ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to get this route .');
    }
    }


    public function store(CreateChecklistRequest $request)
    {
        $data = $request->validated();
        
        try {
            $checklist = $this->checklistRepository->store($data);
            session()->flash('success', 'Checklist created successfully.');
            return response()->json([
                'status' => true,
                'message' =>'Checklist added successfully',
                'data'=>$checklist,
            ]);         
        } catch (\Exception $e) {
            Log::error('Error creating checklist: ' . $e->getMessage()); 
         
            return response()->json([
                'status' => false,
                'errors' => $data->errors(),
            ]);      
        }
    }
    
    
    
    public function edit($id) {
        try {
            $checklist = $this->checklistRepository->find($id);
            $createData = $this->checklistRepository->getCreateData(); 
            
      
            return view('checklist.edit', [
                'categories' => $createData['categories'],
                'checklist' => $checklist,
                'users' => $createData['users'], 
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting checklist: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error getting this checklist page.');
        }
    }
    
    

  
    public function update(UpdateChecklistRequest $request, $id)
    {
        $data = $request->validated();
    
        try {
            $checklist = $this->checklistRepository->update($id, $data);
    
            session()->flash('success', 'Checklist updated successfully.');
            return response()->json([
                'status' => true,
                'message' => 'Checklist updated successfully',
                'data' => $checklist,
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating checklist: ' . $e->getMessage());
            session()->flash('error', 'Failed to update this checklist.');
    
            return response()->json([
                'status' => false,
                'errors' => $e->getMessage(), // Optionally, return specific error messages
            ]);
        }
    }
    
    public function destroy($id)
    {
        try {
            $this->checklistRepository->delete($id);
            return redirect()->route('checklists.index')->with('success', 'Checklist deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting checklist: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete checklist.');
        }
    }
}
