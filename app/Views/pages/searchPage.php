<?= $this->extend('layout/template2'); ?>
<?= $this->section('content'); ?>

<div class="mt-2 p-4">
    <div class="row h-fit">
        <div class="container">
            <div class="col-12 d-flex p-0 flex-column align-items-center justify-content-center">
                <div class="row w-100">
                    <a href="/pages/" class="d-flex align-items-center m-2 w-fit mb-3" style="border-bottom: 3px solid #dee2e6 !important;">
                        <img src="/img/backLogo.png" alt="back" style="max-height:25px">
                        <p class="d-none d-md-flex m-0" style="color: #3A85D3;">Kembali ke Menu Awal</p>
                    </a>
                    <h3 class=" col-12">Search Results</h3>
                    <div style="height: 2px; background-color: #EAEFF5" class="mb-3 col-12"></div>
                    <form action="/pages/searchPage" method="get" class="d-flex mb-3">
                        <input type="text" name="keyword" class="form-control" placeholder="Cari manual..." required>
                        <button type="submit" class="btn btn-primary ms-2">Cari</button>
                    </form>
                    <?php if (!empty($results)) : ?>
                        <ul class="list-unstyled w-100">
                            <?php foreach ($results as $result) : ?>
                                <li class="mb-4 p-3 rounded shadow-sm bg-white">
                                    <a href="/pages/<?= esc($result['slug']); ?>" class="text-decoration-none">
                                        <h4 class="fw-bold mb-2" style="color: #1a33d8;"><?= esc($result['title']); ?></h4>
                                    </a>
                                    <div class="text-secondary" style="font-size: 1rem;">
                                        <?php
                                        // Ambil excerpt dari content, highlight keyword jika ada
                                        $content = strip_tags($result['content']);
                                        $keyword_pos = stripos($content, $keyword);
                                        $excerpt_length = 180;
                                        if ($keyword_pos !== false) {
                                            $start = max(0, $keyword_pos - $excerpt_length / 2);
                                            $excerpt = substr($content, $start, $excerpt_length);
                                            // Highlight keyword
                                            $excerpt = str_ireplace($keyword, '<mark>' . $keyword . '</mark>', $excerpt);
                                            if ($start > 0) $excerpt = '...' . $excerpt;
                                            if ($start + $excerpt_length < strlen($content)) $excerpt .= '...';
                                        } else {
                                            $excerpt = substr($content, 0, $excerpt_length) . (strlen($content) > $excerpt_length ? '...' : '');
                                        }
                                        ?>
                                        <?= $excerpt ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p>No results found.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script src="/js/main.js"></script> -->
<?= $this->endSection(); ?>