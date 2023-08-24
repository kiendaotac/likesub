<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Wrapper-->
    <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper hover-scroll-y my-5 my-lg-2" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper" data-kt-scroll-offset="5px">
        <!--begin::Sidebar menu-->
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-6 mb-5">
            @foreach($services as $service)
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ isset($currentService) && $currentService->parent_id == $service->id ? 'here show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline fs-2 {{ $service->logo }}"></i>
                        </span>
                        <span class="menu-title">{{ $service->name }}</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        @foreach($service->children as $child)
                            @if($loop->iteration <= 5)
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ isset($currentService) && $currentService->id == $child->id ? 'active' : '' }}" href="{{ route('test', $service->slug) }}">
                                        <span class="menu-bullet">
                                            <i class="ki-outline fs-2 {{ $child->logo }}"></i>
                                        </span>
                                        <span class="menu-title">{{ $child->name }}</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            @else
                                <div class="menu-inner flex-column collapse show" id="kt_app_sidebar_menu_{{ \Illuminate\Support\Str::slug($service->name) }}_collapse">
                                    <!--begin:Menu item-->
                                    <div class="menu-item">
                                        <!--begin:Menu link-->
                                        <a class="menu-link {{ isset($currentService) && $currentService->id == $child->id ? 'active' : '' }}" href="/">
                                        <span class="menu-bullet">
                                            <i class="ki-outline fs-2 {{ $child->logo }}"></i>
                                        </span>
                                            <span class="menu-title">{{ $child->name }}</span>
                                        </a>
                                        <!--end:Menu link-->
                                    </div>
                                    <!--end:Menu item-->
                                </div>
                                <div class="menu-item">
                                    <div class="menu-content">
                                        <a class="btn btn-flex btn-color-primary d-flex flex-stack fs-base p-0 ms-2 mb-2 toggle collapsible active" data-bs-toggle="collapse" href="#kt_app_sidebar_menu_{{ \Illuminate\Support\Str::slug($service->name) }}_collapse" data-kt-toggle-text="Show Less">
                                            <span data-kt-toggle-text-target="true">Show {{ $loop->count - 5 }} More</span>
                                            <i class="ki-outline ki-minus-square toggle-on fs-2 me-0"></i>
                                            <i class="ki-outline ki-plus-square toggle-off fs-2 me-0"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
            @endforeach
        </div>
        <!--end::Sidebar menu-->
        <!--begin::Teames-->
        {{--<div class="app-sidebar-menu-secondary menu menu-rounded menu-column ps-5 pe-6">
            <!--begin::Heading-->
            <div class="menu-item menu-labels">
                <div class="menu-content d-flex flex-stack fw-bold text-gray-600 text-uppercase fs-7">
                    <span class="menu-heading ps-1">Labels</span>
                    <!--begin::Link-->
                    <a class="menu-btn ps-2" href="../../demo39/dist/authentication/layouts/corporate/sign-in.html">
                        <i class="ki-outline ki-plus-square fs-2 text-success"></i>
                    </a>
                    <!--end::Link-->
                </div>
            </div>
            <!--end::Heading-->
            <!--begin::Separator-->
            <div class="app-sidebar-separator separator mx-5 mt-2 mb-2"></div>
            <!--end::Separator-->
            <!--begin::Menu Item-->
            <div class="menu-item">
                <!--begin::Menu link-->
                <a class="menu-link" href="../../demo39/dist/apps/projects/project.html">
                    <!--begin::Bullet-->
                    <span class="menu-icon ps-2">
											<span class="bullet bullet-dot h-10px w-10px bg-primary"></span>
										</span>
                    <!--end::Bullet-->
                    <!--begin::Title-->
                    <span class="menu-title text-gray-700 fw-bold fs-6">Google Ads</span>
                    <!--end::Title-->
                    <!--begin::Badge-->
                    <span class="menu-badge">
											<span class="badge badge-secondary">6</span>
										</span>
                    <!--end::Badge-->
                </a>
                <!--end::Menu link-->
            </div>
            <!--end::Menu Item-->
            <!--begin::Menu Item-->
            <div class="menu-item">
                <!--begin::Menu link-->
                <a class="menu-link" href="../../demo39/dist/apps/projects/project.html">
                    <!--begin::Bullet-->
                    <span class="menu-icon ps-2">
											<span class="bullet bullet-dot h-10px w-10px bg-success"></span>
										</span>
                    <!--end::Bullet-->
                    <!--begin::Title-->
                    <span class="menu-title text-gray-700 fw-bold fs-6">AirStoke App</span>
                    <!--end::Title-->
                    <!--begin::Badge-->
                    <span class="menu-badge">
											<span class="badge badge-secondary">2</span>
										</span>
                    <!--end::Badge-->
                </a>
                <!--end::Menu link-->
            </div>
            <!--end::Menu Item-->
            <!--begin::Menu Item-->
            <div class="menu-item">
                <!--begin::Menu link-->
                <a class="menu-link" href="../../demo39/dist/apps/projects/project.html">
                    <!--begin::Bullet-->
                    <span class="menu-icon ps-2">
											<span class="bullet bullet-dot h-10px w-10px bg-warning"></span>
										</span>
                    <!--end::Bullet-->
                    <!--begin::Title-->
                    <span class="menu-title text-gray-700 fw-bold fs-6">Internal Tasks</span>
                    <!--end::Title-->
                    <!--begin::Badge-->
                    <span class="menu-badge">
											<span class="badge badge-secondary">37</span>
										</span>
                    <!--end::Badge-->
                </a>
                <!--end::Menu link-->
            </div>
            <!--end::Menu Item-->
            <!--begin::Menu Item-->
            <div class="menu-item">
                <!--begin::Menu link-->
                <a class="menu-link" href="../../demo39/dist/apps/projects/project.html">
                    <!--begin::Bullet-->
                    <span class="menu-icon ps-2">
											<span class="bullet bullet-dot h-10px w-10px bg-danger"></span>
										</span>
                    <!--end::Bullet-->
                    <!--begin::Title-->
                    <span class="menu-title text-gray-700 fw-bold fs-6">Fitnes App</span>
                    <!--end::Title-->
                    <!--begin::Badge-->
                    <span class="menu-badge">
											<span class="badge badge-secondary">4</span>
										</span>
                    <!--end::Badge-->
                </a>
                <!--end::Menu link-->
            </div>
            <!--end::Menu Item-->
            <!--begin::Collapsible items-->
            <div class="menu-inner flex-column collapse" id="kt_app_sidebar_menu_projects_collapse">
                <!--begin::Menu Item-->
                <div class="menu-item">
                    <!--begin::Menu link-->
                    <a class="menu-link" href="../../demo39/dist/apps/projects/project.html">
                        <!--begin::Bullet-->
                        <span class="menu-icon ps-2">
												<span class="bullet bullet-dot h-10px w-10px bg-info"></span>
											</span>
                        <!--end::Bullet-->
                        <!--begin::Title-->
                        <span class="menu-title text-gray-700 fw-bold fs-6">Oppo CRM</span>
                        <!--end::Title-->
                        <!--begin::Badge-->
                        <span class="menu-badge">
												<span class="badge badge-secondary">12</span>
											</span>
                        <!--end::Badge-->
                    </a>
                    <!--end::Menu link-->
                </div>
                <!--end::Menu Item-->
                <!--begin::Menu Item-->
                <div class="menu-item">
                    <!--begin::Menu link-->
                    <a class="menu-link" href="../../demo39/dist/apps/projects/project.html">
                        <!--begin::Bullet-->
                        <span class="menu-icon ps-2">
												<span class="bullet bullet-dot h-10px w-10px bg-warning"></span>
											</span>
                        <!--end::Bullet-->
                        <!--begin::Title-->
                        <span class="menu-title text-gray-700 fw-bold fs-6">Finance Dispatch</span>
                        <!--end::Title-->
                        <!--begin::Badge-->
                        <span class="menu-badge">
												<span class="badge badge-secondary">25</span>
											</span>
                        <!--end::Badge-->
                    </a>
                    <!--end::Menu link-->
                </div>
                <!--end::Menu Item-->
            </div>
            <!--end::Collapsible items-->
            <!--begin::Collapse toggle-->
            <div class="menu-item">
                <!--begin::Toggle-->
                <a class="menu-link menu-collapse-toggle toggle collapsible collapsed" data-bs-toggle="collapse" href="#kt_app_sidebar_menu_projects_collapse" data-kt-toggle-text="Show less">
										<span class="menu-icon ps-2">
											<i class="ki-outline ki-down toggle-off fs-4 text-gray-700 me-0"></i>
											<i class="ki-outline ki-up toggle-on fs-4 text-gray-700 me-0"></i>
										</span>
                    <!--begin::Title-->
                    <span class="menu-title text-gray-600 fw-semibold" data-kt-toggle-text-target="true">Show more</span>
                    <!--end::Title-->
                </a>
                <!--end::Toggle-->
            </div>
            <!--end::Collapse toggle-->
        </div>--}}
        <!--end::Teames-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Sidebar-->