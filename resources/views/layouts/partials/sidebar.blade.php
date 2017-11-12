@inject('menuPresenter','App\Presenters\Admin\MenuPresenter')
<ul class="sidebar-menu tree" data-widget="tree">
    <li class="header">HEADER</li>
    {!!$menuPresenter->sidebarMenuList($sidebarMenu)!!}

</ul>