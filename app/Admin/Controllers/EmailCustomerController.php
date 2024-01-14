<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Email\BatchSendMail;
use App\Admin\Actions\Email\Send;
use App\Admin\Services\EmailServices;
use App\Models\EmailCustomer;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EmailCustomerController extends AdminController
{
    protected $emailServies;
    protected $title = 'Email Khách Hàng';

    public function __construct(EmailServices $emailServices)
    {
        $this->emailServies = $emailServices;
    }
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmailCustomer());
        $grid->model()->with(['group']);

        $grid->column('id', __('Id'));
        $grid->column('group.name', __('Phân loại nhóm'));
        $grid->column('customer_name', __('Tên khách hàng'));
        $grid->column('email', __('Địa chỉ mail'));
        $grid->column('type', __('Loại khách hàng'))->display(function(){
            return $this->type_name;
        });
        $grid->column('created_at', __('Ngày thêm'));
        $grid->column('updated_at', __('Ngày cập nhật'));
        $grid->actions(function ($actions) {
            $actions->add(new Send);
        });
        $grid->batchActions(function ($batch) {
            $batch->add(new BatchSendMail());
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(EmailCustomer::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('group_id', __('Group id'));
        $show->field('customer_name', __('Customer name'));
        $show->field('email', __('Email'));
        $show->field('type', __('Type'));
        $show->field('deleted_at', __('Deleted at'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EmailCustomer());
        $form->select('group_id', __('Group id'))->options($this->emailServies->getOptionGroup());
        $form->text('customer_name', __('Customer name'));
        $form->email('email', __('Email'));
        $form->select('type', __('Type'))->options($this->emailServies->getOptionType());

        return $form;
    }
}
