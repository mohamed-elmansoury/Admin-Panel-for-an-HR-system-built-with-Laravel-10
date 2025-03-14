<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployerRequest;
use App\Models\Admin;
use App\Models\Branche;
use App\Models\Employer;
use App\Models\Jop_Categories;
use App\Models\Nationality;
use App\Models\Occasions;
use App\Models\Qualification;
use App\Models\Religion;
use App\Models\Resignation;
use App\Models\Shifts_type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EmployerController extends Controller
{
    /**
     * Display a listing of the employers.
     */
    public function index()
    {
        // Retrieve all employers
        $employers = Employer::with([
            'resignation',
            'religion',
            'qualification',
            'occasion',
            'nationality',
            'branch',
            'admin'
        ])->paginate(3);

        return view('admin.Employers.index', compact('employers'));
    }

    /**
     * Show the form for creating a new employer.
     */
    public function create()
    {

        $resignations = Resignation::all();
        $religions = Religion::all();
        $qualifications = Qualification::all();
        $occasions = Occasions::all();
        $nationalities = Nationality::all();
        $branches = Branche::all();
        $admins = Admin::all();


        return view('admin.Employers.create', compact(

            'resignations',
            'religions',
            'qualifications',
            'occasions',
            'nationalities',
            'branches',
            'admins',

        ));
    }

    /**
     * Store a newly created employer in storage.
     */
    public function store(EmployerRequest $request)
    {
        $data = $request->all(); // Get all the request data
    
        // Handle file upload for photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = 'photo_' . Carbon::now()->format('Ymd_His') . '.' . $photo->getClientOriginalExtension();
            $photoPath = $photo->storeAs('public/photos', $photoName);
    
            // Update the 'photo' field in the $data array instead of using $request->merge()
            $data['photo'] = $photoPath;
        }
    
        // Handle file upload for resume
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $resumeName = 'resume_' . Carbon::now()->format('Ymd_His') . '.' . $resume->getClientOriginalExtension();
            $resumePath = $resume->storeAs('public/resume', $resumeName);
    
            // Update the 'resume' field in the $data array instead of using $request->merge()
            $data['resume'] = $resumePath;
        }
    
        // Use the modified $data array to create the Employer record
        Employer::create($data);
    
        return redirect()->route('Employers.index')->with('success', 'Employer created successfully.');
    }
    

    /**
     * Display the specified employer.
     */
    public function show($id)
    {
        // Retrieve a single employer by ID
        $employer = Employer::with([
            'resignation',
            'religion',
            'qualification',
            'occasion',
            'nationality',
            'branch',
            'admin'
        ])->findOrFail($id);

        return view('admin.Employers.show', compact('employer'));
    }

    /**
     * Show the form for editing the specified employer.
     */
    public function edit($id)
    {
        // Load the employer and its relationships
        $employer = Employer::with([
            'resignation',
            'religion',
            'qualification',
            'occasion',
            'nationality',
            'branch',
            'admin'
        ])->findOrFail($id);

        // Also pass the related models (resignations, religions, etc.) for form dropdowns
        $resignations = Resignation::all();
        $religions = Religion::all();
        $qualifications = Qualification::all();
        $occasions = Occasions::all();
        $nationalities = Nationality::all();
        $branches = Branche::all();
        $admins = Admin::all();

        // Pass the data to the view using compact
        return view('admin.Employers.edit', compact(
            'employer',
            'resignations',
            'religions',
            'qualifications',
            'occasions',
            'nationalities',
            'branches',
            'admins'
        ));
    }

    public function update(EmployerRequest $request, $id)
    {
        // Retrieve the employer by its ID
        $employer = Employer::findOrFail($id);  // Fetch the existing employer by ID

        DB::beginTransaction();

        try {
            //Log::info('Before Update:', $request->all());

            // Handle file upload for photo
            if ($request->hasFile('photo')) {
                // Delete the old photo if it exists
                if ($employer->photo) {
                    Storage::delete($employer->photo);
                }

                $photo = $request->file('photo');
                $photoName = 'photo_' . Carbon::now()->format('Ymd_His') . '.' . $photo->getClientOriginalExtension();
                $photoPath = $photo->storeAs('public/photos', $photoName);
                $request->merge(['photo' => $photoPath]);
            }

            // Handle file upload for resume
            if ($request->hasFile('resume')) {
                // Delete the old resume if it exists
                if ($employer->resume) {
                    Storage::delete($employer->resume);
                }

                $resume = $request->file('resume');
                $resumeName = 'resume_' . Carbon::now()->format('Ymd_His') . '.' . $resume->getClientOriginalExtension();
                $resumePath = $resume->storeAs('public/resume', $resumeName);
                $request->merge(['resume' => $resumePath]);
            }

            // Now fill the employer with the new data and save it
            $employer->fill($request->all());
            $employer->save();

            // Log::info('After Update:', $employer->toArray());

            DB::commit();

            // Redirect back with success message
            return redirect()->route('Employers.index')->with('success', 'Employer updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();

            //  Log::error('Update failed:', ['error' => $e->getMessage()]);

            return redirect()->back()->with('error', 'Failed to update employer. Please try again.');
        }
    }

    /**
     * Remove the specified employer from storage.
     */
    public function destroy($id)
    {
        
        $employer = Employer::findOrFail($id);
        $employer->delete();
        // Delete photo and resume files
        if ($employer->photo) {
            Storage::disk('public')->delete($employer->photo);
        }

        if ($employer->resume) {
            Storage::disk('public')->delete($employer->resume);
        }

       
    

        return redirect()->route('Employers.index')->with('success', 'Employer deleted successfully.');
    }
}
