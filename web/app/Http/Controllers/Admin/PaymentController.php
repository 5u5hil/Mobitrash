<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Input;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Attachment;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use Mail;
use Session;

class PaymentController extends Controller {

    function index() {
        $filter = array('' => 'All', 'subscription_name' => 'Subscription', 'invoice_date' => 'Invoice Date', 'invoice_month' => 'Invoice Month', 'received_payments' => 'Received Payments', 'pending_payments' => 'Pending Payments');

        $filter_type = NULL;
        $filter_value = NULL;
        $field1 = NULL;
        $field2 = NULL;
        $field3 = NULL;
        if (Input::get('filter_value') && Input::get('filter_type')) {
            $filter_type = Input::get('filter_type');
            $filter_value = Input::get('filter_value');
            if ($filter_type == 'subscription_name') {
                $field1 = Input::get('filter_value');
                $payments = Payment::whereHas('subscription', function($q) {
                    $q->where('name', 'LIKE' , "%".Input::get('filter_value')."%");
                })->paginate(Config('constants.paginateNo'));
            } else if ($filter_type == 'invoice_date') {
                $field2 = Input::get('filter_value');
                $payments = Payment::where('invoice_date', Input::get('filter_value'))->paginate(Config('constants.paginateNo'));
            } else if ($filter_type == 'invoice_month') {
                $field3 = Input::get('filter_value');
                $payments = Payment::where('invoice_month', Input::get('filter_value'))->paginate(Config('constants.paginateNo'));
            }
        } else if (Input::get('filter_type') == 'received_payments') {
            $filter_type = Input::get('filter_type');
            $payments = Payment::where('payment_made', 1)->paginate(Config('constants.paginateNo'));
        } else if (Input::get('filter_type') == 'pending_payments') {
            $filter_type = Input::get('filter_type');
            $payments = Payment::where('payment_made', 0)->paginate(Config('constants.paginateNo'));
        } else {
            $payments = Payment::paginate(Config('constants.paginateNo'));
        }

        return view(Config('constants.adminPaymentView') . '.index', compact('payments', 'filter', 'filter_type', 'filter_value', 'field1', 'field2', 'field3'));
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
        return view(Config('constants.adminPaymentView') . '.addEdit', compact('payment', 'action', 'subscription'));
    }

    public function edit() {
        $payment = Payment::find(Input::get('id'));
        $action = "admin.payment.save";
        return view(Config('constants.adminPaymentView') . '.addEdit', compact('payment', 'action'));
    }

    public function show() {
        $payment = Payment::find(Input::get('id'));
        $atts = $payment->atts()->get();
        return view(Config('constants.adminPaymentView') . '.show', compact('payment', 'atts'));
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
        $payment->fill(Input::except('file'))->save();
        $user = User::where('id', Input::get('user_id'))->first()->toArray();
        $user['invoice'] = Input::except('file');
        Mail::send(Config('constants.adminEmail') . '.paymentInvoice', ['user' => $user], function ($message) use ($newfile) {
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

    public function delete() {
        $payment = Payment::find(Input::get('id'));
        $payment->delete();
        return redirect()->back()->with("message", "Payment deleted sucessfully");
    }

    public function rmfile() {
        $atta = Attachment::find(Input::get('id'));
        $atta->is_active = '0';
        $atta->save();
        return redirect()->back()->with("message", "Attachment Removed sucessfully");
        exit();
    }

}
