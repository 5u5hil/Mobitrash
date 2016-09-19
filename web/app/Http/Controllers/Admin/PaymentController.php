<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Attachment;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use Mail;
use Excel;
use Session;
use Request;

class PaymentController extends Controller {

    function index() {
        $filter = array('' => 'All', 'subscription_name' => 'Subscription', 'received_payments' => 'Received Payments', 'pending_payments' => 'Pending Payments');

        $filter_type = NULL;
        $filter_value = NULL;
        $field1 = NULL;

        $payments = Payment::orderBy("created_at", "desc");
        if (Input::get('invoice_date')) {
            $payments = $payments->whereNull('invoice_month')->where('invoice_date', date("Y-m-d", strtotime(Input::get('invoice_date'))));
        }
        if (Input::get('invoice_month')) {
            $payments = $payments->whereNull('invoice_date')->where('invoice_month', date("Y-m", strtotime(Input::get('invoice_month'))));
        }
        if (Input::get('filter_value') && Input::get('filter_type')) {
            $filter_type = Input::get('filter_type');
            $filter_value = Input::get('filter_value');
            if ($filter_type == 'subscription_name') {
                $field1 = Input::get('filter_value');
                $payments = $payments->whereHas('subscription', function($q) {
                            $q->where('name', 'LIKE', "%" . Input::get('filter_value') . "%");
                        })->paginate(Config('constants.paginateNo'));
            }
        } else if (Input::get('filter_type') == 'received_payments') {
            $filter_type = Input::get('filter_type');
            $payments = $payments->where('payment_made', 1)->paginate(Config('constants.paginateNo'));
        } else if (Input::get('filter_type') == 'pending_payments') {
            $filter_type = Input::get('filter_type');
            $payments = $payments->where('payment_made', 0)->paginate(Config('constants.paginateNo'));
        } else {
            $payments = $payments->paginate(Config('constants.paginateNo'));
        }
        Session::put('backUrl', Request::fullUrl());
        return view(Config('constants.adminPaymentView') . '.index', compact('payments', 'filter', 'filter_type', 'filter_value', 'field1'));
    }
    
    public function exportExcel() {
        $payments = Payment::orderBy("created_at", "desc");
        if (Input::get('invoice_date')) {
            $payments = $payments->whereNull('invoice_month')->where('invoice_date', date("Y-m-d", strtotime(Input::get('invoice_date'))));
        }
        if (Input::get('invoice_month')) {
            $payments = $payments->whereNull('invoice_date')->where('invoice_month', date("Y-m", strtotime(Input::get('invoice_month'))));
        }
        if (Input::get('filter_value') && Input::get('filter_type')) {
            $filter_type = Input::get('filter_type');
            if ($filter_type == 'subscription_name') {
                $payments = $payments->whereHas('subscription', function($q) {
                            $q->where('name', 'LIKE', "%" . Input::get('filter_value') . "%");
                        })->get();
            }
        } else if (Input::get('filter_type') == 'received_payments') {
            $payments = $payments->where('payment_made', 1)->get();
        } else if (Input::get('filter_type') == 'pending_payments') {
            $payments = $payments->where('payment_made', 0)->get();
        } else {
            $payments = $payments->get();
        }
        Excel::create('payments', function($excel) use($payments) {
            $excel->sheet('Sheet 1', function($sheet) use($payments) {
                $arr =array();
                foreach($payments as $payment) {
                        $data =  array($payment->id, $payment->subscription?$payment->subscription->name:'', $payment->user?$payment->user->name:'', $payment->billing_method == 1 ? date('M Y', strtotime($payment->invoice_month)) : date('d M Y', strtotime($payment->invoice_date)), $payment->invoice_amount,
                            $payment->payment_made == 1? 'Yes' : ($payment->payment_made == 2 ? 'Pending' :'No'), ($payment->payment_made == 1 || $payment->payment_made == 2) ? date('d M Y', strtotime(@$payment->payment_date)) : '-' , $payment->remark, Config('constants.uploadRecord').@$payment->file,$payment->addedBy->name,
                                $payment->txtdetails);
                        array_push($arr, $data);
                }
                $sheet->fromArray($arr,null,'A1',false,false)->prependRow(array(
                        'Id', 'Subscription', 'Subscriber Name', 'Invoice Date/Month', 'Invoice Amount',
                        'Payment Made', 'Payment Date', 'Remark', 'Attachment', 'Added By', 'Txn Details'
                    )

                );
            });
        })->export('xls');
    }

    public function add() {
        $payment = new Payment();
        $sub = Subscription::all()->toArray();
        $subscription = [];
        $subscription = ["" => "Select Subscription"];
        foreach ($sub as $value) {
            $subscription[$value['id']] = $value['name'];
        }
        $action = "admin.payment.save";
        return view(Config('constants.adminPaymentView') . '.add', compact('payment', 'action', 'subscription'));
    }

    public function edit() {
        
        $payment = Payment::find(Input::get('id'));
        $sub = Subscription::all()->toArray();
        $subscription = [];
        $subscription = ["" => "Select Subscription"];
        foreach ($sub as $value) {
            $subscription[$value['id']] = $value['name'];
        }
        $action = "admin.payment.update";
        return view(Config('constants.adminPaymentView') . '.edit', compact('payment', 'action', 'subscription'));
    }

    public function save() {
        $payment = Payment::findOrNew(Input::get('id'));
        $destinationPath = public_path() . '/uploads/records/';
        $fileName = NULL;
        if (Input::file('file')) {
            $att = Input::file('file');
            $fileName = time() . '.' . $att->getClientOriginalExtension();
            if ($att->move($destinationPath, $fileName)) {
                $payment->file = $fileName;
                $payment->filename = $att->getClientOriginalName();
            }
        }
        $newfile = $destinationPath . $fileName;
        $payment->invoice_month = date("Y-m", strtotime(Input::get('invoice_month')));
        $payment->fill(Input::except('file', 'invoice_month'))->save();
        $user = User::where('id', Input::get('user_id'))->first()->toArray();
        $user['invoice'] = Input::except('file');
        Mail::send(Config('constants.adminEmail') . '.paymentInvoice', ['user' => $user, 'id' => $payment->id], function ($message) use ($newfile) {
            $message->to(Input::get("mail_to"));
            if (Input::get("mail_to_cc")) {
                $emailids = str_replace(' ', '', Input::get("mail_to_cc"));
                $cc = explode(',', $emailids);
                $message->cc($cc);
            }
            $message->subject('MobiTrash Payment Invoice');
            $message->attach($newfile);
        });
        Session::flash('message', "Invoice has been sent successfully!");
        return redirect()->route('admin.payment.view');
    }

    public function update() {
        $payment = Payment::find(Input::get('id'));
        $payment->payment_made = Input::get('payment_made');
        $payment->payment_date = Input::get('payment_date');
        $payment->remark = Input::get('remark');
        $payment->update();
        Session::flash('message', "Invoice Modified successfully!");
        
        return redirect()->to(Session::get('backUrl'));
    }

    public function delete() {
        $payment = Payment::find(Input::get('id'));
        $payment->delete();
        return redirect()->back()->with("message", "Payment deleted sucessfully");
    }

    public function paymentNotification() {
        $payment_manager = User::whereHas('roles', function($q) {
                    $q->where('id', 6);
                })->get(['id', 'name', 'email'])->toArray();
        $mail_to = array();
        foreach ($payment_manager as $val) {
            array_push($mail_to, $val['email']);
        }
        $prepaid_subscriptions = Subscription::where('billing_method', 1)->where('payment_type', 'Prepaid')->where('end_date', date('Y-m-d', strtotime(date('Y-m-d') . ' +4 day')))->get()->toArray();
        $postpaid_subscriptions = Subscription::where('billing_method', 1)->where('payment_type', 'Postpaid')->where('end_date', date('Y-m-d', strtotime(date('Y-m-d') . ' +4 day')))->get()->toArray();
        
        if (!empty($mail_to) && ($prepaid_subscriptions || $postpaid_subscriptions)) {
            Mail::send(Config('constants.adminEmail') . '.paymentNotification', ['prepaid' => $prepaid_subscriptions, 'postpaid' => $postpaid_subscriptions], function ($message) use ($mail_to) {
                $message->to($mail_to);
                $message->subject('MobiTrash Subscriptions due for payment');
            });
        }
        echo 'success';
        exit();
    }

    

}
