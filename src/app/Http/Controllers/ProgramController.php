<?php

namespace App\Http\Controllers;

use App\Models\EvsContent;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use File;
use Image;

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
        $formMode = 'new';
        $event_category = EvsContent::where('option_name', 'event_category')->get();
        $event_type = EvsContent::where('option_name', 'event_type')->get();
        return view('admin.programs.create', compact('formMode', 'event_category', 'event_type'));
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
            'event_type'  => 'required|string',
            'date'      => 'required|string',
            'countdown'      => 'required|string',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=820/461'
            "event_days" => "required|string",
            "event_month" => "required|string",
        ]);
        $data = [];
        $times = $request->input('time');
        $events = $request->input('event');
        $speakers = $request->input('speaker');

        // Combine the data into an array
        foreach ($times as $key => $time) {
            $data[] = [
                'time' => $time,
                'event' => $events[$key],
                'speaker' => $speakers[$key],
            ];
        }
        $schedules = json_encode($data);
        try {
            $program = new Program();
            $program->name = $valData["name"];
            $program->category = $valData["category"];
            $program->event_type = $valData["event_type"];
            $program->event_date = $valData["date"];
            $program->event_countdown = $valData["countdown"];
            $program->event_days = $valData["event_days"];
            $program->event_month = $valData["event_month"];
            $program->schedules = $schedules;
            $program->slug = Str::slug($valData["name"]);
            if($request->image){
                $save_path = storage_path('events/');
                File::makeDirectory($save_path, $mode = 0755, true, true);
                // $image_name = strtolower(Str::slug($valData["name"]) .'.' .$request->image->extension());
                // $request->file('image')->storeAs('public', $image_name);
                $getImage = $request->file('image');
                $image_name = strtolower(Str::slug($valData["name"]) .'.jpg');
                Image::make($getImage)->resize(1080, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($save_path.$image_name);
                Image::make($getImage)->resize(250, 250, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($save_path.'small-'.$image_name, 75);

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
        $formMode = 'edit';
        $event_category = EvsContent::where('option_name', 'event_category')->get();
        $event_type = EvsContent::where('option_name', 'event_type')->get();
        return view('admin.programs.edit', compact('program','formMode', 'event_category', 'event_type'));
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
        $data = [];
        $times = $request->input('time');
        $events = $request->input('event');
        $speakers = $request->input('speaker');

        // Combine the data into an array
        foreach ($times as $key => $time) {
            $data[] = [
                'time' => $time,
                'event' => $events[$key],
                'speaker' => $speakers[$key],
            ];
        }
        $schedules = json_encode($data);

        // dd($request->all());
        $valData = $request->validate([
            'name' => 'required|string',
            'category'  => 'required|string',
            'event_type'  => 'required|string',
            'date'      => 'required|string',
            'countdown'      => 'required|string',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:ratio=820/461'
            "event_days" => "required|string",
            "event_month" => "required|string",
        ]);


        $previousFileName = $program->image_location;

        $program->name = $valData["name"];
        $program->category = $valData["category"];
        $program->event_type = $valData["event_type"];
        $program->event_date = $valData["date"];
        $program->event_countdown = $valData["countdown"];
        $program->event_days = $valData["event_days"];
        $program->event_month = $valData["event_month"];
        $program->schedules = $schedules;

        $program->slug = Str::slug($valData["name"]);
        // if($request->image){
        //     Storage::delete('public/' . $previousFileName);
        //     $image_name = strtolower(Str::slug($valData["name"]) .'.' .$request->image->extension());
        //     $request->file('image')->storeAs('public', $image_name);
        //     $program->image_location = ($image_name);
        // }
        if($request->image){
            Storage::delete(storage_path('events/') . $previousFileName);
            $save_path = storage_path('events/');
            File::makeDirectory($save_path, $mode = 0755, true, true);
            // $image_name = strtolower(Str::slug($valData["name"]) .'.' .$request->image->extension());
            // $request->file('image')->storeAs('public', $image_name);
            $getImage = $request->file('image');
            $image_name = strtolower(Str::slug($valData["name"]) .'.jpg');
            Image::make($getImage)->resize(1080, 1080, function ($constraint) {
                $constraint->aspectRatio();
            })->save($save_path.$image_name);
            Image::make($getImage)->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save($save_path.'small-'.$image_name, 75);

            $program->image_location = ($image_name);
        }

        // dd($program);
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

    public function toggleProgramFeatured(Program $program)
    {
        $status = $program->is_featured;
        $program->is_featured = !$status;
        $program->save();
        return redirect()->route('programs.index')
        ->with('success', 'Event Status Changed successfully');
    }

}
