<?php

namespace App\Admin\Controllers;

use App\Models\AncaiCatalog;
use App\Models\AncaiCourse;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class AncaiCatalogsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '课程目录';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AncaiCatalog());

        $grid->column('id', __('Id'));
        $grid->column('ancaiCourse.title', __('课程'));
        $grid->column('parent.title', __('父级目录'));
        $grid->column('title', __('目录标题'));
        $grid->column('sort', __('排序'));
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
        $show = new Show(AncaiCatalog::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('parent_id', __('Parent id'));
        $show->field('course_id', __('Course id'));
        $show->field('title', __('Title'));
        $show->field('sort', __('Sort'));
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
        $form = new Form(new AncaiCatalog());
        $form->select('course_id', __('课程'))->options(function () {
            return AncaiCourse::query()->pluck('title', 'id');
        });
        $form->select('parent_id', __('父级目录'))->default(0)->options(function () {
            $ancaiCatalogs = AncaiCatalog::query()->pluck('title', 'id')->toArray();
            array_unshift($ancaiCatalogs, '无');
            return $ancaiCatalogs;
        })->default(0);

        $form->text('title', __('Title'));
        $form->number('sort', __('Sort'))->default(0);

        return $form;
    }


    public function getCatalogs(Request $request)
    {
        $course_id = $request->q;

        $ancaiCatalogs = AncaiCatalog::query()->select('title as text', 'id')->where('course_id', $course_id)->get()->toArray();

        return $ancaiCatalogs;
    }
}
