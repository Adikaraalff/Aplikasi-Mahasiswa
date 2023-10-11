<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_old()
    {
        //
        $mahasiswas = Mahasiswa::latest()->paginate(5);
        return view('mahasiswas.index', compact('mahasiswas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $data = Mahasiswa::select('*');
            $query_data = new Mahasiswa();
            if ($request->sSearch) {
                $search_value = '%' . $request->sSearch . '%';
                $query_data = $query_data->where(function ($query) use ($search_value) {
                    $query->where('name', 'like', $search_value)
                        ->orWhere('nim', 'like', $search_value)
                        ->orWhere('kelas', 'like', $search_value)
                        ->orWhere('prodi', 'like', $search_value);
                });
            }
            $data = $query_data->orderBy('name', 'asc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    //$btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    $btn = '<form action="' . route('mahasiswas.destroy', $row->id) . '"method="POST">
                    <a class="btn btn-info" href="' . route('mahasiswas.show', $row->id) . '">Show</a>
                    <a class="btn btn-primary" href="' . route('mahasiswas.edit', $row->id) . '">Edit</a>' . csrf_field() . method_field('DELETE') .
                        '<button type="submit" class="btn btn-danger">Delete</button></form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('mahasiswas.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'kelas' => 'required',
            'prodi' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
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

        Mahasiswa::create($input);

        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
        return view('mahasiswas.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'kelas' => 'required',
            'prodi' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
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

        Mahasiswa::create($input);

        $mahasiswa->update($request->all());

        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
        $mahasiswa->delete();

        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa deleted successfully');
    }
}
