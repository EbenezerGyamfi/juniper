<?php

namespace App\Admin\Controllers;

use App\Models\Fee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FeeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Fee';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Fee());
        $grid->disableCreateButton();
        $grid->disableFilter();
        $grid->disableExport();

        $grid->column('id', __('Id'));
        $grid->column('interest', __('Interest'));
        $grid->column('service_fee', __('Service fee'));
        $grid->column('due_days', __('Due days'));

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
        $show = new Show(Fee::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('interest', __('Interest'));
        $show->field('service_fee', __('Service fee'));
        $show->field('due_days', __('Due days'));
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
        $form = new Form(new Fee());

        $form->decimal('interest', __('Interest'))->default(10.00);
        $form->decimal('service_fee', __('Service fee'))->default(5.00);
        $form->number('due_days', __('Due days'));

        return $form;
    }
}
