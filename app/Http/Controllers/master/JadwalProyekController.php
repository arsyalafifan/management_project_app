<?php

namespace App\Http\Controllers\master;


use App\Models\master\JadwalProyek;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;

class JadwalProyekController extends BaseController
{

    public function __construct()
    {
	     $this->page = 'JadwalProyek';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $this->authorize('view-37');
        // Log::channel('mibedil')->info('Halaman '.$this->page);

        if ($request->ajax()) {
            $search = $request->search;
            $data = [];
            $count = 0;
            $page = $request->get('start', 0);  
            $perpage = $request->get('length',50); 

            try {
                $jadwalproyek = DB::table('tbjadwalproyek')
                    ->select('tbjadwalproyek.*')
                    ->where('tbjadwalproyek.dlt', '0')
                    ->where(function($query) use ($search)
                    {
                        // if (!is_null($provid) && $provid!='') $query->where('tbmkota.provid', $provid);
                        if (!is_null($search) && $search!='') {
                            // $query->where(DB::raw('CONCAT(tbmkota.kodekota, tbmkota.namakota)'), 'ilike', '%'.$search.'%');
                            // $query->where(DB::raw('tbjadwalproyek.'), 'ilike', '%'.$search.'%');
                            $query->where(DB::raw('tbjadwalproyek.namaproyek'), 'ilike', '%'.$search.'%');
                        }
                    })
                    ->orderBy('tbjadwalproyek.namaproyek')
                ;
                $count = $jadwalproyek->count();
                $data = $jadwalproyek->skip($page)->take($perpage)->get();


            }catch (QueryException $e) {
                return $this->sendError('SQL Error', $this->getQueryError($e));
            }
            catch (Exception $e) {
                return $this->sendError('Error', $e->getMessage());
            }

            return $this->sendResponse([
                'data' => $data,
                'count' => $count
            ], 'jadwalproyek retrieved successfully.'); 
        }
        return view(
            'master.jadwalproyek.index', 
            [
                'page' => $this->page, 
                'createbutton' => true, 
                'createurl' => route('jadwalproyek.create'), 
            ]
        );
    }

    public function listJadwal(Request $request)
    {
        $start = date('Y-m-d', strtotime($request->start));
        $end = date('Y-m-d', strtotime($request->end));

        $jadwal = JadwalProyek::where('startdate', '>=', $start)->where('finishdate', '<=', $end)->where('dlt', 0)->get()
        ->map(fn ($item) => [
            'id' => $item->jadwalproyekid,
            'title' => $item->namaproyek,
            'start' => $item->startdate,
            'end' => $item->finishdate
        ])
        ;
        // dd($jadwal);
        return response()->json($jadwal);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('add-37');

        // Log::channel('mibedil')->info('Halaman Tambah '.$this->page);

        return view(
            'master.jadwalproyek.create', 
            [
                'page' => $this->page, 
                'child' => 'Tambah Data', 
                'masterurl' => route('jadwalproyek.index'), 
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
        // $this->authorize('add-37');

        try
        {
            $user = auth('sanctum')->user();
            $model = new JadwalProyek();

            DB::beginTransaction();

            $model->namaproyek = $request->namaproyek;
            $model->location = $request->location;
            $model->startdate = $request->startdate;
            $model->finishdate = $request->finishdate;
            // $model->status = isset($request->status) ? 1 : 0;
            
            $model->fill(['opadd' => $user->login, 'pcadd' => $request->ip()]);

            $model->save();

            DB::commit();

            return redirect()->route('jadwalproyek.index')
            ->with('success', 'Data proyek berhasil ditambah.', ['page' => $this->page]);
        }catch(\Throwable $th)
        {
            return response(['error' => $th->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JadwalController  $jadwalController
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$this->authorize('view-37');

        //Log::channel('mibedil')->info('Halaman Lihat '.$this->page, ['id' => $id]);

        $jadwalproyek = JadwalProyek::find($id);

        return view(
            'master.jadwalproyek.show', 
            [
                'page' => $this->page, 
                'child' => 'Lihat Data', 
                'masterurl' => route('jadwalproyek.index'), 
                'jadwalproyek' => $jadwalproyek
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JadwalProyek  $JadwalProyek
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $this->authorize('edit-37');

        // Log::channel('mibedil')->info('Halaman Ubah '.$this->page, ['id' => $id]);
        $jadwalproyek = JadwalProyek::find($id);

        return view(
            'master.jadwalproyek.edit', 
            [
                'page' => $this->page, 
                'createbutton' => true, 
                'createurl' => route('jadwalproyek.create'), 
                'child' => 'Ubah Data', 
                'jadwalproyek' => $jadwalproyek,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JadwalProyek  $JadwalProyek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->authorize('edit-37');

        $user = auth('sanctum')->user();

        try {
            DB::beginTransaction();

            $jadwalproyek = JadwalProyek::find($id);
            $jadwalproyek->namaproyek = $request->namaproyek;
            $jadwalproyek->location = $request->location;
            $jadwalproyek->startdate = $request->startdate;
            $jadwalproyek->finishdate = $request->finishdate;

            $jadwalproyek->fill(['opedit' => $user->login, 'pcedit' => $request->ip()]);

            $jadwalproyek->save();

            DB::commit();
        }
        catch (QueryException $e) {
            return $this->sendError('SQL Error', $this->getQueryError($e));
        }
        catch (Exception $e) {
            return $this->sendError('Error', $e->getMessage());
        }

        return redirect()->route('jadwalproyek.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JadwalProyek  $JadwalProyek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // $this->authorize('delete-37');

        $user = auth('sanctum')->user();

        $jadwalproyek = JadwalProyek::find($id);

        $jadwalproyek->dlt = '1';

        $jadwalproyek->fill(['opedit' => $user->login, 'pcedit' => $request->ip()]);

        $jadwalproyek->save();

        return response([
            'success' => true,
            'data'    => 'Success',
            'message' => 'Jadwal Proyek deleted successfully.',
        ], 200);
    }
}
