<?php

namespace App\Admin\Controllers;

use App\Models\EmailGroup;
use App\Models\EmailTemplate;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Str;

class EmailGroupController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Nhóm Khách Hàng';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmailGroup());

        $grid->column('id', __('Id'));
        $grid->column('group_indentify', __('Định danh nhóm'));
        $grid->column( __('Tên nhóm'))->display(function (){
            return $this->name;
        });
        $grid->column('status', __('Trạng thái'));
        $grid->column('created_at', __('Ngày tạo'));
        $grid->column('updated_at', __('Ngày cập nhật'));

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
        $show = new Show(EmailGroup::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('group_indentify', __('Group indentify'));
        $show->field('name', __('Name'));
        $show->field('status', __('Status'));
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
        $form = new Form(new EmailGroup());

        $form->text('group_indentify', __('Group indentify'))->default(Str::random('6'));
        $form->text('name', __('Name'));
        $form->text('status', __('Status'))->default('on');
        return $form;
    }

    public function getTemplateById($id)
    {
        return EmailTemplate::find($id)->pluck('subject','content');
    }
}
