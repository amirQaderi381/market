<header class="header bg-light">
    <section class="sidebar-header bg-gray">
        <section class="d-flex justify-content-between flex-md-row-reverse px-2">
            <span id="sidebar-toggle-show" class="d-inline d-md-none pointer"><i class="fas fa-toggle-off"></i></span>
            <span id="sidebar-toggle-hide" class="d-none d-md-inline pointer"><i class="fas fa-toggle-on"></i></span>
            <span>
                <img class="logo" src="{{ asset('admin_assets/images/logo.png') }}" alt="">
            </span>
            <span class="d-md-none" id="menu-toggle"><i class="fas fa-ellipsis-h"></i></span>
        </section>
    </section>

    <section class="body-header">
        <section class="d-flex justify-content-between">
            <section>
                <!-- right section of body-header -->
                <span class="mr-5">
                    <!-- search-box -->
                    <span class="search-area p-2 d-none">
                        <i id="search-area-hide" class="fas fa-times pointer"></i>
                        <input type="text" class="search-input pointer">
                        <i class="fas fa-search"></i>
                    </span>
                    <i id="search-toggle" class="fas fa-search d-none d-md-inline p-1 pointer"></i>
                </span>

                <!-- left section of body-header -->
                <span id="full-screen" class="pointer d-none d-md-inline p-1 mr-5">
                    <i id="screen-compress" class="fas fa-compress d-none"></i>
                    <i id="screen-expand" class="fas fa-expand "></i>
                </span>

            </section>


            <section>
                <span class="ml-2 ml-md-4 position-relative">
                    <span id="header-notification-toggle" class="pointer">
                        <i class="far fa-bell"></i>
                        <sup class="badge badge-danger">4</sup>
                    </span>

                    <section class="header-notification rounded">
                        <section class="d-flex justify-content-between rounded">
                            <span class="px-2">نوتیفیکیشن ها</span>
                            <span class="px-2">
                                <span class="badge badge-danger">جدید</span>
                            </span>
                        </section>
                        <ul class="list-group rounded px-0">
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <h5 class="notification-user">محمد هاشمی</h5>
                                        <p class="notification-text">این یک متن تستی است</p>
                                        <p class="notification-time">30 دقیقه پیش</p>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <h5 class="notification-user">محمد هاشمی</h5>
                                        <p class="notification-text">این یک متن تستی است</p>
                                        <p class="notification-time">30 دقیقه پیش</p>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <h5 class="notification-user">محمد هاشمی</h5>
                                        <p class="notification-text">این یک متن تستی است</p>
                                        <p class="notification-time">30 دقیقه پیش</p>
                                    </section>
                                </section>
                            </li>
                        </ul>
                    </section>


                </span>

                <span id="header-comment-toggle" class="ml-2 ml-md-4 position-relative pointer">
                    <i class="far fa-comment-alt"></i>
                    <sup class="badge badge-danger">3</sup>
                </span>

                <section class="header-comment rounded">
                    <section class="border-bottom px-4">
                        <input type="text" class="form-control form-control-sm shadow-none my-4"
                            placeholder="جستجو ...">
                    </section>

                    <section class="header-content-wrapper">
                        <ul class="list-group rounded px-0">
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                            <li class="list-group-item list-group-item-action">
                                <section class="media">
                                    <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                                        class="notification-img">
                                    <section class="media-body pr-1">
                                        <section class="d-flex justify-content-between align-items-center">
                                            <h5 class="comment-user">محمد هاشمی</h5>
                                            <i class="fas fa-circle text-success comment-user-status"></i>
                                        </section>
                                    </section>
                                </section>
                            </li>
                        </ul>
                    </section>

                </section>

                <span id="header-profile-toggle" class="ml-2 ml-md-4 position-relative pointer">
                    <span>
                        <img src="{{ asset('admin_assets/images/avatar-2.jpg') }}" alt="avatar"
                            class="header-avatar">
                        <span class="header-username">کامران محمدی</span>
                        <span><i class="fas fa-chevron-down"></i></span>
                    </span>

                    <section class="header-profile rounded">
                        <section class="list-group rounded">
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-cog"></i> تنظیمات
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-user"></i> کاربر
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="far fa-envelope"></i> پیام ها
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-lock"></i> قفل صفحه
                            </a>
                            <a href="#" class="list-group-item list-group-item-action header-profile-link">
                                <i class="fas fa-sign-out-alt"></i> خروج
                            </a>
                        </section>
                    </section>
                </span>

            </section>

        </section>
    </section>

</header>
