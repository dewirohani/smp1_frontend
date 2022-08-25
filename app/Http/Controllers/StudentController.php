<?php

namespace App\Http\Controllers;
use DataTables;
use Http;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $data = Http::withHeaders([
            'Authorization' => 'Bearer '.request()->cookie('token'),
            'ContentType' => 'application/json',
            'Accept' => 'application/json',
            ])->get('http://127.0.0.1:8000/api'.'/students')->json();
            $students = json_decode(json_encode($data))->students;
            // dd($students);
        if($request->ajax()){
            return DataTables::of($students)
                            ->addColumn('nisn', function($row){
                                return $row->nisn;
                            })
                            ->addColumn('nama_lengkap', function($row){
                                return $row->personal_student_detail->nama_lengkap;
                            })
                            ->addColumn('jenis_kelamin', function($row){
                                return $row->personal_student_detail->jenis_kelamin;
                            })
                            ->addColumn('diterima_dikelas', function($row){
                                return $row->previous_education_student_information->diterima_dikelas;
                            })
                            ->addColumn('action', function($row){

                                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" onclick="updateItem(this)" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm"><span><i class="fas fa-eye"></i></span></a>';
                                $btn .='&nbsp';
                                $btn .= '<a href="#" data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-warning btn-sm"><span><i class="fas fa-pen-square"></i></span></a>';
                                $btn .='&nbsp';
                                $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" onclick="deleteItem(this)" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm"><span><i class="fas fa-trash"></i></a>';
                                 return $btn;
                            })
                            ->rawColumns(['action'])
                            ->addIndexColumn()
                            ->make(true);
            }
            return view('admin.student.index', compact('students'));
        
    }
}
