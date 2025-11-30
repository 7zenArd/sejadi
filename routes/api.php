<?php

use App\Models\Additional;
use App\Models\CafeSetting;
use App\Models\DetailPesanan;

use App\Models\ExportHistory;
use App\Models\HistoryArchive;
use App\Models\KategoriMenu;
use App\Models\Menu;
use App\Models\MenuAdditionalConfig;
use App\Models\MenuAdditionalsConfig;
use App\Models\MenuAllowedAdditionals;
use App\Models\PemasukanLain;
use App\Models\Pengeluaran;
use App\Models\Pesanan;
use App\Models\Struk;
use App\Models\User;
use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::prefix('/object/public/assets/')->group(function () {
    Route::get('/Menu/{foto_path}', function (string $foto_path) {
        $filePath = public_path('storage/Menu/'.$foto_path);

        if (! file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->file($filePath);
    });

Route::prefix('users')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = User::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            if ($req->has('name')) {
                $query->where('name', 'like', '%'.$req->input('name').'%');
            }
            if ($req->has('email')) {
                $query->where('email', $req->input('email'));
            }
            if ($req->has('created_from')) {
                $query->where('created_at', '>=', $req->input('created_from'));
            }
            if ($req->has('created_to')) {
                $query->where('created_at', '<=', $req->input('created_to'));
            }
            if ($req->has('password')){
                $query->where('password','=',$req->input('password'));
            }
            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                $query = $query->orderBy($order[0], $order[1] ?? 'asc');
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (int $id) {
        try {
            $user = User::findOrFail($id);

            return response()->json($user, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'User not found'], 404);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $validatedData['password'] = bcrypt($validatedData['password']);

            $user = User::create($validatedData);

            return response()->json($user, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, int $id) {
        try {
            $user = User::findOrFail($id);

            $validatedData = $req->validate([
                'name' => 'string|max:255',
                'email' => 'string|email|max:255|unique:users,email,'.$id,
            ]);

            $user->update($validatedData);

            return response()->json($user, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (int $id) {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['message' => 'User deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'User not found'], 404);
        }
    });
});

Route::prefix('struks')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = Struk::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            if ($req->has('pesanan_id')) {
                $query->where('pesanan_id', $req->input('pesanan_id'));
            }
            if ($req->has('kasir_id')) {
                $query->where('kasir_id', $req->input('kasir_id'));
            }
            if ($req->has('total_min')) {
                $query->where('total', '>=', $req->input('total_min'));
            }
            if ($req->has('total_max')) {
                $query->where('total', '<=', $req->input('total_max'));
            }
            if ($req->has('dibayar_min')) {
                $query->where('dibayar', '>=', $req->input('dibayar_min'));
            }
            if ($req->has('dibayar_max')) {
                $query->where('dibayar', '<=', $req->input('dibayar_max'));
            }
            if ($req->has('kembalian_min')) {
                $query->where('kembalian', '>=', $req->input('kembalian_min'));
            }
            if ($req->has('kembalian_max')) {
                $query->where('kembalian', '<=', $req->input('kembalian_max'));
            }
            if ($req->has('created_from')) {
                $query->where('created_at', '>=', $req->input('created_from'));
            }
            if ($req->has('created_to')) {
                $query->where('created_at', '<=', $req->input('created_to'));
            }
            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                $query = $query->orderBy($order[0], $order[1] ?? 'asc');
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (int $id) {
        try {
            $struk = Struk::findOrFail($id);

            return response()->json($struk, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Struk not found'], 404);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'pesanan_id' => 'required|integer|exists:pesanan,id',
                'kasir_id' => 'required|integer|exists:users,id',
                'total' => 'required|numeric',
                'dibayar' => 'required|numeric',
                'kembalian' => 'required|numeric',
            ]);

            $struk = Struk::create($validatedData);

            return response()->json($struk, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, int $id) {
        try {
            $struk = Struk::findOrFail($id);

            $validatedData = $req->validate([
                'pesanan_id' => 'integer|exists:pesanan,id',
                'kasir_id' => 'integer|exists:users,id',
                'total' => 'numeric',
                'dibayar' => 'numeric',
                'kembalian' => 'numeric',
            ]);

            $struk->update($validatedData);

            return response()->json($struk, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (int $id) {
        try {
            $struk = Struk::findOrFail($id);
            $struk->delete();

            return response()->json(['message' => 'Struk deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Struk not found'], 404);
        }
    });
});

Route::prefix('history-archives')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = HistoryArchive::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            if ($req->has('archive_type')) {
                $query->where('archive_type', $req->input('archive_type'));
            }
            if ($req->has('user_id')) {
                $query->where('user_id', $req->input('user_id'));
            }
            if ($req->has('created_from')) {
                $query->where('created_at', '>=', $req->input('created_from'));
            }
            if ($req->has('created_to')) {
                $query->where('created_at', '<=', $req->input('created_to'));
            }
            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                $query = $query->orderBy($order[0], $order[1] ?? 'asc');
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (int $id) {
        try {
            $historyArchive = HistoryArchive::findOrFail($id);

            return response()->json($historyArchive, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'History Archive not found'], 404);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'archive_type' => 'required|string|in:order,menu,report,user',
                'data' => 'required|json',
                'user_id' => 'integer|nullable',
            ]);

            $historyArchive = HistoryArchive::create($validatedData);

            return response()->json($historyArchive, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, int $id) {
        try {
            $historyArchive = HistoryArchive::findOrFail($id);

            $validatedData = $req->validate([
                'archive_type' => 'string|in:order,menu,report,user',
                'data' => 'json',
                'user_id' => 'integer|nullable',
            ]);

            $historyArchive->update($validatedData);

            return response()->json($historyArchive, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (int $id) {
        try {
            $historyArchive = HistoryArchive::findOrFail($id);
            $historyArchive->delete();

            return response()->json(['message' => 'History Archive deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'History Archive not found'], 404);
        }
    });
});

Route::prefix('export-histories')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = ExportHistory::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            if ($req->has('export_type')) {
                $query->where('export_type', $req->input('export_type'));
            }
            if ($req->has('status')) {
                $query->where('status', $req->input('status'));
            }
            if ($req->has('user_id')) {
                $query->where('user_id', $req->input('user_id'));
            }
            if ($req->has('created_from')) {
                $query->where('created_at', '>=', $req->input('created_from'));
            }
            if ($req->has('created_to')) {
                $query->where('created_at', '<=', $req->input('created_to'));
            }
            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                $query = $query->orderBy($order[0], $order[1] ?? 'asc');
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (int $id) {
        try {
            $exportHistory = ExportHistory::findOrFail($id);

            return response()->json($exportHistory, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Export History not found'], 404);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'export_type' => 'required|string|in:order,menu,report',
                'status' => 'required|string|in:pending,completed,failed',
                'file_path' => 'string|nullable',
                'user_id' => 'integer|nullable',
                'metadata' => 'json|nullable',
            ]);

            $exportHistory = ExportHistory::create($validatedData);

            return response()->json($exportHistory, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, int $id) {
        try {
            $exportHistory = ExportHistory::findOrFail($id);

            $validatedData = $req->validate([
                'export_type' => 'string|in:order,menu,report',
                'status' => 'string|in:pending,completed,failed',
                'file_path' => 'string|nullable',
                'user_id' => 'integer|nullable',
                'metadata' => 'json|nullable',
            ]);

            $exportHistory->update($validatedData);

            return response()->json($exportHistory, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (int $id) {
        try {
            $exportHistory = ExportHistory::findOrFail($id);
            $exportHistory->delete();

            return response()->json(['message' => 'Export History deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Export History not found'], 404);
        }
    });
});
});

Route::prefix('best-sellers')->group(function () {
    Route::get('/', function (Request $request) {
        $validated = $request->validate([
            'limit' => 'required|integer|min:1',
            'days' => 'required|integer|min:0',
        ]);

        if (! isset($validated['limit']) || ! isset($validated['days'])) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        $now = now();
        $endDate = $now->addDays(-$validated['days']);

        $bestSellers = DetailPesanan::select('menu_id')
            ->whereHas('pesanan', function ($query) use ($endDate) {
                $query->where('created_at', '>=', $endDate);
            })
            ->selectRaw('menu_id, SUM(jumlah) as total_sold')
            ->groupBy('menu_id')
            ->orderByDesc('total_sold')
            ->limit($validated['limit'])
            ->with('menu') // Assuming there's a relationship defined in DetailPesanan model
            ->get();

        return response()->json(['data' => $bestSellers], 200);
    });
});

Route::prefix('menu')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $has_id = $req->has('id');
            $has_select = $req->has('select');

            $query = Menu::query();

            if ($has_id) {
                $id = explode('.', $req['id'])[1];
                $query = $query->findOrFail($id);
            }

            if ($has_select) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }

            $query = $has_id ? $query->first() : $query->get();

            return response()->json(! $has_id ? ['data' => $query] : $query, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (int $id) {
        try {
            $menu = Menu::findOrFail($id);

            return response()->json($menu, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Menu not found'], 404);
        }
    });

    Route::delete('/{id}', function (int $id) {
        try {
            $menu = Menu::findOrFail($id);
            $menu->delete();

            return response()->json(['message' => 'Menu deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Menu not found'], 404);
        }
    });
    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'nama' => 'required|string|max:255',
                'harga' => 'required|numeric|min:0',
                'kategori_id' => 'required|integer|exists:kategori_menu,id',
                'available_variants' => 'array|nullable',
                'foto' => 'string|max:255|nullable',
                'stok' => 'integer|min:0|nullable',
                'is_active' => 'boolean|nullable',
            ]);

            $menu = Menu::create($validatedData);

            return response()->json($menu, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, int $id) {
        try {
            $menu = Menu::findOrFail($id);

            $validatedData = $req->validate([
                'nama' => 'string|max:255|nullable',
                'harga' => 'numeric|min:0|nullable',
                'kategori_id' => 'integer|exists:kategori_menu,id',
                'available_variants' => 'array||nullable',
                'foto' => 'string|max:255|nullable',
                'stok' => 'integer|min:0|nullable',
                'is_active' => 'boolean|nullable',
            ]);

            $menu->update($validatedData);

            return response()->json($menu, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });
});

Route::prefix('cafe_settings')->group(function () {
    Route::put('/', function (Request $req) {
        try {
            $cafeSetting = CafeSetting::firstOrFail();
            $cafeSetting->update($req->all());

            return response()->json(['message' => 'Cafe Setting Updated'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });
    Route::get('/', function (Request $req) {
        try {
            $query = CafeSetting::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            $res = $query->first();

            return response()->json($res, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });
});

Route::prefix('categories')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = KategoriMenu::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }

            return response()->json(['data' => $query->get()], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });
    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'nama' => 'required|string|max:255',
            ]);

            $kategori = KategoriMenu::create($validatedData);

            return response()->json($kategori, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });
});

Route::prefix('menu-additional-config')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = MenuAdditionalsConfig::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }

            return response()->json(['data' => $query->get()], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });
});

Route::prefix('additionals')->group(function () {
    Route::get('/', function (Request $req) {
            $query = Additional::query();

            if ($req->has('is_active')) {
                $is_active = explode('.', $req['is_active']);
                $query = $query->where('is_active', $is_active[0] == 'true' ? 1 : 0);
            }

            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }

            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                if(isset($order[1])){
                    $query = $query->orderBy($order[0], $order[1] ?? 'asc');
                }else{
                    $query = $query->orderBy('id', $order[1] ?? 'asc');
                }
            }

            $res = $query->get();

            return response()->json(['data' => $res], 200);
    });
});

Route::prefix('discount-codes')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = DiscountCode::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            if ($req->has('code')) {
                $query->where('code', $req->input('code'));
            }
            if ($req->has('is_active')) {
                $query->where('is_active', $req->input('is_active'));
            }
            if ($req->has('type')) {
                $query->where('type', $req->input('type'));
            }
            if ($req->has('min_amount')) {
                $query->where('min_amount', '<=', $req->input('min_amount'));
            }
            if ($req->has('max_discount_amount')) {
                $query->where('max_discount_amount', '>=', $req->input('max_discount_amount'));
            }
            if ($req->has('valid_from')) {
                $query->where('valid_from', '<=', $req->input('valid_from'));
            }
            if ($req->has('valid_to')) {
                $query->where('valid_to', '>=', $req->input('valid_to'));
            }
            if ($req->has('usage_limit')) {
                $query->where('usage_limit', '>=', $req->input('usage_limit'));
            }
            if ($req->has('used_count')) {
                $query->where('used_count', '<=', $req->input('used_count'));
            }
            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                $query = $query->orderBy($order[0], $order[1] ?? 'asc');
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (int $id) {
        try {
            $discountCode = DiscountCode::findOrFail($id);

            return response()->json($discountCode, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Discount Code not found'], 404);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'code' => 'required|string|unique:discount_codes,code',
                'type' => 'required|string|in:percentage,fixed',
                'value' => 'required|numeric|min:0',
                'is_active' => 'boolean',
                'min_amount' => 'numeric|min:0|nullable',
                'max_discount_amount' => 'numeric|min:0|nullable',
                'valid_from' => 'date|nullable',
                'valid_to' => 'date|after_or_equal:valid_from|nullable',
                'usage_limit' => 'integer|min:0|nullable',
                'used_count' => 'integer|min:0|nullable',
            ]);

            $discountCode = DiscountCode::create($validatedData);

            return response()->json($discountCode, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, int $id) {
        try {
            $discountCode = DiscountCode::findOrFail($id);

            $validatedData = $req->validate([
                'code' => 'string|unique:discount_codes,code,'.$id,
                'type' => 'string|in:percentage,fixed',
                'value' => 'numeric|min:0',
                'is_active' => 'boolean',
                'min_amount' => 'numeric|min:0|nullable',
                'max_discount_amount' => 'numeric|min:0|nullable',
                'valid_from' => 'date|nullable',
                'valid_to' => 'date|after_or_equal:valid_from|nullable',
                'usage_limit' => 'integer|min:0|nullable',
                'used_count' => 'integer|min:0|nullable',
            ]);

            $discountCode->update($validatedData);

            return response()->json($discountCode, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (int $id) {
        try {
            $discountCode = DiscountCode::findOrFail($id);
            $discountCode->delete();

            return response()->json(['message' => 'Discount Code deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Discount Code not found'], 404);
        }
    });

    // New method to apply a discount code
    Route::post('/apply', function (Request $req) {
        // try {
            $validated = $req->validate([
                'code' => 'required|string',
                'order_amount' => 'required|numeric|min:0',
            ]);

            $code = DiscountCode::where('code', $validated['code'])
                ->where('is_active', true)
                ->where(function ($q) {
                    $q->whereNull('valid_from')
                      ->orWhere('valid_from', '<=', now());
                })
                ->where(function ($q) {
                    $q->whereNull('valid_to')
                      ->orWhere('valid_to', '>=', now());
                })
                ->where(function ($q) use ($validated) {
                    $q->whereNull('min_amount')
                      ->orWhere('min_amount', '<=', $validated['order_amount']);
                })
                ->first();

            if (!$code) {
                return response()->json(['error' => 'Invalid or expired discount code'], 400);
            }

            $discount = 0;
            if ($code->type === 'percent') {
                $discount = $validated['order_amount'] * ($code->value / 100);
                if ($code->max_discount_amount && $discount > $code->max_discount_amount) {
                    $discount = $code->max_discount_amount;
                }
            } else { // fixed
                $discount = $code->value;
            }

            return response()->json([
                'discount_code' => $code->code,
                'discount_amount' => round($discount, 2),
                'total_after_discount' => round($validated['order_amount'] - $discount, 2),
            ], 200);
        // } catch (\Illuminate\Validation\ValidationException $e) {
        //     return response()->json(['errors' => $e->errors()], 422);
        // } catch (\Throwable $th) {
        //     return response()->json(['error' => 'Internal Server Error'], 500);
        // }
    });
});

Route::prefix('menu-additional-configs')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = MenuAdditionalConfig::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            if ($req->has('menu_id')) {
                $query->where('menu_id', $req->input('menu_id'));
            }
            if ($req->has('additional_id')) {
                $query->where('additional_id', $req->input('additional_id'));
            }
            if ($req->has('created_from')) {
                $query->where('created_at', '>=', $req->input('created_from'));
            }
            if ($req->has('created_to')) {
                $query->where('created_at', '<=', $req->input('created_to'));
            }
            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                $query = $query->orderBy($order[0], $order[1] ?? 'asc');
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('{id}', function ($id) {
        try {
            $res = MenuAdditionalConfig::find($id);
            if (!$res) {
                return response()->json(['error' => 'MenuAdditionalConfig not found'], 404);
            }
            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $validated = $req->validate([
                'menu_id' => 'required|exists:menus,id',
                'additional_id' => 'required|exists:additionals,id',
            ]);

            $res = new MenuAdditionalConfig();
            $res->menu_id = $validated['menu_id'];
            $res->additional_id = $validated['additional_id'];
            $res->save();

            return response()->json(['data' => $res], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('{id}', function (Request $req, $id) {
        try {
            $res = MenuAdditionalConfig::find($id);
            if (!$res) {
                return response()->json(['error' => 'MenuAdditionalConfig not found'], 404);
            }

            $validated = $req->validate([
                'menu_id' => 'sometimes|exists:menus,id',
                'additional_id' => 'sometimes|exists:additionals,id',
            ]);

            if (isset($validated['menu_id'])) {
                $res->menu_id = $validated['menu_id'];
            }
            if (isset($validated['additional_id'])) {
                $res->additional_id = $validated['additional_id'];
            }
            $res->save();

            return response()->json(['data' => $res], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('{id}', function ($id) {
        try {
            $res = MenuAdditionalConfig::find($id);
            if (!$res) {
                return response()->json(['error' => 'MenuAdditionalConfig not found'], 404);
            }
            $res->delete();
            return response()->json(['message' => 'MenuAdditionalConfig deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });
});

Route::prefix('menu_additional_config')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = MenuAdditionalsConfig::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }

            $res = [];

            foreach ($query->get() as $key => $value) {
                $res['data'][] = [
                    'menu_id' => $value->menu_id,
                    'final_support_additional' => $value->final_support_additional,
                    'final_support_dimsum_additional' => $value->final_support_dimsum_additional,
                ];
            }

            return response()->json($res, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });
});

Route::prefix('menu_allowed_additionals')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = MenuAllowedAdditionals::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            if ($req->has('menu_id')) {
                $query->where('menu_id', $req->input('menu_id'));
            }
            if ($req->has('additional_id')) {
                $query->where('additional_id', $req->input('additional_id'));
            }
            if ($req->has('created_from')) {
                $query->where('created_at', '>=', $req->input('created_from'));
            }
            if ($req->has('created_to')) {
                $query->where('created_at', '<=', $req->input('created_to'));
            }
            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                $query = $query->orderBy($order[0], $order[1] ?? 'asc');
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (int $id) {
        try {
            $menuAllowedAdditionals = MenuAllowedAdditionals::findOrFail($id);

            return response()->json($menuAllowedAdditionals, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Menu Allowed Additionals not found'], 404);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'menu_id' => 'required|integer',
                'additional_id' => 'required|integer',
            ]);

            $menuAllowedAdditionals = MenuAllowedAdditionals::create($validatedData);

            return response()->json($menuAllowedAdditionals, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, int $id) {
        try {
            $menuAllowedAdditionals = MenuAllowedAdditionals::findOrFail($id);

            $validatedData = $req->validate([
                'menu_id' => 'integer',
                'additional_id' => 'integer',
            ]);

            $menuAllowedAdditionals->update($validatedData);

            return response()->json($menuAllowedAdditionals, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (int $id) {
        try {
            $menuAllowedAdditionals = MenuAllowedAdditionals::findOrFail($id);
            $menuAllowedAdditionals->delete();

            return response()->json(['message' => 'Menu Allowed Additionals deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Menu Allowed Additionals not found'], 404);
        }
    });
});


Route::prefix('menu-allowed-additionals')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = MenuAllowedAdditionals::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            if ($req->has('menu_id')) {
                $query->where('menu_id', $req->input('menu_id'));
            }
            if ($req->has('additional_id')) {
                $query->where('additional_id', $req->input('additional_id'));
            }
            if ($req->has('created_from')) {
                $query->where('created_at', '>=', $req->input('created_from'));
            }
            if ($req->has('created_to')) {
                $query->where('created_at', '<=', $req->input('created_to'));
            }
            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                $query = $query->orderBy($order[0], $order[1] ?? 'asc');
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (int $id) {
        try {
            $menuAllowedAdditionals = MenuAllowedAdditionals::findOrFail($id);

            return response()->json($menuAllowedAdditionals, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Menu Allowed Additionals not found'], 404);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'menu_id' => 'required|integer',
                'additional_id' => 'required|integer',
            ]);

            $menuAllowedAdditionals = MenuAllowedAdditionals::create($validatedData);

            return response()->json($menuAllowedAdditionals, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, int $id) {
        try {
            $menuAllowedAdditionals = MenuAllowedAdditionals::findOrFail($id);

            $validatedData = $req->validate([
                'menu_id' => 'integer',
                'additional_id' => 'integer',
            ]);

            $menuAllowedAdditionals->update($validatedData);

            return response()->json($menuAllowedAdditionals, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (int $id) {
        try {
            $menuAllowedAdditionals = MenuAllowedAdditionals::findOrFail($id);
            $menuAllowedAdditionals->delete();

            return response()->json(['message' => 'Menu Allowed Additionals deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Menu Allowed Additionals not found'], 404);
        }
    });
});

Route::prefix('pesanan')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = Pesanan::query();
            if ($req->has('select')) {
                $select = explode(',', $req->select);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (int $id) {
        $res = Pesanan::findOrFail($id);

        return response()->json($res, 200);
    });

    Route::post('/', function (Request $req) {
        $payload = [
            'no_meja' => $req->no_meja,
            'status' => $req->status,
            'total' => $req->total,
            'note' => $req->note,
            'cancellation_reason' => $req->cancellation_reason,
            'cancelled_at' => $req->cancelled_at,
            'location_type' => $req->location_type,
            'pickup_time' => $req->pickup_time,
            'discount_code' => $req->discount_code,
            'discount_amount' => $req->discount_amount,
            'total_after_discount' => $req->total_after_discount,
            'processed_at' => $req->processed_at,
            'completed_at' => $req->completed_at,
            'is_hidden' => $req->is_hidden,
            'archived_at' => $req->archived_at,
            'location_area' => $req->location_area,
            'metode_pembayaran' => $req->metode_pembayaran,
            'bank_qris' => $req->bank_qris,
            'is_final' => $req->is_final,
        ];

        $new = Pesanan::create($payload);

        return response()->json(['status' => true, 'id' => $new->id], 201);
    });
});

Route::prefix('detail_pesanan')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = DetailPesanan::query();
            if ($req->has('select')) {
                $select = explode(',', $req->select);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (int $id) {
        $res = DetailPesanan::findOrFail($id);

        return response()->json($res, 200);
    });

    Route::post('/', function (Request $req) {
        foreach ($req->all() as $key => $value) {
            $payload = [
                'pesanan_id' => $value['pesanan_id'],
                'menu_id' => $value['menu_id'],
                'jumlah' => $value['jumlah'],
                'subtotal' => $value['subtotal'],
                'note' => $value['note'],
                'varian' => $value['varian'],
                'additionals' => $value['additionals'],
                'dimsum_additionals' => $value['dimsum_additionals'],
                'additional_price' => $value['additional_price'],
                'base_price' => $value['base_price'],
                'is_locked' => $value['is_locked'],
            ];

            DetailPesanan::create($payload);
        }

        return response()->json(['status' => true], 201);
    });
});

Route::prefix('auth')->group(function () {
    Route::post('/login', function (Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->where('password', $credentials['password'])->first();

        if (!$user){
            return response()->json(['status'=> false],400);
        }

        // Generate bearer token using Sanctum
        $tokenData = [
            'access_token' => 'aosdoasoidoiajsdkwoaijdosa',
            'token_type' => 'Bearer',
            'expires_in' => 3600,
            'expires_at' => now()->addHours(1)->toDateTimeString(),
            'refresh_token' => Str::random(40),
            'last_sign_in_at' => now()->toDateTimeString(),
        ];
        return response()->json([
            'access_token' => $tokenData['access_token'],
            'token_type' => $tokenData['token_type'],
            'expires_in' => $tokenData['expires_in'],
            'expires_at' => $tokenData['expires_at'],
            'refresh_token' => $tokenData['refresh_token'],
            'user' => [
                'id' => $user->id,
                'aud' => 'authenticated',
                'role' => 'authenticated',
                'email' => $user->email,
                'email_confirmed_at' => $user->email_verified_at,
                'phone' => $user->phone ?? '',
                'confirmed_at' => $user->email_verified_at,
                'last_sign_in_at' => $tokenData['last_sign_in_at'],
                'app_metadata' => [
                    'provider' => 'email',
                    'providers' => ['email'],
                ],
                'user_metadata' => [
                    'email_verified' => (bool) $user->email_verified_at,
                ],
                'identities' => [
                    [
                        'identity_id' => $user->id,
                        'id' => $user->id,
                        'user_id' => $user->id,
                        'identity_data' => [
                            'email' => $user->email,
                            'email_verified' => (bool) $user->email_verified_at,
                            'phone_verified' => false,
                            'sub' => $user->id,
                        ],
                        'provider' => 'email',
                        'last_sign_in_at' => $tokenData['last_sign_in_at'],
                        'created_at' => $user->created_at,
                        'updated_at' => $user->updated_at,
                        'email' => $user->email,
                    ],
                ],
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'is_anonymous' => false,
            ],
            'weak_password' => null,
        ]);
    });
});

Route::prefix('discount_codes')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = DiscountCode::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $discountCode = DiscountCode::create($req->all());

            return response()->json(['data' => $discountCode, 'message' => 'Discount Code Created'], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, string $id) {
        try {
            $discountCode = DiscountCode::findOrFail($id);
            $discountCode->update($req->all());

            return response()->json(['data' => $discountCode, 'message' => 'Discount Code Updated'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (string $id) {
        try {
            $discountCode = DiscountCode::findOrFail($id);
            $discountCode->delete();

            return response()->json(['message' => 'Discount Code Deleted'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });
});

Route::prefix('export_histories')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = ExportHistory::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $exportHistory = ExportHistory::create($req->all());

            return response()->json(['data' => $exportHistory, 'message' => 'Export History Created'], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, string $id) {
        try {
            $exportHistory = ExportHistory::findOrFail($id);
            $exportHistory->update($req->all());

            return response()->json(['data' => $exportHistory, 'message' => 'Export History Updated'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (string $id) {
        try {
            $exportHistory = ExportHistory::findOrFail($id);
            $exportHistory->delete();

            return response()->json(['message' => 'Export History Deleted'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });
});

Route::prefix('history_archives')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = HistoryArchive::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $historyArchive = HistoryArchive::create($req->all());

            return response()->json(['data' => $historyArchive, 'message' => 'History Archive Created'], 201);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, string $id) {
        try {
            $historyArchive = HistoryArchive::findOrFail($id);
            $historyArchive->update($req->all());

            return response()->json(['data' => $historyArchive, 'message' => 'History Archive Updated'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (string $id) {
        try {
            $historyArchive = HistoryArchive::findOrFail($id);
            $historyArchive->delete();

            return response()->json(['message' => 'History Archive Deleted'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });
});

Route::prefix('pemasukan-lains')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = PemasukanLain::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            if ($req->has('kategori')) {
                $query->where('kategori', $req->input('kategori'));
            }
            if ($req->has('created_by')) {
                $query->where('created_by', $req->input('created_by'));
            }
            if ($req->has('tanggal_from')) {
                $query->where('tanggal', '>=', $req->input('tanggal_from'));
            }
            if ($req->has('tanggal_to')) {
                $query->where('tanggal', '<=', $req->input('tanggal_to'));
            }
            if ($req->has('jumlah_min')) {
                $query->where('jumlah', '>=', $req->input('jumlah_min'));
            }
            if ($req->has('jumlah_max')) {
                $query->where('jumlah', '<=', $req->input('jumlah_max'));
            }
            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                $query = $query->orderBy($order[0], $order[1] ?? 'asc');
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (string $id) {
        try {
            $pemasukanLain = PemasukanLain::findOrFail($id);

            return response()->json($pemasukanLain, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Pemasukan Lain not found'], 404);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'id' => 'required|string|unique:pemasukan_lain,id',
                'kategori' => 'required|string',
                'deskripsi' => 'string|nullable',
                'jumlah' => 'required|numeric',
                'tanggal' => 'required|date',
                'created_by' => 'string|nullable',
                'bukti_url' => 'string|nullable',
            ]);

            $pemasukanLain = PemasukanLain::create($validatedData);

            return response()->json($pemasukanLain, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, string $id) {
        try {
            $pemasukanLain = PemasukanLain::findOrFail($id);

            $validatedData = $req->validate([
                'kategori' => 'string',
                'deskripsi' => 'string|nullable',
                'jumlah' => 'numeric',
                'tanggal' => 'date',
                'created_by' => 'string|nullable',
                'bukti_url' => 'string|nullable',
            ]);

            $pemasukanLain->update($validatedData);

            return response()->json($pemasukanLain, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (string $id) {
        try {
            $pemasukanLain = PemasukanLain::findOrFail($id);
            $pemasukanLain->delete();

            return response()->json(['message' => 'Pemasukan Lain deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Pemasukan Lain not found'], 404);
        }
    });
});

Route::prefix('pengeluarans')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = Pengeluaran::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            if ($req->has('kategori')) {
                $query->where('kategori', $req->input('kategori'));
            }
            if ($req->has('created_by')) {
                $query->where('created_by', $req->input('created_by'));
            }
            if ($req->has('tanggal_from')) {
                $query->where('tanggal', '>=', $req->input('tanggal_from'));
            }
            if ($req->has('tanggal_to')) {
                $query->where('tanggal', '<=', $req->input('tanggal_to'));
            }
            if ($req->has('jumlah_min')) {
                $query->where('jumlah', '>=', $req->input('jumlah_min'));
            }
            if ($req->has('jumlah_max')) {
                $query->where('jumlah', '<=', $req->input('jumlah_max'));
            }
            if ($req->has('start_date')) {
                $query->where('tanggal', '>=', $req->input('start_date'));
            }
            if ($req->has('end_date')) {
                $query->where('tanggal', '<=', $req->input('end_date'));
            }
            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                $query = $query->orderBy($order[0], $order[1] ?? 'asc');
            }
            $res = $query->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (string $id) {
        try {
            $pengeluaran = Pengeluaran::findOrFail($id);

            return response()->json($pengeluaran, 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Pengeluaran not found'], 404);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'id' => 'required|string|unique:pengeluaran,id',
                'kategori' => 'required|string',
                'deskripsi' => 'string|nullable',
                'jumlah' => 'required|numeric',
                'tanggal' => 'required|date',
                'created_by' => 'string|nullable',
                'bukti_url' => 'string|nullable',
                'foto_url' => 'string|nullable',
            ]);

            $pengeluaran = Pengeluaran::create($validatedData);

            return response()->json($pengeluaran, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, string $id) {
        try {
            $pengeluaran = Pengeluaran::findOrFail($id);

            $validatedData = $req->validate([
                'kategori' => 'string',
                'deskripsi' => 'string|nullable',
                'jumlah' => 'numeric',
                'tanggal' => 'date',
                'created_by' => 'string|nullable',
                'bukti_url' => 'string|nullable',
                'foto_url' => 'string|nullable',
            ]);

            $pengeluaran->update($validatedData);

            return response()->json($pengeluaran, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (string $id) {
        try {
            $pengeluaran = Pengeluaran::findOrFail($id);
            $pengeluaran->delete();

            return response()->json(['message' => 'Pengeluaran deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Pengeluaran not found'], 404);
        }
    });
});

Route::prefix('pesanans')->group(function () {
    Route::get('/', function (Request $req) {
        try {
            $query = Pesanan::query();
            if ($req->has('select')) {
                $select = explode(',', $req['select']);
                if (in_array('*', $select)) {
                    $query = $query->select('*');
                } else {
                    $query = $query->select($select);
                }
            }
            if ($req->has('no_meja')) {
                $query->where('no_meja', $req->input('no_meja'));
            }
            if ($req->has('location_type')) {
                $input = strtolower($req->input('location_type'));
                $input = str_replace('-', '_', $input);
                $query->whereRaw('LOWER(REPLACE(location_type, "-", "_")) = ?', [$input]);
            }
            if ($req->has('status')) {
                $query->where('status', explode(',',$req->input('status')));
            }
            if ($req->has('discount_code')) {
                $query->where('discount_code', $req->input('discount_code'));
            }
            if ($req->has('is_hidden')) {
                $query->where('is_hidden', $req->input('is_hidden'));
            }
            if ($req->has('is_final')) {
                $query->where('is_final', $req->input('is_final'));
            }
            if ($req->has('total_min')) {
                $query->where('total', '>=', $req->input('total_min'));
            }
            if ($req->has('total_max')) {
                $query->where('total', '<=', $req->input('total_max'));
            }
            if ($req->has('created_from')) {
                $query->where('created_at', '>=', $req->input('created_from'));
            }
            if ($req->has('created_to')) {
                $query->where('created_at', '<=', $req->input('created_to'));
            }
            if ($req->has('payment_date')){
                $query->whereDate('updated_at', $req->input('payment_date'));
            }
            if ($req->has('order')) {
                $order = explode('.', $req['order']);
                $query = $query->orderBy($order[0], $order[1] ?? 'asc');
            }
            $res = $query->with('detailPesanans')->get();

            return response()->json(['data' => $res], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::get('/{id}', function (int $id) {
        try {
            $pesanan = Pesanan::findOrFail($id);

            return response()->json($pesanan->with('detailPesanans')->first(), 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Pesanan not found'], 404);
        }
    });

    Route::post('/', function (Request $req) {
        try {
            $validatedData = $req->validate([
                'no_meja' => 'integer|nullable',
                'status' => 'required|string|in:pending,processed,completed,cancelled',
                'total' => 'required|numeric',
                'note' => 'string|nullable',
                'cancellation_reason' => 'string|nullable',
                'cancelled_at' => 'date|nullable',
                'location_type' => 'string|in:dine_in,take_away,delivery|nullable',
                'pickup_time' => 'date|nullable',
                'discount_code' => 'string|nullable',
                'discount_amount' => 'numeric|nullable',
                'total_after_discount' => 'numeric|nullable',
                'processed_at' => 'date|nullable',
                'completed_at' => 'date|nullable',
                'is_hidden' => 'boolean',
                'archived_at' => 'date|nullable',
                'location_area' => 'string|nullable',
                'metode_pembayaran' => 'string|nullable',
                'bank_qris' => 'string|nullable',
                'is_final' => 'boolean',
            ]);

            $pesanan = Pesanan::create($validatedData);

            return response()->json($pesanan, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::put('/{id}', function (Request $req, int $id) {
        try {
            $pesanan = Pesanan::findOrFail($id);

            $validatedData = $req->validate([
                'no_meja' => 'integer|nullable',
                'status' => 'string|in:pending,diproses,selesai,cancelled',
                'total' => 'numeric|nullable',
                'note' => 'string|nullable',
                'cancellation_reason' => 'string|nullable',
                'cancelled_at' => 'date|nullable',
                'location_type' => 'string|in:dine_in,take_away,delivery|nullable',
                'pickup_time' => 'date|nullable',
                'discount_code' => 'string|nullable',
                'discount_amount' => 'numeric|nullable',
                'total_after_discount' => 'numeric|nullable',
                'processed_at' => 'date|nullable',
                'completed_at' => 'date|nullable',
                'is_hidden' => 'boolean|nullable',
                'archived_at' => 'date|nullable',
                'location_area' => 'string|nullable',
                'metode_pembayaran' => 'string|nullable',
                'bank_qris' => 'string|nullable',
                'is_final' => 'boolean|nullable',
            ]);

            $pesanan->update($validatedData);

            return response()->json($pesanan, 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    });

    Route::delete('/{id}', function (int $id) {
        try {
            $pesanan = Pesanan::findOrFail($id);
            $pesanan->delete();

            return response()->json(['message' => 'Pesanan deleted successfully'], 204);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Pesanan not found'], 404);
        }
    });
});

Route::prefix('images')->group(function () {
    Route::post('/upload', function (Request $req) {
        try {
            $validated = $req->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp', // Max 5MB
                'folder' => 'string|nullable', // Optional subfolder
                'quality' => 'integer|min:1|max:100|nullable', // Compression quality (default: 80)
            ]);

            $image = $req->file('image');
            $folder = $validated['folder'] ?? 'general';
            $quality = $validated['quality'] ?? 80; // Default compression quality
            
            $originalSize = $image->getSize();
            $mimeType = $image->getMimeType();
            $extension = $image->getClientOriginalExtension();
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $extension;
            
            // Create directory if it doesn't exist
            $storagePath = storage_path('app/public/images/' . $folder);
            if (!file_exists($storagePath)) {
                mkdir($storagePath, 0755, true);
            }
            
            $fullPath = $storagePath . '/' . $filename;
            
            // Compress and save image based on type
            $imageResource = null;
            $compressed = false;
            
            switch ($mimeType) {
                case 'image/jpeg':
                case 'image/jpg':
                    $imageResource = imagecreatefromjpeg($image->getRealPath());
                    if ($imageResource) {
                        imagejpeg($imageResource, $fullPath, $quality);
                        $compressed = true;
                    }
                    break;
                    
                case 'image/png':
                    $imageResource = imagecreatefrompng($image->getRealPath());
                    if ($imageResource) {
                        // PNG compression level: 0 (no compression) to 9 (max compression)
                        $pngQuality = floor((100 - $quality) / 11);
                        imagepng($imageResource, $fullPath, $pngQuality);
                        $compressed = true;
                    }
                    break;
                    
                case 'image/webp':
                    $imageResource = imagecreatefromwebp($image->getRealPath());
                    if ($imageResource) {
                        imagewebp($imageResource, $fullPath, $quality);
                        $compressed = true;
                    }
                    break;
                    
                case 'image/gif':
                    $imageResource = imagecreatefromgif($image->getRealPath());
                    if ($imageResource) {
                        imagegif($imageResource, $fullPath);
                        $compressed = true;
                    }
                    break;
                    
                default:
                    // Fallback: just move the file without compression
                    $image->storeAs('images/' . $folder, $filename, 'public');
                    break;
            }
            
            // Free up memory
            if ($imageResource) {
                imagedestroy($imageResource);
            }
            
            // If compression failed, use original file
            if (!$compressed && !file_exists($fullPath)) {
                $image->storeAs('images/' . $folder, $filename, 'public');
            }
            
            $path = 'images/' . $folder . '/' . $filename;
            $compressedSize = file_exists($fullPath) ? filesize($fullPath) : $originalSize;
            
            // Generate full URL
            $url = url('storage/' . $path);
            
            return response()->json([
                'success' => true,
                'message' => 'Image uploaded and compressed successfully',
                'data' => [
                    'filename' => $filename,
                    'path' => $path,
                    'url' => $url,
                    'full_url' => $url,
                    'original_size' => $originalSize,
                    'compressed_size' => $compressedSize,
                    'size_reduction' => round((($originalSize - $compressedSize) / $originalSize) * 100, 2) . '%',
                    'mime_type' => $mimeType,
                    'quality' => $quality,
                ]
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to upload image',
                'message' => $th->getMessage()
            ], 500);
        }
    });

    Route::get('/{folder}/{filename}', function (string $folder, string $filename) {
        try {
            $filePath = storage_path('app/public/images/' . $folder . '/' . $filename);
            
            if (!file_exists($filePath)) {
                return response()->json(['error' => 'Image not found'], 404);
            }
            
            return response()->file($filePath);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to retrieve image'], 500);
        }
    });

    Route::delete('/{folder}/{filename}', function (string $folder, string $filename) {
        try {
            $filePath = storage_path('app/public/images/' . $folder . '/' . $filename);
            
            if (!file_exists($filePath)) {
                return response()->json(['error' => 'Image not found'], 404);
            }
            
            unlink($filePath);
            
            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to delete image'
            ], 500);
        }
    });
});