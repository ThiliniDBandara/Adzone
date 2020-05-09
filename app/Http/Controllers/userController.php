<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\file;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;
use App\Advertisment;
use App\States;
use App\MainCatogory;
use App\SubCatogory;


class userController extends Controller
{
    public function index(){
        $catogories=DB::table('main_catogories')
                        ->select('main_catogories.id','main_catogories.mainCategory','icons.icons')
                        ->join('icons','icons.id','=','main_catogories.id')
                        ->get();
        return view('users.user',['catogories'=>$catogories]);
    }
    public function fetch(Request $request){
        if($request->get('srilankanstates')){
            $query=$request->get('srilankanstates');
            $data=DB::table('states')
            ->where('stateName', 'like', '%' .$query. '%')
            ->get();
           $output = '<ul style="display:block !important;" class="dropdown-menu">';
           if($data->count()>0){
               foreach($data as $row){
                   $output .= '<li class="searchState" id="search" name="searchState" style="cursor:pointer;"  value='.$row->id.'>' .$row->stateName.'<li>';
               }
               $output .= '<ul>';
               echo $output;
               }
               else{
                   $output .= '<li>Record not found!</li>';
                   echo $output;
               
           }
        }
    }
    public function cities(Request $request){
        if($request->get('id')){
            $query= $request->get('id');
            $data=DB::table('cities')
            ->where('stateId', 'like', '%' .$query. '%')
            ->get();
            $output = "";
            if($data->count()>0){
                foreach($data as $row){
                    $output .= '<li id="searchCity" name="searchCity" style="cursor:pointer;">'.$row->cityName.'<li>';
                }
                $output .= '';
                echo $output;
                }
                else{
                    $output .= '<li>City not found!</li>';
                    echo $output;
                }
        }
    }
    public function retrieve(Request $request){
        $data=DB::table('main_catogories')->get();
        $output = "";
        if($data->count()>0){
            foreach($data as $row){
                $output .= '<option value='.$row->id.'>'.$row->mainCategory.'</option>';
            }
            $output .= '';
            echo $output;
            }
    }
    public function postads(){
        $catogories=DB::table('main_catogories')
        ->select('main_catogories.id','main_catogories.mainCategory','icons.icons')
        ->join('icons','icons.id','=','main_catogories.id')
        ->get();
    return view('users.postads',['catogories'=>$catogories]);
    }

    public function viewads(Request $request, $maincategory,$id){
        if($id==2){
            $catogories=DB::table('main_catogories')
                ->select('main_catogories.id','main_catogories.mainCategory','icons.icons')
                ->join('icons','icons.id','=','main_catogories.id')
                ->get();
            $subcatogories=DB::table('main_catogories')
                ->select('*')
                ->join('sub_catogories','sub_catogories.mainCategoryid','=','main_catogories.id')
                ->where(['main_catogories.id'=>$id])
                ->get();
                $states=States::all();
                return view('users.publishads.carsbikeads',['catogories'=>$catogories,'subcatogories'=>$subcatogories,'states'=>$states]);
        }else  if($id==3){
            $catogories=DB::table('main_catogories')
                ->select('main_catogories.id','main_catogories.mainCategory','icons.icons')
                ->join('icons','icons.id','=','main_catogories.id')
                ->get();
                $subcatogories=DB::table('main_catogories')
                ->select('*')
                ->join('sub_catogories','sub_catogories.mainCategoryid','=','main_catogories.id')
                ->where(['main_catogories.id'=>$id])
                ->get();
                $states=States::all();
                return view('users.publishads.mobiletabletsads',['catogories'=>$catogories,'subcatogories'=>$subcatogories,'states'=>$states]);
        }else  if($id==4){
            $catogories=DB::table('main_catogories')
                ->select('main_catogories.id','main_catogories.mainCategory','icons.icons')
                ->join('icons','icons.id','=','main_catogories.id')
                ->get();
                $subcatogories=DB::table('main_catogories')
                ->select('*')
                ->join('sub_catogories','sub_catogories.mainCategoryid','=','main_catogories.id')
                ->where(['main_catogories.id'=>$id])
                ->get();
                $states=States::all();
                return view('users.publishads.electronicsapplianceads',['catogories'=>$catogories,'subcatogories'=>$subcatogories,'states'=>$states]);
        }else  if($id==5){
            $catogories=DB::table('main_catogories')
                ->select('main_catogories.id','main_catogories.mainCategory','icons.icons')
                ->join('icons','icons.id','=','main_catogories.id')
                ->get();
                $subcatogories=DB::table('main_catogories')
                ->select('*')
                ->join('sub_catogories','sub_catogories.mainCategoryid','=','main_catogories.id')
                ->where(['main_catogories.id'=>$id])
                ->get();
                $states=States::all();
                return view('users.publishads.realestateads',['catogories'=>$catogories,'subcatogories'=>$subcatogories,'states'=>$states]);
        }else  if($id==6){
            $catogories=DB::table('main_catogories')
                ->select('main_catogories.id','main_catogories.mainCategory','icons.icons')
                ->join('icons','icons.id','=','main_catogories.id')
                ->get();
                $subcatogories=DB::table('main_catogories')
                ->select('*')
                ->join('sub_catogories','sub_catogories.mainCategoryid','=','main_catogories.id')
                ->where(['main_catogories.id'=>$id])
                ->get();
                $states=States::all();
                return view('users.publishads.servicesads',['catogories'=>$catogories,'subcatogories'=>$subcatogories,'states'=>$states]);
        }
    }
    public function postcarsbikes(Request $request){
        $this->validate($request,[
            'subCategoryId'=>'required',
            'productName'=>'required',
            'yearOfPurchase'=>'required',
            'expSellPrice'=>'required',
            'name'=>'required',
            'mobile'=>'required',
            'email'=>'required',
            'state'=>'required',
            'city'=>'required',
            'photos'=>'required',
            'photos.*'=>'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        $ads=new Advertisment;
        $images= $request->file('photos');
        $count=0;
        if($request->file('photos')){
            foreach($images as $item){
                if($count<4){
                    $var=date_create();
                    $date=date_format($var,'Ymd');
                    $imageName=$date.'-' .$item->getClientOriginalName();
                    $item->move(public_path().'/uploads/',$imageName);
                    $url=URL::to("/").'/uploads/'.$imageName;
                    $arr[]=$url;
                    $count++;
                }
            } 
            $image=implode(",",$arr);
            $ads->mainCategoryId=$request->input('mainCategoryId');
            $ads->subCategoryId=$request->input('subCategoryId');
            $ads->productName=$request->input('productName');
            $ads->yearOfPurchase=$request->input('yearOfPurchase');
            $ads->expSellPrice=$request->input('expSellPrice');
            $ads->name=$request->input('name');
            $ads->mobile=$request->input('mobile');
            $ads->email=$request->input('email');
            $ads->state=$request->input('state');
            $ads->city=$request->input('city');
            $ads->photos=$image;
            $ads->save();
            return redirect('/')->with('info','Advertisment published successfully.');

           /*  $data=array(
                'mainCategoryId'=>$ads->mainCategoryId,
                'subCategoryId'=>$ads->subCategoryId,
                'productName'=>$ads->productName,
                'yearOfPurchase'=>$ads->yearOfPurchase,
                'expSellPrice'=> $ads->expSellPrice,
                'name'=> $ads->name,
                'mobile'=>$ads->mobile,
                'email'=>$ads->email,
                'state'=>$ads->state,
                'city'=>$ads->city,
                'photos'=>$ads->photos,
            );
            echo '</pre>';
            print_r($data);
            echo '</pre>';
 */
        }
    }
    public function getads(){
        $ads=DB::table('advertisments')->get();
        $output='';
        if($ads->count()>0){
        foreach($ads as $row){
            $output.='<div class="col-md-3">
            <div>
            <img src='.strtok($row->photos, ',').' style="padding:10px !important; width:100%;height:182px;"/>
            <h3>'.$row->productName.'</h3>
            <p>'.$row->expSellPrice.'</p>
            <p>'.$row->city.'</p>
            <a href='.$_SERVER['HTTP_REFERER'].'product/view/'.$row->id.'> VIEW</a>
            </div>
            </div>
            ';
            }
            $output.='';
            echo $output;
        
        }else{
            $output.='<p>Not Found</p>';
            echo $output;
        }
    }
}
