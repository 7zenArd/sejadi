<?php

use App\Models\Additional;
use App\Models\CafeSetting;
use App\Models\DetailPesanan;
use App\Models\KategoriMenu;
use App\Models\Menu;
use App\Models\MenuAdditionalConfig;
use App\Models\MenuAdditionalsConfig;
use App\Models\MenuAllowedAdditionals;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\TryCatch;
use function Laravel\Prompts\select;

Route::prefix('/object/public/assets/')->group(function () {
    Route::get('/Menu/{foto_path}', function(string $foto_path) {
        $filePath = public_path('storage/Menu/' . $foto_path);
        
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }
        
        return response()->file($filePath);
    });
});

Route::prefix('rpc')->group(function () {
    Route::get('/get_best_sellers',function(Request $request){
        try {
            $validated = $request->validate([
                'limit_count' => 'required|integer|min:1',
                'days_ago' => 'required|integer|min:0',
            ]);

            return [];
        } catch (\Throwable $th) {
            return response()->json(['error'=>'Internal Server Error'],500);
        }

    });
});

Route::prefix('menu')->group(function () {
    Route::get('/',function(Request $req){
        try {
            $has_id = $req->has('id');
            $has_select = $req->has('select');

            $query = Menu::query();

            if($has_id){
                $id = explode('.',$req['id'])[1];
                $query = $query->findOrFail($id);
            }

            if ($has_select){
                $select = explode(',',$req['select']);
                $query = $query->select($select);
            }

            $query = $has_id ? $query->first() : $query->get();

            return response()->json(!$has_id ? ['data'=>$query] : $query,200);
        } catch (\Throwable $th) {
            return response()->json(['error'=>'Internal Server Error'],500);
        }
    });

    Route::get('/{id}', function(int $id){
        try {
            $menu = Menu::findOrFail($id);
            return response()->json($menu, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Menu not found'], 404);
        }
    });
});

Route::prefix('cafe_settings')->group(function () {
    Route::get('/',function(Request $req){
        // try {
            $res = CafeSetting::first();
            if ($req->has('select')){
                $select = explode(',',$req['select']);
                $res = CafeSetting::get()->select($select)->first();
            }
            return $res;
        // } catch (\Throwable $th) {
        //     return response()->json(["error"=>"Internal Server Error"],500);
        // }
    });
});

Route::prefix("categories")->group(function () {
    Route::get("/",function(){
        try {
            return response()->json(["data"=>KategoriMenu::all()->select(['id','nama','urutan'])],200);
        } catch (\Throwable $th) {
            return response()->json(['error'=>"Internal Server Error"],500);
        }
    });
});

Route::prefix("menu-additional-config")->group(function () {
    Route::get("/",function(){
        try {
            return response()->json(['data'=>MenuAdditionalsConfig::all()->select(['menu_id','final_support_additional','final_support_dimsum_additional'])],200);
        } catch (\Throwable $th) {
            return response()->json(["error"=> "Internal Server Error"],500);
        }
    });
});

Route::prefix('additionals')->group(function(){
    Route::get('/', function(Request $req){
        try {
            $query = Additional::query();
            
            if($req->has('is_active')){
                $is_active = explode('.',$req['is_active']);
                $query = $query->where('is_active',$is_active[0] == 'true' ? 1 : 0);
            }

            $query = $query->get();
            
            if($req->has('order')){
                $order = explode('.',$req['order']);
                $query = $order[0] == 'asc' ? $query->sortBy($order[0], descending:false) : $query->sortBy($order[0], descending:true);
            }

            if($req->has('select')){
                $select = explode(',',$req['select']);
                $query = $query->select($select);
            }

            $res = [];

            foreach($query as $key => $value) {
                $res['data'][] = $value;
            }

            return response()->json($res,200);
        } catch (\Throwable $th) {
            return response()->json(['error'=>'Internal Server Error'],500);
        }
    });
});

Route::prefix('menu_additional_config')->group(function () {
    Route::get('/',function(){
        // try {
            $query = MenuAdditionalConfig::get();

            $res = [];

            foreach($query as $key=>$value){
                $res['data'][] = [
                    "menu_id"=>$value->menu_id,
                    "final_support_additional"=> $value->final_support_additional,
                    "final_support_dimsum_additional"=> $value->final_support_dimsum_additional
                ];
            }

            return response()->json($res,200);
        // } catch (\Throwable $th) {
        //     return response()->json(['error'=>'Internal Server Error'],500);
        // }
    });
});

Route::prefix('menu_allowed_additionals')->group(function () {
    Route::get('/',function(){
        // try {
            $query = MenuAllowedAdditionals::get();

            $res = [];

            foreach($query as $key=>$value){
                $res['data'][] = [
                    "menu_id"=>$value->menu_id,
                    "additional_id"=>$value->additional_id,
                    "additional_nama"=>$value->additional_nama,
                    "additional_harga"=>$value->additional_harga,
                    "additional_tipe"=>$value->additional_tipe
                ];
            }

            return response()->json($res,200);
        // } catch (\Throwable $th) {
        //     return response()->json(['error'=>'Internal Server Error'],500);
        // }
    });
});

Route::prefix('pesanan')->group(function () {
    Route::get('/',function(Request $req){
        $res = Pesanan::get();

        if($req->has('select')){
            $select = explode(',',$req->select);
            $req = $res->select($select);
        }

        return response()->json(['data'=>$res],200);
    });

    Route::post('/',function(Request $req){
        $payload = [
            'no_meja'=>$req->no_meja,
            'status'=>$req->status,
            'total'=>$req->total,
            'note'=>$req->note,
            'cancellation_reason'=>$req->cancellation_reason,
            'cancelled_at'=>$req->cancelled_at,
            'location_type'=>$req->location_type,
            'pickup_time'=>$req->pickup_time,
            'discount_code'=>$req->discount_code,
            'discount_amount'=>$req->discount_amount,
            'total_after_discount'=>$req->total_after_discount,
            'processed_at'=>$req->processed_at,
            'completed_at'=>$req->completed_at,
            'is_hidden'=>$req->is_hidden,
            'archived_at'=>$req->archived_at,
            'location_area'=>$req->location_area,
            'metode_pembayaran'=>$req->metode_pembayaran,
            'bank_qris'=>$req->bank_qris,
            'is_final'=>$req->is_final,
        ];

        Pesanan::create($payload);

        return response()->json(['status'=>true],201);
    });
});

Route::prefix('detail_pesanan')->group(function () {
    Route::get('/',function(Request $req){
        $res = DetailPesanan::get();

        return response()->json(['data'=>$res],200);
    });

    Route::post('/',function(Request $req){
        foreach ($req->all() as $key=>$value){
            $payload = [
                'pesanan_id'=>$value['pesanan_id'],
                'menu_id'=>$value['menu_id'],
                'jumlah'=>$value['jumlah'],
                'subtotal'=>$value['subtotal'],
                'note'=>$value['note'],
                'varian'=>$value['varian'],
                'additionals'=>$value['additionals'],
                'dimsum_additionals'=>$value['dimsum_additionals'],
                'additional_price'=>$value['additional_price'],
                'base_price'=>$value['base_price'],
                'is_locked'=>$value['is_locked'],
            ];
            
            DetailPesanan::create($payload);

            return response()->json(['status'=>true],201);
        }
    });
});