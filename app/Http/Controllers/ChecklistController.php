<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function create()
    {
        $categories = Category::with('questions')->get();
        $users = User::all();
        return view('checklist.create', compact('categories', 'users'));
    }
}
