<?= $this->extend('layout/template3'); ?>
<?= $this->section('content'); ?>
<div id="header-bottom" class="col justify-content-between d-flex align-items-center p-0 p-sm-1" style="color:white; background-image: url(/img/judulBgDetail.png); min-height:100px; max-height:160px; height:8%;">
    <a href="/pages" class="d-flex align-items-center">
        <img src="/img/backLogo.png" alt="" class="m-2" style="max-height:25px">
        <p class="d-none d-md-flex m-0">Kembali ke Menu Awal</p>
    </a>
    <h1 class="card-title"><?= $manual['title']; ?></h1>
    <br>
</div>

<div class="wrapper" id="wrapper">
    <nav id="sidebar" class="shadow " style="background-color: white;">
        <div class="container p-0 overflow-auto" id="sidebar-container">
            <div class="find-container my-2 mx-auto">
                <input type="text" id="searchInput" placeholder="Find">
                <button class="border-0" id="prevButton" style="background-color: transparent;"><i class="fa fa-caret-up"></i></button>
                <button class="border-0" id="nextButton" style="background-color: transparent;"><i class="fa fa-caret-down"></i></button>
                <button class="border-0" id="closeButton" style="background-color: transparent;"><i class="fa fa-times"></i></button>
            </div>
            <div class="sidebar-header" id="sidebar-header" style="background-color: white;">
                <div class="container">
                    <div class="row align-items-center mt-4">
                        <h1 class="col-8" style="color:black;">Contents</h1>
                        <div class="col-4 d-flex justify-content-end">
                            <button type="button" id="sidebarCollapse2" class=" btn btn-primary d-inline-block rounded-circle" style="background:#3A85D3">
                                <i class="fa fa-times"></i>
                                <span class="sr-only">Toggle Menu</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <div data-toc style="color:black; max-height: 750px;" class="toc mx-4"> </div>
        </div>
    </nav>
    <div class="container mt-4" id="detail-content">
        <div class="row">
            <div class="col-1" id="main-logo">
                <div class="container">
                    <div class="row align-items-center mt-4">
                        <button type="button" id="sidebarCollapse" class=" btn btn-primary d-inline-block rounded-circle" style="background:#3A85D3">
                            <i class="fa fa-bars"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="ml-4 col-10">
                <!-- <div class="row">
                </div> -->
                <div class="row mt-3">
                    <div class="col d-flex align-items-end">
                        <div class="d-flex flex-column">
                            <p class="m-0"><b>Last Updated: </b><?= $manual['created_at']; ?></p>
                            <p class="card-text m-0"><b> Editor : </b><?= $manual['editor']; ?></p>
                            <p class="card-text m-0"><b> Version : </b><?= $manual['versioning']; ?></p>
                        </div>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <div class="d-inline mx-2">
                            <a href="/pages/history/<?= $manual['slug']; ?>" class="btn btn-primary rounded-lg bg-white" style="border-color:#3A85D3; color:#3A85D3;">
                                <i class="fa fa-history"></i>
                                History
                            </a>
                        </div>
                        <?php if (in_groups('admin')) : ?>
                            <div class="d-inline mx-2">
                                <a href="/pages/edit/<?= $manual['slug']; ?>" class="btn btn-primary rounded-lg bg-white" style="border-color:#3A85D3; color:#3A85D3;">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </a>
                            </div>

                            <form action="/pages/history/<?= $manual['id']; ?>" method="post" class="d-inline" style="border-color:#3A85D3; color:#3A85D3;">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn rounded-lg bg-white ml-2" onclick="return confirm('Apakah Anda Yakin?')" style="border-color:#3A85D3; color:#3A85D3;">
                                    <i class="fa fa-trash"></i>
                                    Delete
                                </button>
                            </form>
                            <br>
                        <?php endif ?>
                    </div>
                </div>

                <div class="row justify-content-center" id="content">
                    <div class="col">
                        <div data-content>
                            <div class="ql-editor">
                                <?= $manual['content']; ?>
                            </div>
                        </div>

                        </p>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    tableOfContents('[data-content]', '[data-toc]', {
        levels: 'h1, h2, h3, h4, h5, h6', // The heading levels to generate a table of contents from
        heading: '', // The heading text for the table of contents list
        headingLevel: 'h2', // The level to use for the heading for the table of contents list
        listType: 'ul' // The list type to use for the table of contents
    });
    document.addEventListener('DOMContentLoaded', () => {
        const searchInput = document.getElementById('searchInput');
        const prevButton = document.getElementById('prevButton');
        const nextButton = document.getElementById('nextButton');
        const closeButton = document.getElementById('closeButton');
        const content = document.querySelector('.content');

        let searchTerms = '';

        const findText = () => {
            if (searchTerms.trim() === '') return;

            const found = window.find(searchTerms, false, false, true);
        };

        const executeSearch = () => {
            searchTerms = searchInput.value;
            findText();
        };



        searchInput.addEventListener('keydown', (event) => {
            if (event.keyCode === 13) { // Check if Enter key is pressed
                executeSearch();
                event.preventDefault(); // Prevent default Enter key behavior (e.g., form submission)
            }
        });

        prevButton.addEventListener('click', () => {
            const found = window.find(searchTerms, false, true, true);
        });

        nextButton.addEventListener('click', () => {
            const found = window.find(searchTerms, false, false, true);
        });

        closeButton.addEventListener('click', () => {
            searchInput.value = '';
            searchTerms = '';
            window.find('', false, false, true);
        });
    });
</script>

<style>
    .find-container {
        position: relative;
        width: fit-content;
        padding: 10px;
        background-color: #f5f5f5;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        z-index: 10;
        display: flex;
        align-items: center;
    }

    input[type="text"] {
        flex-grow: 1;
        margin-right: 10px;
        padding: 5px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
</style>
<?= $this->endSection(); ?>