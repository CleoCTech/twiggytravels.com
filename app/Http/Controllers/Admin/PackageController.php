<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HolidayCategory;
use App\Models\PriceCategory;
use App\Models\PriceCategoryBinding;
use Illuminate\Http\Request;
use App\Traits\Admin\LayoutTrait;
use App\Traits\Admin\UploadFileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class PackageController extends Controller
{
    use LayoutTrait;
    use UploadFileTrait;

    public $settings = [
        'model' =>  '\\App\\Models\\Package',
        'caption' =>  "Package",
        'xFolder' =>  "Admin/Pages/Packages",
        'indexRoute' =>  "/admin/package",
        'storageName' =>  "packages",
        'isList' => true,
        'isCreate' => true,
        'isView' => true,
        'isEdit' => true,
        'isDelete' => true,
        'isActions' => true,
        'isAttachments' => true,
        'isReports' => false,
        'isCharts' => false,
        'isSearch' => true,
        'isSelect' => true,
        'isMoreActions' => false,
        'xMoreActions' => null,
        'isExport' => false,
        'orderBy' => ['column' => 'created_at', 'order' => 'DESC'],
    ];
    public function __construct(){
        $this->middleware('gen-auth');
        $this->middleware('admin-auth');
        $this->defaultModel = $this->settings['model'];
        $this->setup['statuses'] = $this->defaultModel::options('status');
        $this->setup['categories'] = $this->defaultModel::options('category_id');
        $this->setup['holidays'] = HolidayCategory::where('status', 2)->get();
        $this->setup['priceCategories'] = PriceCategory::where('status', 2)->get();
        $this->setup['priceStatuses'] = PriceCategoryBinding::options('status');
        $this->setup['tableName'] = $this->defaultModel::getTableName();
        $this->setup['bindedHolidayIds'] = null;
        $this->setup['bindedPriceIds'] = null;
        $this->setup['bindedPriceStatuses'] = null;
        $this->def_constructor();
        // foreach ($this->setup['holidays'] as $key => $value) {
        //     dump($value['id']);
        //     dump($value['name']);
        // }
        // dd($this->setup['holidays']);

    }
    public function index(){
        $this->def_index();
        return Inertia::render($this->settings['xFolder'].'/Index',$this->viewData);
    }
    public function create(){
        $this->def_create();
        $bindedPriceIds = [];
        $bindedPriceStatuses = [];
        $priceCategories = PriceCategory::where('status', 2)->get();
        if($priceCategories){
            foreach ($priceCategories as $key => $value) {
                $bindedPriceIds[$value->id] = 0 ;
                $bindedPriceStatuses[$value->id] = 1;
            }
        }

        $this->setup['priceCategories']->map(function ($priceCategory) use ($bindedPriceIds) {
            $priceCategory['price'] = 0.00;
            $priceCategory['status'] = 1;
        });
        $this->viewData['setup']['bindedPriceStatuses'] = $bindedPriceStatuses;
        $this->viewData['setup']['bindedPriceIds'] = $bindedPriceIds;
        return Inertia::render($this->settings['xFolder'].'/CreateEdit',$this->viewData);
    }
    function objectToArray ($object) {
        if(!is_object($object) && !is_array($object)){
            return $object;
        }
        return array_map('objectToArray', (array) $object);
    }
    public function store(REQUEST $request){
        $this->validate($request, [
            'title' => 'required',
            // 'category_id' => 'required',
            'content' => 'max:3000',
            'cover_image' => 'nullable',
            'sequence' => 'nullable',
            'exam_path.*' => 'nullable|array',
            // 'price' => 'required|json',
            'status' => 'required',
            'publish_time' => 'nullable|required_if:status,=,3',
        ]);

        // Log::info(json_decode($request->price, TRUE));
        // Log::info($request->holiday);
        // if ($request->holiday) {
        //     $holidays = explode(",", $request->holiday);
        // }
       
        // $priceBindings = json_decode($request->price, TRUE);
        // $bindedPriceStatuses = json_decode($request->priceStatus, TRUE);
        // Log::info($bindedPriceStatuses);
        DB::beginTransaction();
        try{
            $this->pKey = $request->uuid == 'null'? null:$request->uuid;
            $record = [
                'title' => $request->title,
                // 'category_id' => $request->category_id,
                'content' => $request->content,
                'extra_info' => $request->extra_info,
                'validity' => $request->validity,
                'status' => $request->status,
                'sequence' => $request->sequence,
                'publish_time' => $request->publish_time,
            ];
            if($request->hasFile('cover_image')){
                info('yes image is available');
                $fileName = $this->generateFileName($request->file('cover_image'));
                $record['cover_image'] = $fileName;
            }
            if($request->status != 3){
                $record['publish_time'] = null;
            }
            if($this->pKey == null){
                $record['created_by'] = Auth::user()->email;
            }else{
                $record['updated_by'] = Auth::user()->email;
            }
            $package = $this->defaultModel::updateOrCreate(["uuid" => $this->pKey], $record);

            if($request->hasFile('cover_image'))
            {
                $fileData = [
                    'file' => $request->file('cover_image'),
                    'fileName' => $fileName,
                    'storageName' => $this->settings['storageName'].'\\cover_images',
                    'prevFile' => $this->prevRecord != null? $this->prevRecord->cover_image:null
                ];
                if(!$this->uploadFile($fileData))
                {
                    $this->isCommit = false;
                }
            }
            // if ($holidays != null) {
            //     if (PackageHolidayBinding::where('package_id', $package->id)->exists()) {
            //         PackageHolidayBinding::where('package_id', $package->id)->delete();
            //     }
            //     foreach ($holidays as $holidayId) {
            //         // Log::info("Id: " .$holidayId);
            //         PackageHolidayBinding::create([
            //             'package_id' => $package->id,
            //             'holiday_id' => $holidayId,
            //         ]);
            //     }
            // }
            // if ($priceBindings != null) {
            //     if (PriceCategoryBinding::where('package_id', $package->id)->exists()) {
            //         PriceCategoryBinding::where('package_id', $package->id)->delete();
            //     }
            //     foreach ($priceBindings as $key => $value) {
            //         if($value == null){
            //             $value=0;
            //             PriceCategoryBinding::create([
            //                 'package_id' => $package->id,
            //                 'price_category_id' => $key,
            //                 'price' => $value
            //             ]);
            //         } else {
            //             PriceCategoryBinding::create([
            //                 'package_id' => $package->id,
            //                 'price_category_id' => $key,
            //                 'price' => $value
            //             ]);
            //         }
            //     }
            // }
            // if ($bindedPriceStatuses != null) {
            //     foreach ($bindedPriceStatuses as $key => $value) {
            //         if($value != null){
            //             PriceCategoryBinding::where(function($query) use ($package, $key) {
            //                 $query->where('package_id', $package->id)
            //                     ->where('price_category_id', $key);
            //             })->update(['status' => $value]);
            //         }
            //     }
            // }
            if($this->isCommit){
                DB::Commit();
                $response = $this->notification('success');
                return response()->json($response,200);
            }else{
                DB::rollback();
                $response = $this->notification('error');
                return response()->json($response,500);
            }
        }catch(\Exception $e){
            DB::rollback();
            Log::error($e->getMessage());
            $response = $this->notification('error');
            return response()->json($response,500);
        }
    }
    public function show($uuid){
        $this->def_show($uuid);
        return Inertia::render($this->settings['xFolder'].'/Show',$this->viewData);
    }
    public function edit($uuid){
        $this->def_edit($uuid);
       // $bindedHolidays = DestinationHolidayBinding::where('destination_id', $this->viewData['cardData']['id'])->select('holiday_id')->get();
    //     $bindedHolidayIds = [];
    //     $bindedPriceIds = [];
    //     $bindedPriceStatuses = [];
    //    // $bindedPriceCategories = PriceCategoryBinding::where('destination_id', $this->viewData['cardData']['id'])->get();

    //     foreach ($bindedHolidays as $key => $value) {
    //         array_push($bindedHolidayIds, strval($value->holiday_id));
    //     }

    //     if ($bindedPriceCategories) {
    //         foreach ($bindedPriceCategories as $key => $value) {
    //             $bindedPriceIds[$value->price_category_id] = $value->price;
    //             $bindedPriceStatuses[$value->price_category_id] = $value->status;
    //         }
    //         $this->setup['priceCategories']->map(function ($priceCategory) use ($bindedPriceIds, $bindedPriceStatuses) {
    //             if (array_key_exists($priceCategory['id'], $bindedPriceIds)) {
    //                 $priceCategory['price'] = $bindedPriceIds[$priceCategory['id']];
    //                 $priceCategory['status'] = $bindedPriceStatuses[$priceCategory['id']];;
    //             } else {
    //                 $priceCategory['price'] = 0.00;
    //                 $priceCategory['status'] = 1;
    //             }
    //         });
    //     } else {
    //         $this->setup['priceCategories']->map(function ($priceCategory) use ($bindedPriceIds) {
    //             $priceCategory['price'] = 0.00;
    //             $priceCategory['status'] = 1;
    //         });
    //     }

    //     $this->setup['holidays']->map(function ($holiday) use ($bindedHolidayIds) {
    //         if (in_array($holiday['id'], $bindedHolidayIds)) {
    //             $holiday['checked'] = 'true';
    //         } else {
    //             $holiday['checked'] = 'false';
    //         }
    //         // return $holiday;
        // });
        // $this->viewData['setup']['bindedHolidayIds'] = $bindedHolidayIds;
        // $this->viewData['setup']['bindedPriceStatuses'] = $bindedPriceStatuses;
        // $this->viewData['setup']['bindedPriceIds'] = $bindedPriceIds;
        if($this->viewData['cardData']['status'] == 3){
            $this->viewData['cardData']['publish_time2'] = $this->viewData['cardData']['publish_time']->format('Y-m-d\TH:i');
        }
        return Inertia::render($this->settings['xFolder'].'/CreateEdit', $this->viewData);
    }
    public function destroy($uuid){
        $user = $this->defaultModel::where('uuid',$uuid)->first();
        $user->delete();
        $response = $this->notification('deleteSuccess');
        return response()->json($response,200);
    }
    public function report($name){
        $this->defReport();
        $this->viewData['name'] = $name;
        $this->viewData['fileName'] = 'industries-report.pdf';
        $this->viewData['dataItems'][0]['relationships'] = 'solutions';
        $this->viewData['dataItems'][1] = [
            'model' => 'App\\Models\\Solution',
            'columns' => $this->defaultModel::getTableColumns('solutions'),
            'caption' => 'Solutions Dataset',
        ];
        return $this->viewData;
    }
}
