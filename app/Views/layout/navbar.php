<nav class="navbar navbar-expand-sm navbar-light bg-white shadow-none">

    <div class="container-fluid mt-4 justify-content-center">
        <section id="main-logo" class="col-sm-4 justify-content-around h-fit align-items-center">
            <button button type="button" id="sidebarCollapse" class="h-fit btn btn-info  d-inline-block rounded-circle mx-2" style="background-color:#226DA8">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
            <a class=" h-fit navbar-brand d-inline-block col-8 mr-0" href="/pages">
                <?php if (in_groups('admin')): ?>
                    <img src="/img/logoPutih.png" alt="" class="img-fluid">
                <?php else: ?>
                    <img src="/img/logoWarna.png" alt="" class="img-fluid">
                <?php endif; ?>
            </a>
            <?php if (getenv('appFlag')) : ?>
                <a class="h-fit btn d-inline-block d-sm-none p-0 m-0 shadow collapsed rounded-circle" href="<?= (!service('authentication')->check()) ? base_url('login') :  base_url('logout'); ?>">
                    <i class="fa fa-user p-2 rounded-circle" style=" color:white; background:linear-gradient(45deg,#3A85D3, #5DAF57) ;"></i>
                </a>
            <?php endif ?>
        </section>

        <!-- Tambahkan form search bar di luar collapse agar selalu tampil -->
        <form action="/pages/searchPage" method="get" class="w-100 d-block d-sm-none my-2">
            <?= csrf_field(); ?>
            <div class="search-bar shadow bg-white rounded-pill px-4 py-2 d-flex align-items-center">
                <input type="text" class="form-control border-0 bg-transparent" placeholder="Cari Petunjuk" name="keyword" style="box-shadow:none;">
                <button class="btn" type="submit" name="submit" style="background: none;">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav w-100 justify-content-between align-items-center">
                <li class="nav-item col-md-9 col-sm-8 d-none d-sm-block">
                    <!-- Search bar hanya tampil di desktop/tablet -->
                    <form action="/pages/searchPage" method="get" class="w-100">
                        <?= csrf_field(); ?>
                        <div class="search-bar shadow bg-white rounded-pill px-4 py-2 d-flex align-items-center">
                            <input type="text" class="form-control border-0 bg-transparent" placeholder="Cari Petunjuk" name="keyword" style="box-shadow:none;">
                            <button class="btn" type="submit" name="submit" style="background: none;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    <?php if (session()->get('isLoggedIn')) : ?>
                        <div class="dropdown">
                            <button class="btn dropdown-toggle px-sm-auto px-md-4 py-2 bg-white text-black shadow rounded-pill d-flex align-items-center"
                                type="button"
                                id="userDropdown"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                                <i class="fa fa-user p-2 rounded-circle mr-3"
                                    style="color:white; background:linear-gradient(45deg,#3A85D3, #5DAF57);"></i>
                                <?php if (logged_in()) : ?>
                                    <?= esc(user()->username) ?>
                                <?php endif; ?>

                            </button>
                            <div class="dropdown-menu dropdown-menu-right mt-2 shadow" style="right: 0.5rem; " aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="/logout">Logout</a>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    @media (max-width: 768px) {
        .search-bar {
            width: 100% !important;
            max-width: 100vw !important;
            margin: 0.5rem 0 1.2rem 0 !important;
            padding: 0.7rem 1.2rem !important;
            border-radius: 1.5rem !important;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.09) !important;
            display: flex !important;
            align-items: center !important;
            position: relative;
        }

        .search-bar .form-control {
            font-size: 1rem !important;
            padding: 0.5rem 2.2rem 0.5rem 0.7rem !important;
            /* right padding for icon */
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
            width: 100% !important;
        }

        .search-bar .btn {
            position: absolute !important;
            right: 1.2rem !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            min-width: 36px !important;
            padding: 0 !important;
            margin-left: 0 !important;
            color: #3A85D3 !important;
            background: none !important;
            z-index: 2;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }
</style>