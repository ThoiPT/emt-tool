<?php

namespace App\Admin\Actions\Email;

use App\Mail\SendMail;
use App\Models\EmailTemplate;
use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class BatchSendMail extends BatchAction
{
    public $name = 'Batch Send Mail';

    public function handle(Collection $collection, Request $request)
    {
        $subject = '';
        $content = '';
        $template = EmailTemplate::find($request->template_id);
        if ($template){
            $subject = $template->subject;
            $content = $template->content;
        }
        $data = [
            'locale' => 'en', //
            'view_file' => 'emails.demo', //
            'subject' => $subject,
            'content' => $content,
        ];
        $listUser = [];
        $delay = 30;

        foreach ($collection as $key => $model) {
            $email = $model->email;

            dispatch(function () use ($email, $data) {
                Mail::to($email)->send(new SendMail($data));
            })->delay(now()->addSeconds($delay));

//            sleep($delay); // Đợi 30 giây trước khi gửi email tiếp theo
        }
//        Mail::to($listUser)
////            ->queue(new SendMail($data))
//        ->later(now()->addSeconds(50), new SendMail($data));
        return $this->response()->success('Đã gửi mail đến toàn bộ khách hàng')->refresh();
    }

    public function form()
    {
        $this->select('template_id', trans('Template'))
            ->options(EmailTemplate::all()->pluck('subject','id'))
            ->required();
        $this->confirm('Xác nhận gửi email đến toàn bộ khách hàng');
    }

}
