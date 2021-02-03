<?php $this->view("painel/include/header"); ?>

    <!-- BREADCRUMB -->
    <div class="page-title-box">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <h4 class="page-title">Dashboard</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-right">
                    <li class="breadcrumb-item"><a href="javascript:void(0);"><?= SITE_NOME ?></a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- FIM >> BREADCRUMB -->

    <!-- CARDS -->
    <div class="row">

        <div class="col-md-8">
            <div class="row">
                <!-- FORNECEDORES -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="fas fa-truck bg-primary  text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">Fornecedores</h5>
                            </div>
                            <h3 class="mt-4"><?= $contFornecedor ?></h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">Apenas fornecedores ativos</p>
                        </div>
                    </div>
                </div>
                <!-- FIM >> FORNECEDORES -->

                <!-- MODELOS -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-heading p-4">
                            <div class="mini-stat-icon float-right">
                                <i class="fas fa-user-friends bg-success text-white"></i>
                            </div>
                            <div>
                                <h5 class="font-16">Modelos</h5>
                            </div>
                            <h3 class="mt-4"><?= $contModelo ?></h3>
                            <div class="progress mt-4" style="height: 4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mt-2 mb-0">Apenas modelos ativos</p>
                        </div>
                    </div>
                </div>
                <!-- FIM >> MODELOS -->
            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <h4 class="mt-0 header-title mb-4">Fornecedores x Modelos</h4>

                            <div id="morris-donut-example" class="morris-charts morris-chart-height"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- FIM >> CARDS -->

    <!-- START ROW -->
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Últimos fornecedores</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th class="text-center" scope="col">Telefone</th>
                                <th class="text-center" scope="col">Cidade</th>
                                <th class="text-center" scope="col">Ação</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (!empty($fornecedores)) : ?>

                                <?php foreach ($fornecedores as $fornecedor) : ?>
                                     <tr>
                                        <td><?= $fornecedor->nome ?></td>
                                        <td class="text-center"><?= $fornecedor->telefone ?></td>
                                        <td class="text-center"><?= $fornecedor->cidade ?></td>
                                        <td class="text-center">
                                            <a style="padding: 10px" href="<?= BASE_URL ?>fornecedor/editar/<?= $fornecedor->id_fornecedor ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <p>Sem fornecedores</p>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Últimos Modelos</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Nome</th>
                                <th class="text-center" scope="col">Telefone</th>
                                <th class="text-center" scope="col">Canal</th>
                                <th class="text-center" scope="col">Ação</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if (!empty($modelos)) : ?>

                                <?php foreach ($modelos as $modelo) : ?>
                                     <tr>
                                        <td><?= $modelo->nome ?></td>
                                        <td class="text-center"><?= $modelo->telefone ?></td>
                                        <td class="text-center">

                                            <?php if ($modelo->canal == "sistema") : ?>
                                                <span style="padding: 10px;font-size: 15px;font-weight: 600;" class="badge badge-primary">SISTEMA</span>
                                            <?php else : ?>
                                                <span style="padding: 10px;font-size: 15px;font-weight: 600;" class="badge badge-success">SITE</span>
                                            <?php endif; ?>

                                        </td>
                                        <td class="text-center">
                                            <a style="padding: 10px" href="<?= BASE_URL ?>modelo/editar/<?= $modelo->id_modelo ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            <?php else: ?>
                                <p>Sem modelos</p>
                            <?php endif; ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END ROW -->


<div style="display: none !important;">
    <div class="row d-none">
        <div class="col-xl-8">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title mb-4">Area Chart</h4>

                    <div id="morris-area-example" class="morris-charts morris-chart-height"></div>

                </div>
            </div>
        </div>
        <!-- end col -->

        <!-- end col -->
    </div>
    <div class="row d-none">
        <div class="col-xl-4">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Friends Suggestions</h4>
                    <div class="friends-suggestions">
                        <a href="#" class="friends-suggestions-list">
                            <div class="border-bottom position-relative">
                                <div class="float-left mb-0 mr-3">
                                    <img src="assets/images/users/user-2.jpg" alt="" class="rounded-circle thumb-md">
                                </div>
                                <div class="suggestion-icon float-right mt-2 pt-1">
                                    <i class="mdi mdi-plus"></i>
                                </div>

                                <div class="desc">
                                    <h5 class="font-14 mb-1 pt-2">Ralph Ramirez</h5>
                                    <p class="text-muted">3 Friend suggest</p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="friends-suggestions-list">
                            <div class="border-bottom position-relative">
                                <div class="float-left mb-0 mr-3">
                                    <img src="assets/images/users/user-3.jpg" alt="" class="rounded-circle thumb-md">
                                </div>
                                <div class="suggestion-icon float-right mt-2 pt-1">
                                    <i class="mdi mdi-plus"></i>
                                </div>

                                <div class="desc">
                                    <h5 class="font-14 mb-1 pt-2">Patrick Beeler</h5>
                                    <p class="text-muted">17 Friend suggest</p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="friends-suggestions-list">
                            <div class="border-bottom position-relative">
                                <div class="float-left mb-0 mr-3">
                                    <img src="assets/images/users/user-4.jpg" alt="" class="rounded-circle thumb-md">
                                </div>
                                <div class="suggestion-icon float-right mt-2 pt-1">
                                    <i class="mdi mdi-plus"></i>
                                </div>

                                <div class="desc">
                                    <h5 class="font-14 mb-1 pt-2">Victor Zamora</h5>
                                    <p class="text-muted">12 Friend suggest</p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="friends-suggestions-list">
                            <div class="border-bottom position-relative">
                                <div class="float-left mb-0 mr-3">
                                    <img src="assets/images/users/user-5.jpg" alt="" class="rounded-circle thumb-md">
                                </div>
                                <div class="suggestion-icon float-right mt-2 pt-1">
                                    <i class="mdi mdi-plus"></i>
                                </div>

                                <div class="desc">
                                    <h5 class="font-14 mb-1 pt-2">Bryan Lacy</h5>
                                    <p class="text-muted">18 Friend suggest</p>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="friends-suggestions-list">
                            <div class="position-relative">
                                <div class="float-left mb-0 mr-3">
                                    <img src="assets/images/users/user-6.jpg" alt="" class="rounded-circle thumb-md">
                                </div>
                                <div class="suggestion-icon float-right mt-2 pt-1">
                                    <i class="mdi mdi-plus"></i>
                                </div>

                                <div class="desc">
                                    <h5 class="font-14 mb-1 pt-2">James Sorrells</h5>
                                    <p class="text-muted mb-1">6 Friend suggest</p>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card m-b-30">
                <div class="card-body">
                    <h4 class="mt-0 header-title mb-4">Sales Analytics</h4>
                    <div id="morris-line-example" class="morris-chart" style="height: 360px"></div>

                </div>
            </div>

        </div>

        <div class="col-xl-4">
            <div class="card m-b-30">
                <div class="card-body">

                    <h4 class="mt-0 header-title mb-4">Recent Activity</h4>
                    <ol class="activity-feed mb-0">
                        <li class="feed-item">
                            <div class="feed-item-list">
                                <p class="text-muted mb-1">Now</p>
                                <p class="font-15 mt-0 mb-0">Andrei Coman posted a new article: <b class="text-primary">Forget UX Rowland</b></p>
                            </div>
                        </li>
                        <li class="feed-item">
                            <p class="text-muted mb-1">Yesterday</p>
                            <p class="font-15 mt-0 mb-0">Andrei Coman posted a new article: <b class="text-primary">Designer Alex</b></p>
                        </li>
                        <li class="feed-item">
                            <p class="text-muted mb-1">2:30PM</p>
                            <p class="font-15 mt-0 mb-0">Zack Wetass, <b class="text-primary"> Developer Moreno</b></p>
                        </li>
                        <li class="feed-item pb-1">
                            <p class="text-muted mb-1">12:48 PM</p>
                            <p class="font-15 mt-0 mb-2">Zack Wetass, <b class="text-primary">UX Murphy</b></p>
                        </li>

                    </ol>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->view("painel/include/footer"); ?>

<script>

    $( document ).ready(function() {

        !function ($) {
            "use strict";

            var Dashboard = function () {
            };

            //creates area chart
            Dashboard.prototype.createAreaChart = function (element, pointSize, lineWidth, data, xkey, ykeys, labels, lineColors) {
                Morris.Area({
                    element: element,
                    pointSize: 0,
                    lineWidth: 0,
                    data: data,
                    xkey: xkey,
                    ykeys: ykeys,
                    labels: labels,
                    resize: true,
                    gridLineColor: '#2a2c44',
                    hideHover: 'auto',
                    lineColors: lineColors,
                    fillOpacity: .9,
                    behaveLikeLine: true
                });
            },

                //creates Donut chart
                Dashboard.prototype.createDonutChart = function (element, data, colors) {
                    Morris.Donut({
                        element: element,
                        data: data,
                        resize: true,
                        labelColor: '#a5a6ad',
                        backgroundColor: '#222437',
                        colors: colors
                    });
                },
                //creates line chart Dark
                Dashboard.prototype.createLineChart1 = function(element, data, xkey, ykeys, labels, lineColors) {
                    Morris.Line({
                        element: element,
                        data: data,
                        xkey: xkey,
                        ykeys: ykeys,
                        labels: labels,
                        gridLineColor: '#2a2c44',
                        hideHover: 'auto',
                        pointSize: 3,
                        resize: true, //defaulted to true
                        lineColors: lineColors
                    });
                },


                Dashboard.prototype.init = function () {




                    //creating area chart
                    var $areaData = [
                        {y: '2013', a: 0, b: 0, c:0},
                        {y: '2014', a: 150, b: 45, c:15},
                        {y: '2015', a: 60, b: 150, c:220},
                        {y: '2016', a: 180, b: 36, c:21},
                        {y: '2017', a: 90, b: 60, c:360},
                        {y: '2018', a: 75, b: 240, c:120},
                        {y: '2019', a: 30, b: 30, c:30}
                    ];
                    this.createAreaChart('morris-area-example', 0, 0, $areaData, 'y', ['a', 'b', 'c'], ['Series A', 'Series B', 'Series C'], ['#fcbe2d', '#02c58d', '#30419b']);

                    //creating donut chart
                    var $donutData = [
                        {label: "Fornecedores", value: <?= $contFornecedor ?> },
                        {label: "Modelos", value: <?= $contModelo ?> }
                    ];
                    this.createDonutChart('morris-donut-example', $donutData, ['#30419b', '#02c58d']);
                    //create line chart Dark
                    var $data1  = [
                        { y: '2009', a: 20, b: 5 },
                        { y: '2010', a: 45,  b: 35 },
                        { y: '2011', a: 50,  b: 40 },
                        { y: '2012', a: 75,  b: 65 },
                        { y: '2013', a: 50,  b: 40 },
                        { y: '2014', a: 75,  b: 65 },
                        { y: '2015', a: 100, b: 90 }
                    ];
                    this.createLineChart1('morris-line-example', $data1, 'y', ['a', 'b'], ['Series A', 'Series B'], ['#30419b', '#02c58d']);



                },
                //init
                $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
        }(window.jQuery),

            //initializing
            function ($) {
                "use strict";
                $.Dashboard.init();
            }(window.jQuery);

    });

</script>
