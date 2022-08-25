<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Http;

class StudentClassController extends Controller
{
    public function index(Request $request)
    {
        $data = Http::withHeaders([
            'Authorization' => 'Bearer '.request()->cookie('token'),
            'ContentType' => 'application/json',
            'Accept' => 'application/json',
            ])->get('http://127.0.0.1:8000/api'.'/student_classes')->json();
            $student_classes = json_decode(json_encode($data))->student_classes;
            // dd($student_classes);
        if($request->ajax()){
            return DataTables::of($student_classes)
                            ->addColumn('kode', function($row){
                                return $row->kode;
                            })
                            ->addColumn('nama', function($row){
                                return $row->nama;
                            })
                            ->addColumn('deskripsi', function($row){
                                return $row->deskripsi;
                            })
                            ->addColumn('action', function($row){

                                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" onclick="updateItem(this)" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-eye"></i></span></a>';
                                $btn .='&nbsp';
                                $btn .= '<a href="" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-warning btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                                $btn .='&nbsp';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';
                                 return $btn;
                            })
                            ->rawColumns(['action'])
                            ->addIndexColumn()
                            ->make(true);
            }
            return view('admin.studentClass.index', compact('student_classes'));
        
    }
}
