<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Tools;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu; 
use App\Models\MenuList;
class MenuController extends Controller
{
   public $tools;
   public $request;
   public function __construct(Tools $tools,Request $request){
   	  $this->tools=$tools;
   	  $this->request=$request;
   	 
   }

	//菜单列表
	//
    public function menu_list(){
    	$first_menu = Menu::where(['type'=>3])->select(['name','id'])->get();
        return view('Menu.menulist',['first_menu'=>$first_menu]);
    }



    //创建菜单
    public function create_menu(){
    	$req = $this->request->all();
    	if($req['type']==1){
    		$first_count=Menu::where('type','!=','2')->count();
    		if($first_count>=3){
    			dd('菜单超限');
    		}

    	    Menu::insert([
              'name'=>$req['name'],
              'event'=>$req['event'],
              'event_key'=>$req['event_key'],
              'type'=>$req['type'],
              'parent_id'=>0             

        	]);
    	}elseif($req['type']==2){
    		$first_count = Menu::where('parent_id','=',$req['first_name'])->count();
    		if($first_count>=5){
    			dd("菜单超限");
    		}

    		Menu::insert([
               'name'=>$req['second_name'],
               'event'=>$req['event'],
               'event_key'=>$req['event_key'],
               'type'=>$req['type'],
               'parent_id'=>$req['second_name']
        
    		]);

    	}elseif($req['type']==3){
    		$first_count=Menu::where('type','!=','2')->count();
    		if($first_count>=3){
    			dd("菜单超限");
    		}
            Menu::insert([
               'name'=>$req['first_name'],
               'event'=>"",
               'event_key'=>"",
               'type'=>$req['type'],
               'parent_id'=>0,

            ]);

    	}
       $this->load_menu();
    }



    //加载菜单
    public function load_menu(){

   
    }


}