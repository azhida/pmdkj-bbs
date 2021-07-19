<?php

namespace App\Admin\Controllers;

use App\Models\AncaiCourse;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AncaiCoursesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'AncaiCourse';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AncaiCourse());

        $grid->column('id', __('Id'));
        $grid->column('title', __('课程标题'))->editable();
        $grid->column('sort', __('排序'))->editable()->sortable();
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

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
        $show = new Show(AncaiCourse::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('课程标题'));
        $show->field('sort', __('排序'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AncaiCourse());

        $form->text('title', __('课程标题'));
        $form->number('sort', __('排序'))->default(0);

        return $form;
    }
}
