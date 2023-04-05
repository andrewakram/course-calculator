<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use App\Models\TeacherInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ConsultationController extends Controller
{
    protected $paymentController;
    public function __construct(PaymentController $paymentController){
        $this->paymentController = $paymentController;
    }

    public function studentConsultation(){
        $user = Auth::guard('web')->user();
        if(!$user){
            return back()->with('error', 'يرجي تسجيل الدخول اولا');
        }

        $data['consultations'] = Order::orderBy('id','desc')
            ->where('student_id',$user->id)
            ->whereIn('type',['urgent_consultation','normal_consultation'])
            ->get();

        return view('StudentAdmin.pages.consultations',compact('data'));
    }

    public function sendConsultationRequest($instructorId,$type='urgent_consultation')
    {
        $user = Auth::guard('web')->user();
        if(!$user){
            return back()->with('error', 'يرجي تسجيل الدخول اولا');
        }

        $teacher = TeacherInfo::where('teacher_id',$instructorId)->first();

        $inquiryCost = $type == 'normal_consultation' ? $teacher->inquiry_cost_normal : $teacher->inquiry_cost_urgent;
        $type = ($type == 'normal_consultation') ? 'normal_consultation' : 'urgent_consultation';

        $order = Order::create([
            'type' => $type,
            'teacher_id' => $instructorId,
            'student_id' => $user->id,
            'price_after' => $inquiryCost,
        ]);
        return $this->paymentController->payConsultationRequest($order->id,$teacher->inquiry_cost_urgent,$user->email);
//        session()->flash('success', 'تم ارسال الطلب بنجاح');
        return back();
    }
}
