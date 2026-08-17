<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo $__env->yieldPushContent('meta'); ?>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> | <?php echo e(site_name()); ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo e(favicon()); ?>">

    <!-- Scripts -->
    <script src="<?php echo e(asset('vendor/admin.js')); ?>" defer></script>

    <!-- Page level scripts -->
    <?php echo $__env->yieldPushContent('scripts'); ?>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Inter:300,400,600,800&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('vendor/admin.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body <?php if(dark_theme()): ?> data-bs-theme="dark" <?php endif; ?>>
    <!-- Page Wrapper -->
    <div class="wrapper">

        <!-- Sidebar -->
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">

                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo e(route('home')); ?>">
                    <div class="sidebar-brand-text mx-3">
                        <img src="<?php echo e(asset('svg/azuriom-text-white.svg')); ?>" alt="Azuriom">

                        <small class="d-block text-center font-weight-bold">
                            <?php echo e(game()->name()); ?> - v<?php echo e(Azuriom::version()); ?>

                        </small>
                    </div>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-item <?php echo e(add_active('admin.dashboard')); ?>">
                        <a class="sidebar-link" href="<?php echo e(route('admin.dashboard')); ?>">
                            <i class="bi bi-speedometer"></i> <?php echo e(trans('admin.nav.dashboard')); ?>

                        </a>
                    </li>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['admin.settings', 'admin.navbar', 'admin.servers'])): ?>
                        <li class="sidebar-header">
                            <?php echo e(trans('admin.nav.settings.heading')); ?>

                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.settings')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.settings.*', 'admin.social-links.*')); ?>">
                            <a class="sidebar-link <?php echo e(Route::is('admin.settings.*', 'admin.social-links.*') ? '' : 'collapsed'); ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
                                <i class="bi bi-gear"></i>
                                <span><?php echo e(trans('admin.nav.settings.heading')); ?></span>
                            </a>
                            <ul id="collapseSettings" class="sidebar-dropdown list-unstyled collapse <?php echo e(Route::is('admin.settings.*', 'admin.social-links.*') ? 'show' : ''); ?>" data-parent="#accordionSidebar">
                                <li class="sidebar-item <?php echo e(add_active('admin.settings.index')); ?>">
                                    <a class="sidebar-link" href="<?php echo e(route('admin.settings.index')); ?>">
                                        <?php echo e(trans('admin.nav.settings.global')); ?>

                                    </a>
                                </li>
                                <li class="sidebar-item <?php echo e(add_active('admin.settings.home')); ?>">
                                    <a class="sidebar-link" href="<?php echo e(route('admin.settings.home')); ?>">
                                        <?php echo e(trans('admin.nav.settings.home')); ?>

                                    </a>
                                </li>
                                <?php if(! oauth_login()): ?>
                                    <li class="sidebar-item <?php echo e(add_active('admin.settings.auth')); ?>">
                                        <a class="sidebar-link" href="<?php echo e(route('admin.settings.auth')); ?>">
                                            <?php echo e(trans('admin.nav.settings.auth')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li class="sidebar-item <?php echo e(add_active('admin.settings.mail')); ?>">
                                    <a class="sidebar-link" href="<?php echo e(route('admin.settings.mail')); ?>">
                                        <?php echo e(trans('admin.nav.settings.mail')); ?>

                                    </a>
                                </li>
                                <li class="sidebar-item <?php echo e(add_active('admin.settings.performance')); ?>">
                                    <a class="sidebar-link" href="<?php echo e(route('admin.settings.performance')); ?>">
                                        <?php echo e(trans('admin.nav.settings.performances')); ?>

                                    </a>
                                </li>
                                <li class="sidebar-item <?php echo e(add_active('admin.settings.maintenance')); ?>">
                                    <a class="sidebar-link" href="<?php echo e(route('admin.settings.maintenance')); ?>">
                                        <?php echo e(trans('admin.nav.settings.maintenance')); ?>

                                    </a>
                                <li class="sidebar-item <?php echo e(add_active('admin.social-links.*')); ?>">
                                    <a class="sidebar-link" href="<?php echo e(route('admin.social-links.index')); ?>">
                                        <?php echo e(trans('admin.nav.settings.social')); ?>

                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.navbar')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.navbar-elements.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.navbar-elements.index')); ?>">
                                <i class="bi bi-list"></i>
                                <span><?php echo e(trans('admin.nav.settings.navbar')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.servers')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.servers.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.servers.index')); ?>">
                                <i class="bi bi-hdd-network"></i>
                                <span><?php echo e(trans('admin.nav.settings.servers')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['admin.users', 'admin.roles'])): ?>
                        <!-- Heading -->
                        <li class="sidebar-header"><?php echo e(trans('admin.nav.users.heading')); ?></li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.users')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.users.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.users.index')); ?>">
                                <i class="bi bi-people"></i>
                                <span><?php echo e(trans('admin.nav.users.users')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.roles')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.roles.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.roles.index')); ?>">
                                <i class="bi bi-person-badge"></i>
                                <span><?php echo e(trans('admin.nav.users.roles')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.users')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.bans.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.bans.index')); ?>">
                                <i class="bi bi-person-x"></i>
                                <span><?php echo e(trans('admin.nav.users.bans')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['admin.pages', 'admin.posts', 'admin.images', 'admin.redirects'])): ?>
                        <li class="sidebar-header"><?php echo e(trans('admin.nav.content.heading')); ?></li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.pages')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.pages.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.pages.index')); ?>">
                                <i class="bi bi-file-earmark"></i>
                                <span><?php echo e(trans('admin.nav.content.pages')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.posts')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.posts.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.posts.index')); ?>">
                                <i class="bi bi-newspaper"></i>
                                <span><?php echo e(trans('admin.nav.content.posts')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.images')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.images.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.images.index')); ?>">
                                <i class="bi bi-image"></i>
                                <span><?php echo e(trans('admin.nav.content.images')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.redirects')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.redirects.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.redirects.index')); ?>">
                                <i class="bi bi-signpost"></i>
                                <span><?php echo e(trans('admin.nav.content.redirects')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['admin.plugins', 'admin.themes'])): ?>
                        <li class="sidebar-header"><?php echo e(trans('admin.nav.extensions.heading')); ?></li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.plugins')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.plugins.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.plugins.index')); ?>">
                                <i class="bi bi-puzzle"></i>
                                <span><?php echo e(trans('admin.nav.extensions.plugins')); ?></span>
                                <?php if(($pluginsUpdates ?? 0) > 0): ?>
                                    <span class="sidebar-badge badge bg-danger">
                                        <?php echo e($pluginsUpdates); ?>

                                    </span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.themes')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.themes.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.themes.index')); ?>">
                                <i class="bi bi-brush"></i>
                                <span><?php echo e(trans('admin.nav.extensions.themes')); ?></span>
                                <?php if(($themesUpdates ?? 0) > 0): ?>
                                    <span class="sidebar-badge badge bg-danger">
                                        <?php echo e($themesUpdates); ?>

                                    </span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(! plugins()->getAdminNavItems()->isEmpty()): ?>
                        <li class="sidebar-header">Plugins</li>
                    <?php endif; ?>

                    <?php $__currentLoopData = plugins()->getAdminNavItems(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navId => $navItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(! isset($navItem['permission']) || Gate::any($navItem['permission'])): ?>
                            <?php if(($navItem['type'] ?? '') !== 'dropdown'): ?>
                                <li class="sidebar-item <?php echo e(add_active($navItem['route'])); ?>">
                                    <a class="sidebar-link" href="<?php echo e(route($navItem['route'])); ?>">
                                        <i class="<?php echo e($navItem['icon']); ?>"></i>
                                        <span><?php echo e($navItem['name']); ?></span>
                                    </a>
                                </li>
                            <?php elseif(Arr::first($navItem['items'] ?? [], fn ($item) => ! isset($item['permission']) || Gate::check($item['permission']))): ?>
                                <li class="sidebar-item <?php if(isset($navItem['route'])): ?> <?php echo e(add_active($navItem['route'])); ?> <?php endif; ?>">
                                    <a class="sidebar-link <?php if(! isset($navItem['route']) || ! Route::is($navItem['route'])): ?> collapsed <?php endif; ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo e(ucfirst($navId)); ?>" aria-expanded="true" aria-controls="collapse<?php echo e(ucfirst($navId)); ?>">
                                        <i class="<?php echo e($navItem['icon']); ?>"></i>
                                        <span><?php echo e($navItem['name']); ?></span>
                                    </a>
                                    <ul id="collapse<?php echo e(ucfirst($navId)); ?>" class="sidebar-dropdown list-unstyled collapse <?php if(isset($navItem['route']) && Route::is($navItem['route'])): ?> show <?php endif; ?>" data-parent="#accordionSidebar">
                                        <?php $__currentLoopData = $navItem['items'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $route => $subItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(! isset($subItem['permission']) || Gate::check($subItem['permission'])): ?>
                                                <li class="sidebar-item <?php echo e(add_active($route)); ?>">
                                                    <a class="sidebar-link" href="<?php echo e(route($route)); ?>">
                                                        <span><?php echo e(is_array($subItem) ? $subItem['name'] : $subItem); ?></span>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['admin.update', 'admin.logs'])): ?>
                        <li class="sidebar-header"><?php echo e(trans('admin.nav.other.heading')); ?></li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.update')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.update.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.update.index')); ?>">
                                <i class="bi bi-cloud-download"></i>
                                <span><?php echo e(trans('admin.nav.other.update')); ?></span>
                                <?php if($hasUpdate): ?>
                                    <span class="sidebar-badge badge bg-danger">
                                        1
                                    </span>
                                <?php endif; ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin.logs')): ?>
                        <li class="sidebar-item <?php echo e(add_active('admin.logs.*')); ?>">
                            <a class="sidebar-link" href="<?php echo e(route('admin.logs.index')); ?>">
                                <i class="bi bi-clock-history"></i>
                                <span><?php echo e(trans('admin.nav.other.logs')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="main">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <div class="d-none d-sm-inline-block">
                        <a href="https://azuriom.com/discord" class="btn btn-outline-primary mx-1" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-question-circle"></i>
                            <?php echo e(trans('admin.nav.support')); ?>

                        </a>

                        <a href="https://azuriom.com/docs" class="btn btn-outline-secondary mx-1" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-journals"></i>
                            <?php echo e(trans('admin.nav.documentation')); ?>

                        </a>
                    </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="position-relative">
                                    <!-- Counter - Notifications -->
                                    <i class="bi bi-bell small"></i>
                                    <?php if(! $notifications->isEmpty()): ?>
                                        <span class="indicator" id="notificationsCounter"><?php echo e($notifications->count()); ?></span>
                                    <?php endif; ?>
                                </div>
                            </a>

                            <!-- Dropdown - Notifications -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="notificationsDropdown">
                                <div class="dropdown-menu-header">
                                    <?php echo e(trans('messages.notifications.notifications')); ?>

                                </div>

                                <?php if(! $notifications->isEmpty()): ?>
                                    <div id="notifications" class="list-group">
                                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e($notification->link ? url($notification->link) : '#'); ?>" class="list-group-item">
                                                <div class="row g-0 align-items-center">
                                                    <div class="col-2 text-<?php echo e($notification->level); ?>">
                                                        <span class="d-inline-block rounded-circle p-1 border border-<?php echo e($notification->level); ?>">
                                                            <i class="bi bi-<?php echo e($notification->icon()); ?> mx-1"></i>
                                                        </span>
                                                    </div>
                                                    <div class="col-10">
                                                        <p>
                                                            <?php echo e($notification->content); ?>

                                                        </p>
                                                        <small class="text-body-secondary">
                                                            <?php echo e(format_date($notification->created_at, true)); ?>

                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <div class="dropdown-menu-footer">
                                            <a href="<?php echo e(route('notifications.read.all')); ?>" id="readNotifications" class="text-body-secondary">
                                                <span class="d-none spinner-border spinner-border-sm loader" role="status"></span>
                                                <?php echo e(trans('messages.notifications.read')); ?>

                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div id="noNotificationsLabel" class="dropdown-menu-footer text-success <?php if(! $notifications->isEmpty()): ?> d-none <?php endif; ?>">
                                    <i class="bi bi-check-lg"></i> <?php echo e(trans('messages.notifications.empty')); ?>

                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo e(route('profile.theme')); ?>" class="nav-icon <?php if(! dark_theme()): ?> d-none <?php endif; ?>" data-theme-value="light">
                                <i class="bi bi-sun small" title="<?php echo e(trans('messages.theme.light')); ?>" data-bs-toggle="tooltip"></i>
                            </a>
                            <a href="<?php echo e(route('profile.theme')); ?>" class="nav-icon <?php if(dark_theme()): ?> d-none <?php endif; ?>" data-theme-value="dark">
                                <i class="bi bi-moon-stars small" title="<?php echo e(trans('messages.theme.dark')); ?>" data-bs-toggle="tooltip"></i>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="avatar img-fluid rounded me-1" src="<?php echo e(auth()->user()->getAvatar()); ?>" alt="Avatar">
                                <span class="me-2 d-none d-lg-inline text-gray-600 small"><?php echo e(Auth::user()->name); ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo e(route('admin.users.edit', Auth::user())); ?>">
                                    <i class="bi bi-person-circle me-1"></i>
                                    <?php echo e(trans('admin.nav.profile.profile')); ?>

                                </a>
                                <a class="dropdown-item" href="<?php echo e(route('home')); ?>">
                                    <i class="bi bi-house me-1"></i>
                                    <?php echo e(trans('admin.nav.back')); ?>

                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" data-route="logout">
                                    <i class="bi bi-box-arrow-right me-1"></i>
                                    <?php echo e(trans('auth.logout')); ?>

                                </a>
                            </div>
                        </li>

                    </ul>
                </div>

            </nav>

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><?php echo $__env->yieldContent('title', 'Admin'); ?></h1>

                    <?php echo $__env->make('admin.elements.session-alerts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <?php echo $__env->yieldContent('content'); ?>
                </div>

                <!-- Delete confirm modal -->
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="confirmDeleteLabel"><?php echo e(trans('admin.delete.title')); ?></h2>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <div class="modal-body"><?php echo e(trans('admin.delete.description')); ?></div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                                    <i class="bi bi-x-lg"></i> <?php echo e(trans('messages.actions.cancel')); ?>

                                </button>
                                <form id="confirmDeleteForm" method="POST">
                                    <?php echo method_field('DELETE'); ?>
                                    <?php echo csrf_field(); ?>

                                    <button class="btn btn-danger" type="submit">
                                        <i class="bi bi-exclamation-triangle"></i> <?php echo e(trans('messages.actions.delete')); ?>

                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <p class="mb-0 py-2 text-center text-body-secondary">
                        <?php echo app('translator')->get('admin.footer', [
                            'year' => '2019-'.now()->year,
                            'azuriom' => '<a href="https://azuriom.com" target="_blank" rel="noopener noreferrer">Azuriom</a>',
                            'startbootstrap' => '<a href="https://adminkit.io/" target="_blank" rel="noopener noreferrer">AdminKit</a>'
                        ]); ?>
                    </p>
                </div>
            </footer>
        </div>
    </div>

<form id="logoutForm" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
    <?php echo csrf_field(); ?>
</form>

<?php echo $__env->yieldPushContent('footer-scripts'); ?>

</body>
</html>
<?php /**PATH F:\Logiciel\laragon\www\Azuriomm\resources\views/admin/layouts/admin.blade.php ENDPATH**/ ?>