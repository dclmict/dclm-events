<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::latest()->paginate(5);

        return view('admin.programs.index', compact('programs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.programs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valData = $request->validate([
            'name'      => 'required|string',
            'category'  => 'required|string',
            'date'      => 'required|string',
            'countdown'      => 'required|string',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=820/461'
        ]);
        try {
            //code...
            $program = new Program();
            $program->name = $valData["name"];
            $program->category = $valData["category"];
            $program->event_date = $valData["date"];
            $program->event_countdown = $valData["countdown"];
            $program->slug = Str::slug($valData["name"]);
            if($request->image){
                $image_name = strtolower(Str::slug($valData["name"]) .'.' .$request->image->extension());
                $request->file('image')->storeAs('public', $image_name);
                $program->image_location = ($image_name);
            }
            $program->save();

            return redirect()->route('programs.index')
                            ->with('success', 'Program created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('programs.index')
                            ->with('error','Error: ' . $e->getMessage());
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        return view('admin.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        $valData = $request->validate([
            'name' => 'required|string',
            'category'  => 'required|string',
            'date'      => 'required|string',
            'countdown'      => 'required|string',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=820/461'
        ]);

        
        $previousFileName = $program->image_location;
        $program->name = $valData["name"];
        $program->category = $valData["category"];
        $program->event_date = $valData["date"];
        $program->event_countdown = $valData["countdown"];
        $program->slug = Str::slug($valData["name"]);
        if($request->image){
            Storage::delete('public/' . $previousFileName);
            $image_name = strtolower(Str::slug($valData["name"]) .'.' .$request->image->extension());
            $request->file('image')->storeAs('public', $image_name);
            $program->image_location = ($image_name);
        }
        $program->save();

        return redirect()->route('programs.index')
        ->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')
        ->with('success', 'Event deleted successfully');
    }

    public function toggleProgramStatus(Program $program)
    {
        $status = $program->is_active;
        $program->is_active = !$status;
        $program->save();
        return redirect()->route('programs.index')
        ->with('success', 'Event Status Changed successfully');
    }
    
}
