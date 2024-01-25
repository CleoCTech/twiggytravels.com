<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\Faq;
use App\Models\HolidayCategory;
use App\Models\PriceCategoryBinding;
use App\Models\DestinationHolidayBinding;
use App\Models\Package;
use App\Models\Ratting;
use App\Models\SectionImage;
use App\Models\System\AdminUser;
use App\Models\System\CompanyInformation;
use App\Models\System\SocialMedia;
use App\Models\System\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Traits\NotificationTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use App\Traits\Admin\LayoutTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GeneralContoller extends Controller
{
    use NotificationTrait;
    use LayoutTrait;
    public function __construct(){
        $this->middleware('gen-auth')->only('dashboard');
    }
    public function home()
    {
        $localDestinations = Destination::whereHas('destinationCategory', function(Builder $query){
            $query->where('name', 'like', 'Local%');
        })
        ->latest()
        ->where('status',2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->get()->take(6);
        $internalDestinations = Destination::whereHas('destinationCategory', function(Builder $query){
            $query->where('name', 'like', 'Inter%');
        })
        ->latest()
        ->where('status',2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->get()->take(6);
        $themedHolidays = HolidayCategory::where('status',2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->get();
        $packages = Package::where('status',2)
        ->latest()
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->get()->take(3);
        $faqs = Faq::where('status',2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->get();
        $testmonials = Ratting::with('destination')
        ->where('status', 2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->get();
        $companyInfo = CompanyInformation::first();
        $sectionImages = SectionImage::where('status',2)->get();
        $data = [
            'name' => 'Cleo',
            'localDestinations' => $localDestinations,
            'internalDestinations' => $internalDestinations,
            'packages' => $packages,
            'themedHolidays' => $themedHolidays,
            'testmonies' => $testmonials,
            'faqs' => $faqs,
            'companyInfo' => $companyInfo,
            'sectionImages' => $sectionImages,
        ];
        return Inertia::render('Guest/Pages/Home', $data);
    }
    public function tours()
    {
        $tours = Destination::with('destinationCategory')
        ->where('status',2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->paginate(6);
        $sectionImages = SectionImage::where('status',2)->get();
        $theme = [];
        $data = [
            'tours' => $tours,
            'sectionImages' => $sectionImages,
            'theme' => $theme,
        ];
        return Inertia::render('Guest/Pages/Tours', $data);
    }
    public function themedHolidays($theme)
    {
        if (strpos($theme, '-') !== false) {
            info("Theme: " .$theme);
            $theme = str_replace('-', ' ', $theme);
        }

        $theme = HolidayCategory::where('name', 'like', $theme.'%')->first();

        if (! $theme == null) {

        $tours = Destination::with('destinationCategory')
        ->whereHas('destinationHolidayBinding', function ($query) use ($theme){
            $query->where('holiday_id', $theme->id);
        })
        ->where('status',2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->paginate(6);
        $sectionImages = SectionImage::where('status',2)->get();
        $data = [
            'tours' => $tours,
            'sectionImages' => $sectionImages,
            'theme' => $theme,
        ];

        } else {
            $tours=[];
            $sectionImages = SectionImage::where('status',2)->get();
            $data = [
                'tours' => $tours,
                'sectionImages' => $sectionImages,
                'theme' => $theme,
            ];
        }
        return Inertia::render('Guest/Pages/Tours', $data);
    }
    public function localDestinations()
    {
        $tours = Destination::with('destinationCategory')
        ->whereHas('destinationCategory', function (Builder $query) {
            $query->where('name', 'like', 'Local%');
        })
        ->where('status',2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->paginate(6);
        $sectionImages = SectionImage::where('status',2)->get();
        $theme = ['name' => 'Local Destination'];
        $data = [
            'tours' => $tours,
            'sectionImages' => $sectionImages,
            'theme' => $theme,
        ];
        return Inertia::render('Guest/Pages/Tours', $data);
    }
    public function internationalDestinations()
    {
        $tours = Destination::with('destinationCategory')
        ->whereHas('destinationCategory', function (Builder $query) {
            $query->where('name', 'like', 'Inter%');
        })
        ->where('status',2)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->paginate(6);
        $sectionImages = SectionImage::where('status',2)->get();
        $theme = ['name' => 'International Destination'];
        $theme = (object) $theme;
        $data = [
            'tours' => $tours,
            'sectionImages' => $sectionImages,
            'theme' => $theme,
        ];
        return Inertia::render('Guest/Pages/Tours', $data);
    }
    public function showDestination($title)
    {
        $title = str_replace('-',' ',$title);
        $cardData = Destination::whereRaw('LOWER(`title`) LIKE ? ',$title)
        ->where('status',2)->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })->first();
        // dd($cardData->destinationCategory->name);
        if($cardData == null){
            return redirect()->route('tours');
        }
        $this->pageTitle = $cardData->title;
        $headerImage = '/storage/destinations/cover_images/'.$cardData->cover_image;
        $relatedOffers = Destination::whereHas('destinationCategory', function(Builder $query) use ($cardData) {
            $query->where('name', 'like', $cardData->destinationCategory->name.'%');
        })
        ->where('status',2)
        ->where('id', '!=', $cardData->id)
        ->orWhere(function($query){
            $query->where('status',3)
            ->where('publish_time','<=',date('Y-m-d h:i:s'));
        })
        ->inRandomOrder()->limit(2)
        ->get();
        if(Str::contains($cardData->destinationCategory->name, 'Local') || Str::contains($cardData->destinationCategory->name, 'local')){
            $url = 'local-destination';
        } else {
            $url = 'international-destination';
        }
        $prices = PriceCategoryBinding::with('priceCategory')
        ->where('destination_id', $cardData->id)
        ->get();
        $rattings = Ratting::where('destination_id', $cardData->id, function ($query) {
            $query->where('status', 2);
        })->avg('ratting');
        $rattings = round($rattings, 1);
        $data = [
            'cardData' => $cardData,
            'pageTitle' => $this->pageTitle,
            'headerImage' => $headerImage,
            'tourType' => $cardData->destinationCategory->name,
            'relatedOffers' => $relatedOffers,
            'url' => $url,
            'prices' => $prices,
            'rattings' => $rattings,
        ];
        return Inertia::render('Guest/Pages/Destination/Show', $data);
    }

    public function getRatting($destination_id)
    {
        $rattings = Ratting::where('destination_id', $destination_id, function ($query) {
            $query->where('status', 2);
        })->avg('ratting');
        // Log::info($rattings);
        return response()->json(round($rattings, 1));
    }

    public function dashboard(){
        // dd('her');
        if(Auth::user()->user_category == 100){
            $user = AdminUser::select('status','role')->where('email',Auth::user()->email)->first();
            if($user == null || $user->role == null){
                Auth::logout();
                return redirect('/login')->with('error','Oops! your authorization as an admin failed.');
            }
            $role = UserRole::find($user->role);
            if($role == null){
                Auth::logout();
                return redirect('/login')->with('error','Oops! the user has not been assigned a role in the system');
            }
            $user['profile_category'] = 'admin';
            $user['permissions'] = $role->permissions;
            Auth::user()->profile = $user;
            return redirect('/admin/dashboard');
        }else{
            return Inertia::render('Admin/Pages/Dashboard');
        }
    }

    public function ratting(REQUEST $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'review' => 'required|max:255',
            'ratting' => 'required',
            'destination_id' => 'required',
        ]);
        $record = [
            'name' => $request->name,
            'email' => $request->email,
            'review' => $request->review,
            'ratting' => $request->ratting,
            'destination_id' => $request->destination_id,
            'created_by' => $request->email,
        ];
        DB::beginTransaction();
        try {
            Ratting::updateOrCreate(["uuid" => $this->pKey], $record);
            DB::commit();
            Log::info("succes-review");
            return redirect('/');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e);
        }

    }

    public function book(REQUEST $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone_no' => 'required',
            'resident_country' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
            'adults_no' => 'required|numeric',
            'children_no' => 'required|numeric',
            'email' => 'required|email',
            'message' => 'required|max:255',
            'destination_id' => 'required',
        ]);
        $record = [
            'name' => $request->name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'resident_country' => $request->resident_country,
            'message' => $request->message,
            'children_no' => $request->children_no,
            'adults_no' => $request->adults_no,
            'check_in' =>  Carbon::parse($request->check_in)->toDateString(),
            'check_out' => Carbon::parse($request->check_out)->toDateString(),
            'destination_id' => $request->destination_id,
            'created_by' => $request->email,
        ];
        DB::beginTransaction();
        try {
            Booking::updateOrCreate(["uuid" => $this->pKey], $record);
            DB::commit();
            Log::info("succes-booking");
            return redirect('/');
        } catch (Exception $e) {
            Log::error($e);
            DB::rollback();
        }
    }

    public function footerData(){
        $companyInfo = CompanyInformation::first();
        $socialMedias = SocialMedia::where('status',2)->get();
        // $projects = Project::where('status',2)->orWhere(function($query){
        //     $query->where('status',3)
        //     ->where('publish_time','<=',date('Y-m-d h:i:s'));
        // })->get();
        // $takeActions = TakeAction::get();
        $data = [
            'companyInfo' => $companyInfo,
            'socialMedias' => $socialMedias,
            // 'projects' => $projects,
            // 'takeActions' => $takeActions,
        ];
        return $data;
    }

    public function topBarData(){
        $companyInfo = CompanyInformation::first();
        $socialMedias = SocialMedia::where('status',2)->get();
        $data = [
            'companyInfo' => $companyInfo,
            'socialMedias' => $socialMedias,
        ];
        return $data;
    }

    public function aboutUs()
    {
        $companyInfo = CompanyInformation::first();
        $sectionImages = SectionImage::where('status',2)->get();
        $banner = SectionImage::where('status',2)
        ->where('area', 'Banner Area->[About Page]')
        ->first();
        $data = [
            'companyInfo' => $companyInfo,
            'sectionImages' => $sectionImages,
            'banner' => $banner,
        ];
        return Inertia::render('Guest/Pages/About', $data);
    }
}