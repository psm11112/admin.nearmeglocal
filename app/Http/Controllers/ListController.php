<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListRequest;
use App\Models\Category;
use App\Models\Cities;
use App\Models\Country;
use App\Models\Gallery;
use App\Models\ListModel;
use App\Models\State;
use Faker\Core\File;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ListController extends Controller
{

    protected $modelName='';
    protected $routeName='';
    protected $viewFolderName='';

    public function __construct()
    {
        $this->modelName = 'list';
        $this->routeName='list';
        $this->viewFolderName='List';


    }
    public function index(Request $request){

        $list=ListModel::with(['city','states','country','parent_category'])->when($request->term,function($query) use ($request)  {
            $query->where('title','like','%'.$request->term.'%');
        })->orderBy('id','DESC')->paginate(config('service.pagination'))->withQueryString();


        return Inertia::render('List/index',[
            'list'=>$list
        ]);
    }

    public function edit($id){

        $category=Category::get();
        $country=Country::get();
        $stats=State::get();

        $this->modelName=ListModel::with(['city','states','country','parent_category','gallery_images'])->FindOrFail($id);

        return Inertia::render('List/edit',[
            'list'=>$this->modelName,
            'category'=>$category,
            'country'=>$country,
            'stats'=>$stats
        ]);

    }

    /**
     * @param ListRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ListRequest $request){

        $list= ListModel::FindOrFail($request->id);


        if(!is_null($list->banner_image_url)){

            $bannerImage=$list->banner_image_url;
        }

        if(!is_null($list->feature_image_url)){
            $featureImage=$list->feature_image_url;
        }

        if ($request->hasFile('banner')) {

            if(!is_null($list->banner_image_url)){
                if(\Illuminate\Support\Facades\File::exists(public_path(config('app.image_url').$list->banner_image_url))){
                    Storage::disk('public')->delete($list->banner_image_url);
                }
            }


            $bannerImage = $request->file('banner')->store('image/banner', 'public');
        }

        if ($request->hasFile('feature')) {

            if(!is_null($list->feature_image_url)){
                if(\Illuminate\Support\Facades\File::exists(public_path(config('app.image_url').$list->feature_image_url))){

                    Storage::disk('public')->delete($list->feature_image_url);
                }
            }


            $featureImage = $request->file('feature')->store('image/feature', 'public');
        }

        if($request->sub_category_id){
            $subCategory=[];
            foreach($request->sub_category_id as $key=>$item){
                $subCategory[]=[
                    'id'=>$item['id'],
                    'name'=>$item['name']
                ];
            }
        }

        $generalFeatures=!is_null($request->general_features)?[]:null;
        if(!is_null($request->general_features)){
            foreach ($request->general_features as $general)
            {
                $generalFeatures[]= $general;

            }
        }

        $wifi=!is_null($request->wifi)?[]:null;

        if(!is_null($request->wifi)){
            foreach ($request->wifi as $wifiList){
                $wifi[]=$wifiList;
            }
        }

        $parking=!is_null($request->parking)?[]:null;

        if(!is_null($request->parking)){
            foreach ($request->parking as $parkingList){

                $parking[]=$parkingList;
            }

        }

        $list->title = $request->title;
        $list->category_id=$request->category_id;
        $list->sub_category_ids = json_encode($subCategory);

        $list->title = $request->title;
        $list->slug = $request->title_slug;
        $list->country_id  = $request->country_id;
        $list->state_id = $request->state_id;
        $list->city_id  = $request->city_id;
        $list->area_id  = $request->area_id;
        $list->post_code = $request->post_code;
        $list->address = $request->address;
        $list->latitude = $request->latitude;
        $list->longitude = $request->longitude;
        $list->phone_number = $request->phone_number;
        $list->youtube_video_id	 = $request->youtub_video_id;
        $list->description = $request->description;
        $list->website = $request->website;
        $list->business_email = $request->business_email;
        $list->business_whatsapp_url = $request->business_watsapp_url;
        $list->whatsapp_chat = $request->whatsapp_chat;
        $list->email_id = $request->email;
        $list->price_range = $request->price_range;
        $list->general_features = json_encode($generalFeatures);
        $list->facebook = $request->facebook;
        $list->twitter = $request->twitter;
        $list->linkedin = $request->linked_in;
        $list->appointment = $request->request_an_appointment;
        $list->wifi = json_encode($wifi);
        $list->parking = json_encode($parking);
        $list->banner_image_url =isset($bannerImage) ?$bannerImage :null;
        $list->feature_image_url=isset($featureImage) ? $featureImage:null;
        $list->hours =$request->hours;
        $list->item_featured =$request->item_featured;
        $list->save();


        if(!is_null($request->dfr)){
            foreach ($request->dfr as $image){
                $bannerImage = $image->store('image/gallery', 'public');

                $imageGallery=new Gallery();
                $imageGallery->name=$bannerImage;
                $imageGallery->url=$bannerImage;
                $imageGallery->list_id=$list->id;
                $imageGallery->save();
            }
        }

        return to_route($this->routeName.'.edit',['id'=>$request->id])->with('message',$this->routeName.' Successfully Added');

    }


    public function create(){
        $category=Category::get();
        $country=Country::get();



        return Inertia::render('List/create',[
            'category'=>$category,
            'country'=>$country
        ]);
    }

    public function store(ListRequest $request){






        if ($request->hasFile('banner')) {
            $bannerImage = $request->file('banner')->store('image/banner', 'public');
        }

        if ($request->hasFile('feature')) {
            $featureImage = $request->file('feature')->store('image/feature', 'public');
        }


        $subCategory=[];
        if($request->sub_category_id){
            foreach($request->sub_category_id as $key=>$item){
                $subCategory[]=[
                    'id'=>$item['id'],
                    'name'=>$item['name']
                ];
            }
        }

        $generalFeatures=!is_null($request->general_features)?[]:null;
        if(!is_null($request->general_features)){
            foreach ($request->general_features as $general)
            {
                $generalFeatures[]= $general;

            }
        }

        $wifi=!is_null($request->wifi)?[]:null;

        if(!is_null($request->wifi)){
            foreach ($request->wifi as $wifiList){
                $wifi[]=$wifiList;
            }
        }

        $parking=!is_null($request->parking)?[]:null;
        if(!is_null($request->parking)){
            foreach ($request->parking as $parking){
                $parking[]=$parking;
            }

        }




        $list= new ListModel();

        $list->title = $request->title;
        $list->category_id=$request->category_id;
        $list->sub_category_ids = json_encode($subCategory);

        $list->title = $request->title;
        $list->slug = $request->title_slug;
        $list->country_id  = $request->country_id;
        $list->state_id = $request->state_id;
        $list->city_id  = $request->city_id;
        $list->area_id  = $request->area_id;
        $list->post_code = $request->post_code;
        $list->address = $request->address;
        $list->latitude = $request->latitude;
        $list->longitude = $request->longitude;
        $list->phone_number = $request->phone_number;
        $list->youtube_video_id	 = $request->youtub_video_id;
        $list->description = $request->description;
        $list->website = $request->website;
        $list->business_email = $request->business_email;
        $list->business_whatsapp_url = $request->business_watsapp_url;
        $list->whatsapp_chat = $request->whatsapp_chat;
        $list->email_id = $request->email;
        $list->price_range = $request->price_range;
        $list->general_features = json_encode($generalFeatures);
        $list->facebook = $request->facebook;
        $list->twitter = $request->twitter;
        $list->linkedin = $request->linked_in;
        $list->appointment = $request->request_an_appointment;
        $list->wifi = json_encode($wifi);
        $list->parking = json_encode($parking);
        $list->banner_image_url =isset($bannerImage) ?$bannerImage :null;
        $list->feature_image_url=isset($featureImage) ? $featureImage:null;
        $list->hours =$request->hours;
        $list->item_featured =$request->item_featured;
        $list->save();


        if(!is_null($request->dfr)){
            foreach ($request->dfr as $image){
                $bannerImage = $image->store('image/gallery', 'public');

                $imageGallery=new Gallery();
                $imageGallery->name=$bannerImage;
                $imageGallery->url=$bannerImage;
                $imageGallery->list_id=$list->id;
                $imageGallery->save();
            }
        }

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Added');


    }



    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeStatus(Request $request)
    {

        $this->modelName = ListModel::findOrFail($request->id);
        $this->modelName->is_active = $request->status[0]['value'];
        $this->modelName->save();
        return to_route($this->routeName.'.index')->with('message',  $this->routeName.' status updated');


    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function itemDeleted(Request $request){

        $this->modelName=ListModel::findOrFail($request->id);

        if(!is_null($this->modelName->banner_image_url)){
            Storage::disk('public')->delete($this->modelName->banner_image_url);
        }
        if(!is_null($this->modelName->feature_image_url)){
            Storage::disk('public')->delete($this->modelName->feature_image_url);
        }

        $deleteGallery=Gallery::where('list_id',$request->id)->get();

        foreach ($deleteGallery as $image){
            $dT=Gallery::find($image->id);
            if(\Illuminate\Support\Facades\File::exists(public_path(config('app.image_url').$dT->url))){
                Storage::disk('public')->delete($dT->url);
            }

            $dT->delete();
        }

        $this->modelName->delete();

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Deleted');
    }


    public function makeApplicationPublic($id){
        $list=ListModel::FindOrFail($id);
        $list->item_status=ListModel::ITEM_STATUS_PUBLISHED;
        $list->save();

        return to_route($this->routeName.'.index')->with('message',$this->routeName.' Successfully Published');
    }






}
