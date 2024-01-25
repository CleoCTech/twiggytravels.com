<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use App\Traits\Admin\LayoutTrait;
use App\Traits\Admin\UploadFileTrait;
use Illuminate\Support\Facades\Log;

class SectionImagesController extends Controller
{
    use LayoutTrait;
    use UploadFileTrait;

    public $settings = [
        'model' =>  '\\App\\Models\\SectionImage',
        'caption' =>  "Section Images",
        'xFolder' =>  "Admin/Pages/SectionImages",
        'indexRoute' =>  "/admin/sectionimage",
        'storageName' =>  "sectionimages",
        'isList' => true,
        'isCreate' => true,
        'isView' => true,
        'isEdit' => true,
        'isDelete' => false,
        'isActions' => true,
        'isAttachments' => false,
        'isReports' => false,
        'isCharts' => false,
        'isSearch' => true,
        'isReltionship' => false,
        'relationName' => "",
        'isSelect' => true,
        'isMoreActions' => false,
        'xMoreActions' => null,
        'isExport' => false,
        'orderBy' => ['column' => 'created_at', 'order' => 'DESC'],
    ];

    public function __construct(){
        // $this->middleware('gen-auth');
        // $this->middleware('admin-auth');
        $this->defaultModel = $this->settings['model'];
        $this->isReltionship = $this->settings['isReltionship'];
        $this->relationName = $this->settings['relationName'];
        $this->setup['statuses'] = $this->defaultModel::options('status','list','');
        $this->def_constructor();
    }
    public function index(){
        $this->def_index();
        return Inertia::render($this->settings['xFolder'].'/Index',$this->viewData);
    }
    public function create(){
        $this->def_create();
        return Inertia::render($this->settings['xFolder'].'/CreateEdit',$this->viewData);
    }
    public function store(REQUEST $request){
        $this->validate($request, [
            'area' => 'required',
            'highlight' => 'max:255',
            'other_info' => 'max:255',
            'cover_image' => 'nullable',
            'status' => 'required',
            'publish_time' => 'nullable|required_if:status,=,3',
        ]);
        DB::beginTransaction();
        try{
            $this->pKey = $request->uuid == 'null'? null:$request->uuid;
            if($request->hasFile('cover_image')){
                $fileName = $this->generateFileName($request->file('cover_image'));
            }
            $record = [
                'area' => $request->area,
                'highlight' => $request->highlight,
                'other_info' => $request->other_info,
                'status' => $request->status,
                'publish_time' => $request->publish_time,
            ];
            if($request->hasFile('cover_image')){
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
            $this->defaultModel::updateOrCreate(["uuid" => $this->pKey], $record);
            if($request->hasFile('cover_image')){
                $fileData = ['file' => $request->file('cover_image'),'fileName' => $fileName, 'storageName' => $this->settings['storageName'].'\\cover_images','prevFile' => $this->prevRecord != null? $this->prevRecord->cover_image:null];
                if(!$this->uploadFileWithWatermark($fileData)){
                    $this->isCommit = false;
                }
            }
            if($this->isCommit){
                DB::Commit();
                $response = $this->notification('success');
                return response()->json($response,200);
                // return['success' => $this->pKey == null? 'Created successfuly':'Edited successfully'];
            }else{
                DB::rollback();
            }
        }catch(\Exception $e){
            DB::rollback();
            Log::error($e);$response = $this->notification('error');
            return response()->json($response,500);

        }
    }
    public function show($uuid){
        $this->def_show($uuid);
        return Inertia::render($this->settings['xFolder'].'/Show',$this->viewData);
    }
    public function edit($uuid){
        $this->def_edit($uuid);
        if($this->viewData['cardData']['status'] == 3){
            $this->viewData['cardData']['publish_time2'] = $this->viewData['cardData']['publish_time']->format('Y-m-d\TH:i');
        }
        return Inertia::render($this->settings['xFolder'].'/CreateEdit',$this->viewData);
    }
    public function destroy($uuid){
        $user = $this->defaultModel::where('uuid',$uuid)->first();
        $user->delete();
        $response = $this->notification('deleteSuccess');
        return response()->json($response,200);
    }
}
