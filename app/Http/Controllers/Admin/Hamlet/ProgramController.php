<?php

namespace App\Http\Controllers\Admin\Hamlet;

use App\Http\Controllers\Controller;
use App\Models\Hamlet;
use App\Models\Hamlet\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $program = Program::whereHas('hamlet', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })->orWhere('rt', 'like', "%$search%")
          ->orWhere('work', 'like', "%$search%")
          ->orWhere('status', 'like', "%$search%")
          ->paginate(5);

        return view('admin.hamlet.program.index', compact('program'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hamlet = Hamlet::all();
        return view('admin.hamlet.program.create', compact('hamlet'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hamlet_id' => 'required|exists:hamlets,id',
            'rt' => 'required|string|max:10',
            'work' => 'required|string|max:255',
            'status' => 'required|string|in:Terlaksana,Belum Terlaksana',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Program::create($request->all());

        return redirect()->route('program.index')->with('success', 'Program added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $program = Program::findOrFail($id);
        return view('admin.hamlet.program.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $program = Program::findOrFail($id);
        $hamlet = Hamlet::all();
        return view('admin.hamlet.program.edit', compact('program', 'hamlet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'hamlet_id' => 'required|exists:hamlets,id',
            'rt' => 'required|string|max:10',
            'work' => 'required|string|max:255',
            'status' => 'required|string|in:Terlaksana,Belum Terlaksana',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $program = Program::findOrFail($id);
        $program->update($request->all());

        return redirect()->route('program.index')->with('success', 'Program updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $program = Program::findOrFail($id);
        $program->delete();

        return redirect()->route('program.index')->with('success', 'Program deleted successfully!');
    }
}
