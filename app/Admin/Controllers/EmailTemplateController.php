<?php

namespace App\Admin\Controllers;

use App\Models\EmailTemplate;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class EmailTemplateController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Mẫu Email';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmailTemplate());

        $grid->column('id', __('Id'));
        $grid->column('subject', __('Tiêu đề'));
        // $grid->column('content', __('Nội dung mail'));
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
        $show = new Show(EmailTemplate::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('subject', __('Tiêu đề'));
        $show->field('content', __('Nội dung mail'));
        $show->field('status', __('Trạng thái'));
        $show->field('created_at', __('Ngày tạo'));
        $show->field('updated_at', __('Ngày cập nhật'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EmailTemplate());

        $form->text('subject', __('Subject'));
        $form->ckeditor('content', __('Content'));
        return $form;
    }
}
