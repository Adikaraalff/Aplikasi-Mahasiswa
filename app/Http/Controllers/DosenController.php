<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class DosenController extends Controller
{
    function __construct()
    {
        $this->middleware(
            'permission:dosen-list|dosen-create|dosen-edit|dosen-delete',
            ['only' => ['index', 'show']]
        );
        $this->middleware('permission:dosen-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:dosen-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:dosen-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index_old()
    {
        //
        $dosens = Dosen::latest()->paginate(5);
        return view('dosens.index', compact('dosens'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Dosen::select('*');
            $query_data = new Dosen();
            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('name', 'like', $search_value)
                        ->orWhere('nip', 'like', $search_value)
                        ->orWhere('prodi', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('name', 'asc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
            $btn = '<form action="' . route('dosens.destroy', $row->id) . '"method="POST">
            <a class="btn btn-info" href="' . route('dosens.show', $row->id) .'">Show</a>';
            // dd(Auth::user());
            if (Auth::user()->can('dosen-edit')) {
                $btn = $btn . '<a class="btn btn-primary" href="' . route('dosens.edit', $row->id) . '">Edit</a>';
            }
            if (Auth::user()->can('dosen-delete')) {
                $btn = $btn . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger">Delete</button>';
            }
            $btn = $btn . '</form>';
            return $btn;        
            })
            ->addColumn('id_prodi', function (Dosen $cb) {
                return $cb->prodi->nama;
            })
            
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dosens.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data_prodi = Prodi::All();
        //
        return view('dosens.create', compact('data_prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'id_prodi' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        //proses upload
        if ($image = $request->file('image')) {
            //menentukan dimana foto tersebut akan disimpan
            $destinationPath = 'image/';
            //nama file baru
            $nama_baru = date('YmdHis') . "." . $image->getClientOriginalExtension();
            //proses menyimpan
            $image->move($destinationPath, $nama_baru);
            $input['image'] = "$nama_baru";
        }

        Dosen::create($input);

        return redirect()->route('dosens.index')
            ->with('success', 'Dosen created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
        return view('dosens.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        //
        return view('dosens.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        //
        $request->validate([
            'name' => 'required',
            'nip' => 'required',
            'id_prodi' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();
        //proses upload
        if ($image = $request->file('image')) {
            //menentukan dimana foto tersebut akan disimpan
            $destinationPath = 'image/';
            //nama file baru
            $nama_baru = date('YmdHis') . "." . $image->getClientOriginalExtension();
            //proses menyimpan
            $image->move($destinationPath, $nama_baru);
            $input['image'] = "$nama_baru";
        } else {
            unset($input['image']);
        }

        // Dosen::create($input);

        $dosen->update($input);

        return redirect()->route('dosens.index')
            ->with('success', 'Dosen updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        //
        $dosen->delete();

        return redirect()->route('dosens.index')
            ->with('success', 'Dosen deleted successfully');
    }
}
