<?php

namespace App\Admin\Actions\Email;

use App\Jobs\SendMailJob;
use App\Mail\SendMail;
use App\Models\EmailTemplate;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Template\Template;

class Send extends RowAction
{
    public $name = 'Send Mail';

    public function handle(Model $model, Request $request)
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
        Mail::to($this->getRow()->email)
            ->queue(new SendMail($data));
        return $this->response()->success('Gửi email thành công')->refresh();
    }


    public function form()
    {
        $this->select('template_id', trans('Template'))
            ->options(EmailTemplate::all()->pluck('subject','id'))
            ->required();
        $this->confirm('Xác nhận gửi email đến khách hàng ' . $this->getRow()->email . ' ?');
    }


    public function render()
    {
        $this->name = trans('Gửi mail');
        return parent::render();
    }

}
