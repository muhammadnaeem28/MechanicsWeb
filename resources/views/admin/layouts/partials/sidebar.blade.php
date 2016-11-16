<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"> </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn submit">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            <li class="heading">
                <h3 class="uppercase">Admin Dashboard</h3>
            </li>
            <li class="nav-item start active open">
                <a href="{{route('admin.dashboard')}}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Admin Dashboard</span>
                    <span class="selected"></span>
                   {{-- <span class="arrow open"></span>--}}
                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">Users Management</h3>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-user-secret"></i>
                    <span class="title">Customers</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
{{--
                    <li class="nav-item  ">
                        <a href="page_user_profile_1.html" class="nav-link ">
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
--}}
                    <li class="nav-item  ">
                        <a href="{{route('admin.customer.index')}}" class="nav-link ">
                            <span class="title">Customers List</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.customer-quotation.index')}}" class="nav-link ">
                            <span class="title">Customers Quotations</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">Mechanics</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
{{--
                    <li class="nav-item  ">
                        <a href="page_user_profile_1.html" class="nav-link ">
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
--}}
                    <li class="nav-item ">
                        <a href="{{route('admin.mechanic.index')}}" class="nav-link ">
                            <span class="title">Mechanics List</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="heading">
                <h3 class="uppercase">Services Management</h3>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-gears"></i>
                    <span class="title">Services</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="{{route('admin.service.categories.index')}}" class="nav-link ">
                            <span class="title">Categories List</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.service.index')}}" class="nav-link ">
                            <span class="title">Services List</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.service-brand.index')}}" class="nav-link ">
                            <span class="title">Service Brands</span>
                        </a>
                    </li>
                    {{--<li class="nav-item">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <span class="title">Service Brands</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu" style="display: none;">
                            <li class="nav-item  ">
                                <a href="{{route('admin.service-brand.index')}}" class="nav-link ">
                                    <span class="title">Brands List</span>
                                </a>
                            </li>
                            --}}{{--<li class="nav-item  ">
                                <a href="{{route('admin.service-brand-services.index')}}" class="nav-link ">
                                    <span class="title">Brands type</span>
                                </a>
                            </li>--}}{{--
                        </ul>
                    </li>--}}
                    <li class="nav-item  ">
                        <a href="{{route('admin.optional-services.index')}}" class="nav-link ">
                            <span class="title">Optional Services</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-car"></i>
                    <span class="title">Vehicles</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">


                    <li class="nav-item  ">
                        <a href="{{route('admin.vehicle.new')}}" class="nav-link ">
                            <span class="title">Make New Vehicle</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.vehicle.list')}}" class="nav-link ">
                            <span class="title">Vehicles List</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="{{route('admin.vehicle.lov')}}" class="nav-link ">
                            <span class="title">List of Values</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="heading">
                <h3 class="uppercase">Pricing Management</h3>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-car"></i>
                    <span class="title">Pricing</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="/administrator/#/Pricing/new" class="nav-link ">
                            <span class="title">Add pricing</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="{{route("admin.pricing.view")}}" class="nav-link ">
                            <span class="title">View Pricing</span>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="/administrator/#/Pricing/search" class="nav-link ">
                            <span class="title">Search Pricing</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="heading">
                <h3 class="uppercase">Content Management</h3>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-comments-o"></i>
                    <span class="title">Reviews</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item  ">
                        <a href="page_user_profile_1_account.html" class="nav-link ">
                            <span class="title">Add Review</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-support"></i>
                    <span class="title">Advice</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item  ">
                        <a href="page_user_profile_1_account.html" class="nav-link ">
                            <span class="title">Add Advice</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-question-circle"></i>
                    <span class="title">User Questions</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">

                    <li class="nav-item  ">
                        <a href="page_user_profile_1_account.html" class="nav-link ">
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="page_user_profile_1_account.html" class="nav-link ">
                            <span class="title">View Questions List</span>
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a href="page_user_profile_1_account.html" class="nav-link ">
                            <span class="title">View Questions List</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>