<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\master\Manpower;

class ManpowerController extends BaseController
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->page = 'Manpower';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-37');

        Log::channel('mibedil')->info('Halaman '.$this->page);

        if ($request->ajax()) {
            $search = $request->search;
            $data = [];
            $count = 0;
            $page = $request->get('start', 0);  
            $perpage = $request->get('length',50); 

            try {
                $manpower = DB::table('tbmmanpower')
                    ->select('tbmmanpower.*')
                    ->where('tbmmanpower.dlt', '0')
                    ->where(function($query) use ($search)
                    {
                        // if (!is_null($provid) && $provid!='') $query->where('tbmkota.provid', $provid);
                        if (!is_null($search) && $search!='') {
                            // $query->where(DB::raw('CONCAT(tbmkota.kodekota, tbmkota.namakota)'), 'ilike', '%'.$search.'%');
                            // $query->where(DB::raw('tbmmanpower.'), 'ilike', '%'.$search.'%');
                            $query->where(DB::raw('tbmmanpower.nama'), 'ilike', '%'.$search.'%');
                        }
                    })
                    ->orderBy('tbmmanpower.nama')
                ;
                $count = $manpower->count();
                $data = $manpower->skip($page)->take($perpage)->get();


            }catch (QueryException $e) {
                return $this->sendError('SQL Error', $this->getQueryError($e));
            }
            catch (Exception $e) {
                return $this->sendError('Error', $e->getMessage());
            }

            return $this->sendResponse([
                'data' => $data,
                'count' => $count
            ], 'manpower retrieved successfully.'); 
        }
        return view(
            'master.manpower.index', 
            [
                'page' => $this->page, 
                'createbutton' => true, 
                'createurl' => route('manpower.create'), 
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
        $this->authorize('add-37');

        Log::channel('mibedil')->info('Halaman Tambah '.$this->page);

        return view(
            'master.manpower.create', 
            [
                'page' => $this->page, 
                'child' => 'Tambah Data', 
                'masterurl' => route('manpower.index'), 
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
        $this->authorize('add-37');

        try
        {
            $user = auth('sanctum')->user();
            $model = new Manpower();

            DB::beginTransaction();

            $model->nama = $request->nama;
            $model->category = $request->category;
            $model->jabatan = $request->jabatan;
            $model->tgljoin = $request->tgljoin;
            $model->status = isset($request->status) ? 1 : 0;
            
            $model->fill(['opadd' => $user->login, 'pcadd' => $request->ip()]);

            $model->save();

            DB::commit();

            return redirect()->route('manpower.index')
            ->with('success', 'Data manpower berhasil ditambah.', ['page' => $this->page]);
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
        $this->authorize('view-37');

        Log::channel('mibedil')->info('Halaman Lihat '.$this->page, ['id' => $id]);

        $manpower = Manpower::find($id)->firstOrFail();

        return view(
            'master.manpower.show', 
            [
                'page' => $this->page, 
                'child' => 'Lihat Data', 
                'masterurl' => route('manpower.index'), 
                'manpower' => $manpower
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
        $this->authorize('edit-37');

        Log::channel('mibedil')->info('Halaman Ubah '.$this->page, ['id' => $id]);
        $manpower = Manpower::find($id);

        return view(
            'master.manpower.edit', 
            [
                'page' => $this->page, 
                'createbutton' => true, 
                'createurl' => route('manpower.create'), 
                'child' => 'Ubah Data', 
                'manpower' => $manpower,
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
        $this->authorize('edit-37');

        $user = auth('sanctum')->user();

        try {
            DB::beginTransaction();

            $manpower = Manpower::find($id);
            $manpower->nama = $request->nama;
            $manpower->category = $request->category;
            $manpower->jabatan = $request->jabatan;
            $manpower->tgljoin = $request->tgljoin;
            $manpower->status = isset($request->status) ? 1 : 0;

            $manpower->fill(['opedit' => $user->login, 'pcedit' => $request->ip()]);

            $manpower->save();

            DB::commit();
        }
        catch (QueryException $e) {
            return $this->sendError('SQL Error', $this->getQueryError($e));
        }
        catch (Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }

        return redirect()->route('manpower.index')
                ->with('success', 'Data manpower berhasil diubah.', ['page' => $this->page]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize('delete-37');

        $user = auth('sanctum')->user();

        $manpower = Manpower::find($id);

        $manpower->dlt = '1';

        $manpower->fill(['opedit' => $user->login, 'pcedit' => $request->ip()]);

        $manpower->save();

        return response([
            'success' => true,
            'data'    => 'Success',
            'message' => 'Manpower deleted successfully.',
        ], 200);
    }
}
