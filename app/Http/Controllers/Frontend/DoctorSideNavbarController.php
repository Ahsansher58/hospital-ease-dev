<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use App\Models\FavoriteHospital;
use App\Models\MainCategory;
use App\Models\SubCategory;
use App\Models\LocationsMaster;
// use App\Models\UserProfile as ModelsUserProfile;
use App\Models\Doctor;
use App\Models\DoctorAwardAchievement;
use App\Models\DoctorEducationalQualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DoctorSideNavbarController extends Controller
{
  public function profile()
  {
    if (!Auth::check()) {
      return redirect('/');
    }
    $user                  = Auth::user();
    $categories            = BusinessCategory::orderBy('order_no')->get();
    $businessCategories    = $categories->where('is_sub_category', false);
    $businessSubCategories = $categories->where('is_sub_category', true);
    $locationMaster        = LocationsMaster::all();
    $uniqueLocalities      = LocationsMaster::select('locality')->distinct()->pluck('locality');
    $uniqueCities          = LocationsMaster::select('city')->distinct()->pluck('city');
    $uniqueStates          = LocationsMaster::select('state')->distinct()->pluck('state');
    $uniqueCountries       = LocationsMaster::select('country')->distinct()->pluck('country');
    return view('frontend.content.doctors.doctor_profile', compact('user', 'uniqueLocalities', 'uniqueCities', 'uniqueStates', 'uniqueCountries', 'businessCategories', 'businessSubCategories', 'locationMaster'));
  }

  public function dashboard()
  {
    // if (!Auth::check()) {
    //   return redirect('/');
    // }
    // $user = Auth::user();

    // // Pass the user data to the view
    // return view('frontend.content.doctors.doctor_profile_dashboard', compact('user'));

    if (!Auth::check()) {
      return redirect('/');
    }
    $user         = Auth::user();
    $doctor_profile = Doctor::where('user_id', $user->id)->first();
    return view('frontend.content.doctors.doctor_personnel', compact('user', 'doctor_profile'));
  }

  public function personnel_info()
  {
    if (!Auth::check()) {
      return redirect('/');
    }
    $user         = Auth::user();
    $doctor_profile = Doctor::where('user_id', $user->id)->first();
    return view('frontend.content.doctors.doctor_personnel', compact('user', 'doctor_profile'));
  }

  public function educationalQualifications()
  {
    if (!Auth::check()) {
      return redirect('/');
    }
    $user                           = Auth::user();
    $doctor                         = Doctor::where('user_id', $user->id)->first();
        
    $doctorEducationalQualification = DoctorEducationalQualification::where('doctor_id', $doctor->id)->get();
    return view('frontend.content.doctors.educational_qualifications', compact('user', 'doctorEducationalQualification'));
  }

  public function awardAchievements()
  {
    if (!Auth::check()) {
      return redirect('/');
    }
    $user           = Auth::user();
    $doctor         = Doctor::where('user_id', $user->id)->first();
    $doctorAchievement = DoctorAwardAchievement::where('doctor_id', $doctor->id)->get();
    return view('frontend.content.doctors.award-achievements', compact('user', 'doctorAchievement'));
  }

  public function edit_personnel_info()
  {
    if (!Auth::check()) {
      return redirect('/');
    }
    $user                  = Auth::user();
    $doctor_profile        = Doctor::where('user_id', $user->id)->first();
    $categories            = BusinessCategory::orderBy('order_no')->get();
    $businessCategories    = $categories->where('is_sub_category', false);
    $businessSubCategories = $categories->where('is_sub_category', true);
    $locationMaster        = LocationsMaster::all();
    $uniqueLocalities      = LocationsMaster::select('locality')->distinct()->pluck('locality');
    $uniqueCities          = LocationsMaster::select('city')->distinct()->pluck('city');
    $uniqueStates          = LocationsMaster::select('state')->distinct()->pluck('state');
    $uniqueCountries       = LocationsMaster::select('country')->distinct()->pluck('country');
    return view('frontend.content.doctors.edit_doctor_personnel', compact('user', 'uniqueLocalities', 'uniqueCities', 'uniqueStates', 'uniqueCountries', 'businessCategories', 'businessSubCategories', 'locationMaster', 'doctor_profile'));
  }
  
  public function edit_educational_qualifications($id)
  {
    if (!Auth::check()) {
      return redirect('/');
    }
    $user                  = Auth::user();
    $doctor_profile        = DoctorEducationalQualification::find($id);
    $categories            = BusinessCategory::orderBy('order_no')->get();
    $businessCategories    = $categories->where('is_sub_category', false);
    $businessSubCategories = $categories->where('is_sub_category', true);
    $locationMaster        = LocationsMaster::all();
    $uniqueLocalities      = LocationsMaster::select('locality')->distinct()->pluck('locality');
    $uniqueCities          = LocationsMaster::select('city')->distinct()->pluck('city');
    $uniqueStates          = LocationsMaster::select('state')->distinct()->pluck('state');
    $uniqueCountries       = LocationsMaster::select('country')->distinct()->pluck('country');
    return view('frontend.content.doctors.edit_educational_qualifications', compact('user', 'uniqueLocalities', 'uniqueCities', 'uniqueStates', 'uniqueCountries', 'businessCategories', 'businessSubCategories', 'locationMaster', 'doctor_profile'));
  }

  public function edit_award_achievements($id)
  {
    if (!Auth::check()) {
      return redirect('/');
    }
    $user                  = Auth::user();
    $doctor                = Doctor::where('user_id', $user->id)->first();
    $doctor_profile        = DoctorAwardAchievement::find($id);
    $categories            = BusinessCategory::orderBy('order_no')->get();
    $businessCategories    = $categories->where('is_sub_category', false);
    $businessSubCategories = $categories->where('is_sub_category', true);
    $locationMaster        = LocationsMaster::all();
    $uniqueLocalities      = LocationsMaster::select('locality')->distinct()->pluck('locality');
    $uniqueCities          = LocationsMaster::select('city')->distinct()->pluck('city');
    $uniqueStates          = LocationsMaster::select('state')->distinct()->pluck('state');
    $uniqueCountries       = LocationsMaster::select('country')->distinct()->pluck('country');
    return view('frontend.content.doctors.edit_award_achievements', compact('user', 'uniqueLocalities', 'uniqueCities', 'uniqueStates', 'uniqueCountries', 'businessCategories', 'businessSubCategories', 'locationMaster', 'doctor_profile'));
  }

  public function user_profile_fav()
  {
    if (!Auth::check()) {
      return redirect('/');
    }
    $user = Auth::user();
    $favoriteHospitals = FavoriteHospital::where('user_id', $user->id)
      ->with('hospital') // Assuming there is a `hospital` relationship
      ->get();

    return view('frontend.content.users.user_profile_fav', compact('user', 'favoriteHospitals'));
  }
  public function medical_records()
  {
    if (!Auth::check()) {
      return redirect('/');
    }
    $user = Auth::user();
    return view('frontend.content.users.user_medical_records', compact('user'));
  }

  /*Add other fields data of user */
  public function profile_update(Request $request)
  {
    // Validation rules for the form fields
    $request->validate([
      'height'   => 'required|numeric',
      'weight'   => 'required|numeric',
      'address'  => 'required|string|max:255',
      'locality' => 'required|string|max:100',
      'city'     => 'required|string|max:100',
      'state'    => 'required|string|max:100',
      'pincode'  => 'required|string|max:10',
      'country'  => 'required|string|max:100',
    ]);

    // Save the data to the `user_profile` table
    $doctorProfile = Doctor::updateOrCreate(
      ['user_id' => auth()->id()],
      [
        'height'   => $request->height,
        'weight'   => $request->weight,
        'address'  => $request->address,
        'locality' => $request->locality,
        'city'     => $request->city,
        'state'    => $request->state,
        'pincode'  => $request->pincode,
        'country'  => $request->country,
      ]
    );

    if ($doctorProfile) {
      session(['user_profile' => $doctorProfile]);
    }
    // Redirect back with a success message
    return redirect()->route('doctor.dashboard')->with('success', 'Profile updated successfully!');
  }
  public function profile_update_all(Request $request)
  {
    $validated = $request->validate([
      'name'                    => 'required|string|max:255',
      'profile_image'           => 'nullable|string|max:255',
      'specialization'          => 'required|string|max:255',
      'years_experience'        => 'required|numeric',
      'ima_registration_number' => 'required',
      'country'                 => 'nullable|string|max:255',
      'state'                   => 'nullable|string|max:255',
      'city'                    => 'nullable|string|max:255',
      'locality'                => 'nullable|string|max:255',
      'clinic_name'             => 'nullable|string|max:255',
      'clinic_address1'         => 'nullable|string|max:255',
      'clinic_address2'         => 'nullable|string|max:255',
      'clinic_phone'            => 'nullable|string|max:255',
    ]);

    // Update user data
    $user = auth()->user();
    if ($user instanceof User) {
      $user->update([
        'name' => $request->name,
      ]);
    }
    // Update user profile
    $userProfile = Doctor::where('user_id', auth()->id())->first();
    $userProfile->update([
      'name'                    => $request->name,
      'profile_image'           => $request->profile_image,
      'specialization'          => $request->specialization,
      'years_experience'        => $request->years_experience,
      'ima_registration_number' => $request->ima_registration_number,
      'country'                 => $request->country ,
      'state'                   => $request->state ,
      'city'                    => $request->city ,
      'locality'                => $request->locality ,
      'clinic_name'             => $request->clinic_name ,
      'clinic_address1'         => $request->clinic_address1 ,
      'clinic_address2'         => $request->clinic_address2 ,
      'clinic_phone'            => $request->clinic_phone ,
    ]);

    if ($request->hasFile('profile_image')) {
      $image     = $request->file('profile_image');
      $imageName = time() . '.' . $image->getClientOriginalExtension(); 

      $uploadsPath = public_path('uploads');
      $doctorsPath = public_path('uploads/doctors');

      // Ensure 'uploads' folder exists
      if (!file_exists($uploadsPath)) {
          mkdir($uploadsPath, 0777, true);
      }

      // Ensure 'uploads/doctors' folder exists
      if (!file_exists($doctorsPath)) {
          mkdir($doctorsPath, 0777, true);
      }

      // Move the uploaded image to the doctors folder
      $image->move($doctorsPath, $imageName); 
    }

      if ($userProfile) {
        session(['user_profile' => $userProfile]);
      }
      // Redirect back with a success message
      return redirect()->route('doctor.personnelInfo')->with('success', 'Profile updated successfully!');
  }

  public function educational_qualifications_update_all(Request $request,$id)
  {
    $validated = $request->validate([
      'college_name'               => 'required|string|max:255',
      'year_studied'               => 'required|numeric',
      'degree'                     => 'required|string|max:255',
      'qualification_certificate'  => 'nullable',
      'show_certificate_in_public' => 'nullable',
    ]);

    $user                           = Auth::user();
    $doctor                         = Doctor::where('user_id', $user->id)->first();
    $doctorEducationalQualification = DoctorEducationalQualification::find($id);

    $doctorEducationalQualification->update([
      'doctor_id'                  => $doctor->id,
      'college_name'               => $request->college_name,
      'year_studied'               => $request->year_studied,
      'degree'                     => $request->degree,
      'qualification_certificate'  => $request->qualification_certificate,
      'show_certificate_in_public' => $request->show_certificate_in_public,
    ]);

    // Redirect back with success message
    return redirect()->route('doctor.educational-qualifications')->with('success', 'Educational Qualifications updated');
  }

  public function educational_qualifications_store(Request $request)
  {
    $validated = $request->validate([
      'college_name'               => 'required|string|max:255',
      'year_studied'               => 'required|numeric',
      'degree'                     => 'required|string|max:255',
      'qualification_certificate'  => 'required',
      'show_certificate_in_public' => 'required',
    ]);

    $user      = Auth::user();
    $doctor    = Doctor::where('user_id', $user->id)->first();
    $imageName = null;

    if ($request->hasFile('qualification_certificate')) {
      $image     = $request->file('qualification_certificate');
      $imageName = time() . '.' . $image->getClientOriginalExtension(); 

      if (!file_exists(public_path('uploads/doctors'))) {
          mkdir(public_path('uploads/doctors'), 0777, true);
      }

      $image->move(public_path('uploads/doctors'), $imageName); 
    }
    
    DoctorEducationalQualification::create([
      'doctor_id'                  => $doctor->id,
      'college_name'               => $request->college_name,
      'year_studied'               => $request->year_studied,
      'degree'                     => $request->degree,
      'qualification_certificate'  => $imageName,
      'show_certificate_in_public' => $request->show_certificate_in_public,
    ]);

    // Redirect back with success message
    return redirect()->route('doctor.educational-qualifications')->with('success', 'Educational Qualifications created');
  }

  public function award_achievements_update_all(Request $request)
  {
    $validated = $request->validate([
      'award_name'        => 'required|string|max:255',
      'awarded_year'      => 'required|numeric',
      'award_certificate' => 'required',
    ]);

    $imageName = null;

      if ($request->hasFile('award_certificate')) {
        // foreach ($request->award_certificate as $key => $image) {
            $image = $request->file('award_certificate');
            $imageName = time() . '.' . $image->getClientOriginalExtension(); 

            if (!file_exists(public_path('uploads/doctors'))) {
                mkdir(public_path('uploads/doctors'), 0777, true);
            }

            $image->move(public_path('uploads/doctors'), $imageName); 
        // }
      }

    // Update user profile
    $user        = Auth::user();
    $doctor      = Doctor::where('user_id', $user->id)->first();
    $doctorProfile = DoctorAwardAchievement::where('doctor_id',$doctor->id)->first();

    if (!$doctorProfile) {
        DoctorAwardAchievement::create([
          'doctor_id'         => $doctor->id,
          'award_name'        => $request->award_name,
          'awarded_year'      => $request->awarded_year,
          'award_certificate' => $imageName,
        ]);
    } else{
      $doctorProfile->update([
        'doctor_id'         => $doctor->id,
        'award_name'        => $request->award_name,
        'awarded_year'      => $request->awarded_year,
        'award_certificate' => $imageName,
      ]);
    }

    // Redirect back with success message
    return redirect()->route('doctor.award-achievements')->with('success', 'Award & Achievements updated');
  }
}
