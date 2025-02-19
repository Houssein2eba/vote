<?php

namespace App\Http\Controllers;

use App\Models\Resultat;
use Illuminate\Http\Request;

class ResultatController extends Controller
{
    public function index(){
        return view('home');
    }

    public function vote(Request $request){
        // Validate the request data
        $request->validate([
            'student_id' => [
                'required',
                'unique:resultats,student_id',  
                'regex:/^(GI24([0-9]{3}|255))$|^(IUP(18|19|20|21|22|23|24)([0-6][0-9]{2}|700))$/'

            ],
            'institution' => 'required|in:iup',  // Adjust if needed
            'union_id' => 'required|in:1,2,3,4',
        ], [
            'student_id.required' => 'رقم التسجيل مطلوب.',
            'student_id.unique' => 'رقم التسجيل مستخدم بالفعل.',
            'student_id.regex' => 'رقم التسجيل غير صالح، يجب أن يكون بصيغة صحيحة.',
            'institution.required' => 'اسم المؤسسة مطلوب.',
            'institution.in' => 'اسم المؤسسة غير صالح.',
            'union_id.required' => 'معرف النقابة مطلوب.',
            'union_id.in' => 'معرف النقابة غير صالح.',
        ]);
   
        // Attempt to create the vote
        $vote = Resultat::create([
            'student_id' => $request->student_id,
            'institution' => $request->institution,
            'union_id' => $request->union_id
        ]);

        // If the creation is successful, redirect with a success message
        return redirect()->route('home')->with('success', 'تم التصويت بنجاح');
    }
    public function resultats(){
        $results = Resultat::select('union_id')
        ->selectRaw('COUNT(*) as count')
        ->groupBy('union_id')
        ->get();

    return view('resultas', compact('results'));
    }
}
