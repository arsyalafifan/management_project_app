<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\master\Material;

class MaterialController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->page = 'Material';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-36');

        Log::channel('mibedil')->info('Halaman '.$this->page);

        if ($request->ajax()) {
            $search = $request->search;
            $data = [];
            $count = 0;
            $page = $request->get('start', 0);  
            $perpage = $request->get('length',50); 

            try {
                $material = DB::table('tbmmaterial')
                    ->select('tbmmaterial.*')
                    ->where('tbmmaterial.dlt', '0')
                    ->where(function($query) use ($search)
                    {
                        // if (!is_null($provid) && $provid!='') $query->where('tbmkota.provid', $provid);
                        if (!is_null($search) && $search!='') {
                            // $query->where(DB::raw('CONCAT(tbmkota.kodekota, tbmkota.namakota)'), 'ilike', '%'.$search.'%');
                            // $query->where(DB::raw('tbmmaterial.'), 'ilike', '%'.$search.'%');
                            $query->where(DB::raw('tbmmaterial.nama'), 'ilike', '%'.$search.'%');
                        }
                    })
                    ->orderBy('tbmmaterial.nama')
                ;
                $count = $material->count();
                $data = $material->skip($page)->take($perpage)->get();


            }catch (QueryException $e) {
                return $this->sendError('SQL Error', $this->getQueryError($e));
            }
            catch (Exception $e) {
                return $this->sendError('Error', $e->getMessage());
            }

            return $this->sendResponse([
                'data' => $data,
                'count' => $count
            ], 'material retrieved successfully.'); 
        }
        return view(
            'master.material.index', 
            [
                'page' => $this->page, 
                'createbutton' => true, 
                'createurl' => route('material.create'), 
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('add-36');

        Log::channel('mibedil')->info('Halaman Tambah '.$this->page);

        return view(
            'master.material.create', 
            [
                'page' => $this->page, 
                'child' => 'Tambah Data', 
                'masterurl' => route('material.index'), 
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('add-36');

        try
        {
            $user = auth('sanctum')->user();
            $model = new Material();

            DB::beginTransaction();

            $model->nama = $request->nama;
            $model->category = $request->category;
            $model->stock = $request->stock;
            
            $model->fill(['opadd' => $user->login, 'pcadd' => $request->ip()]);

            $model->save();

            DB::commit();

            return redirect()->route('material.index')
            ->with('success', 'Data materials berhasil ditambah.', ['page' => $this->page]);
        }catch(\Throwable $th)
        {
            return response(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view-36');

        Log::channel('mibedil')->info('Halaman Lihat '.$this->page, ['id' => $id]);

        $material = Material::where('materialid', $id)->where('dlt', '0')->firstOrFail();

        return view(
            'master.material.show', 
            [
                'page' => $this->page, 
                'child' => 'Lihat Data', 
                'masterurl' => route('material.index'), 
                'material' => $material
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit-36');

        Log::channel('mibedil')->info('Halaman Ubah '.$this->page, ['id' => $id]);
        $material = Material::where('materialid', $id)->where('dlt', '0')->firstOrFail();

        return view(
            'master.material.edit', 
            [
                'page' => $this->page, 
                'createbutton' => true, 
                'createurl' => route('material.create'), 
                'child' => 'Ubah Data', 
                'material' => $material,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('edit-36');

        $user = auth('sanctum')->user();

        try {
            DB::beginTransaction();

            $material = Material::find($id);
            $material->nama = $request->nama;
            $material->category = $request->category;
            $material->stock = $request->stock;

            $material->fill(['opedit' => $user->login, 'pcedit' => $request->ip()]);

            $material->save();

            DB::commit();
        }
        catch (QueryException $e) {
            return $this->sendError('SQL Error', $this->getQueryError($e));
        }
        catch (Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }

        return redirect()->route('material.index')
                ->with('success', 'Data material berhasil diubah.', ['page' => $this->page]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize('delete-36');

        $user = auth('sanctum')->user();

        $material = Material::find($id);

        $material->dlt = '1';

        $material->fill(['opedit' => $user->login, 'pcedit' => $request->ip()]);

        $material->save();

        return response([
            'success' => true,
            'data'    => 'Success',
            'message' => 'material deleted successfully.',
        ], 200);
    }
}
