<?php

namespace App\Admin\Controllers;

use App\Models\AncaiArticle;
use App\Models\AncaiCatalog;
use App\Models\AncaiCourse;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class AncaiArticlesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '文章';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new AncaiArticle());

        $grid->column('id', __('Id'));
        $grid->column('ancaiCourse.title', __('课程'));
        $grid->column('ancaiCatalog.title', __('目录'));
        $grid->column('title', __('文章标题'))->editable();
        $grid->column('content', __('内容'))->hide()->display(function ($value) {
            return $value;
        });
        $grid->column('video_link', __('视频链接'))->display(function ($value) {
            if ($value) {
                return '<a target="_blank" href="' . $value . '">点击查看详情</a>';
            }
        });
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
        $show = new Show(AncaiArticle::with(['ancaiCourse', 'ancaiCatalog'])->findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('course_id', __('课程ID'));
        $show->field('ancaiCourse.title', __('课程标题'));
        $show->field('catalog_id', __('目录ID'));
        $show->field('ancaiCatalog.title', __('目录名称'));
        $show->field('title', __('文章标题'));
        $show->field('video_link', __('视频链接'))->link();
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));
        $show->field('content', __('Content'))->unescape();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new AncaiArticle());

        $form->select('course_id', __('课程'))->options(function () {
            return AncaiCourse::query()->pluck('title', 'id');
        })->load('catalog_id', route('admin.ancai_catalogs.getCatalogs'))->rules(['required']);
        $form->select('catalog_id', __('目录'))->rules(['required'])->options(function () {
            $ancaiCatalogs = AncaiCatalog::query()->where('course_id', $this->course_id)->pluck('title', 'id');
            return $ancaiCatalogs;
        });
        $form->text('title', __('标题'))->rules(['required']);
        $form->text('video_link', __('视频链接'));
        $form->number('sort', __('排序'))->default(0);
        $form->UEditor('content', __('内容'))->rules(['required']);

        return $form;
    }
}
