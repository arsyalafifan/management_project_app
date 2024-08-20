<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController as BaseController;

class DashboardController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->page = 'Dashboard';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
        $manpower = DB::table('tbmmanpower')
                    ->select('tbmmanpower.*')
                    ->where('tbmmanpower.dlt', '0')
                ;
        $countmanpower = $manpower->count();

        $material = DB::table('tbmmaterial')
                    ->select('tbmmaterial.*')
                    ->where('tbmmaterial.dlt', '0')
                ;
        $countmaterial = $material->count();

        $user = DB::table('tbmuser')
                    ->select('tbmuser.*')
                    ->where('tbmuser.dlt', '0')
                ;
        $countuser = $user->count();

        $project = DB::table('tbproject')
                    ->select('tbproject.*')
                    ->where('tbproject.dlt', '0')
                ;
        $countproject = $project->count();

        $projectselesai = DB::table('tbproject')
                    ->select('tbproject.*')
                    ->where('tbproject.dlt', '0')
                    ->where('status', 1)
                ;
        $countprojectselesai = $projectselesai->count();

        $projectbelumselesai = DB::table('tbproject')
                    ->select('tbproject.*')
                    ->where('tbproject.dlt', '0')
                    ->where('status', 0)
                ;
        $countprojectbelumselesai = $projectbelumselesai->count();
        return view(
            'dashboard', 
            [
                'page' => $this->page, 
                'createbutton' => false, 
                'countmanpower' => $countmanpower,
                'countmaterial' => $countmaterial,
                'countuser' => $countuser,
                'countproject' => $countproject,
                'countprojectselesai' => $countprojectselesai,
                'countprojectbelumselesai' => $countprojectbelumselesai
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
