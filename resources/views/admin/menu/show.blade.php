@inject('menuPresenter','App\Presenters\Admin\MenuPresenter')
<div class="content">
    <form class="form-horizontal" id="showForm">
        <div class="form-group">
            <label class="col-sm-3 control-label">{{trans('admin/menu.model.name')}}</label>
            <div class="col-sm-9">
                <p class="form-control-static">{{$menu->name}}</p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">{{trans('admin/menu.model.pid')}}</label>
            <div class="col-sm-9">
                <p class="form-control-static">{{$menuPresenter->topMenuName($menus,$menu->pid)}}</p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">{{trans('admin/menu.model.icon')}}</label>
            <div class="col-sm-9">
                <p class="form-control-static"><i class=" fa {{$menu->icon}}"></i></p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">{{trans('admin/menu.model.slug')}}</label>
            <div class="col-sm-9">
                <p class="form-control-static">{{$menu->slug}}</p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">{{trans('admin/menu.model.url')}}</label>
            <div class="col-sm-9">
                <p class="form-control-static">{{$menu->url}}</p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">{{trans('admin/menu.model.active')}}</label>
            <div class="col-sm-9">
                <p class="form-control-static">{{$menu->active}}</p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">{{trans('admin/menu.model.description')}}</label>
            <div class="col-sm-9">
                <p class="form-control-static">{{$menu->description}}</p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-sm-3 control-label">{{trans('admin/menu.model.sort')}}</label>
            <div class="col-sm-9">
                <p class="form-control-static">{{$menu->sort}}</p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-2">
                <a class="btn btn-white close-link" data-id="{{$menu->id}}">{!!trans('admin/action.actionButton.close')!!}</a>
            </div>
        </div>
    </form>

</div>