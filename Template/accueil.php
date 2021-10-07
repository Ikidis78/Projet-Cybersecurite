<main role="main">
    <script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "Répartition des livres par genre"
            },
            subtitles: [{
                text: "en nombre de livres"
            }],
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "฿#,##0",
                dataPoints: <?php echo json_encode(Livre::livreParGenre(), JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
    </script>
    <div class="row pt-5"></div>
    <div class="jumbotron container mt-3">
        <div class="container">
            <h1 class="display-3">Bienvenue !</h1>
            <p>Bienvenue sur le site d'administration de BiblioWeb</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8" style="height: 600px">
                <div class="card border-primary mb-3" style="height: 600px">
                    <div class="card-header"> statistiques livres </div>
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="card-text" id="chartContainer">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4" style="height: 600px">
                <div class="card border-primary mb-3" style="height: 600px">
                    <div class="card-header"> statistiques générales </div>
                    <div class="card-body mt-5">
                        <h1 class="card-title text-center"><a href="index.php?uc=livres&action=list"><span
                                    class="badge badge-success"><?php echo Livre::nombreLivres(); ?></span> livres</a>
                        </h1>
                        <hr>
                        <h1 class="card-title text-center pt-5 "> <a href="index.php?uc=auteurs&action=list"><span
                                    class="badge badge-primary"><?php echo Auteur::nombreAuteurs(); ?></span>
                                auteurs</a>
                        </h1>
                        <hr>
                        <h1 class="card-title text-center pt-5"><a href="index.php?uc=genres&action=list"><span
                                    class="badge badge-danger"><?php echo Genre::nombreGenres(); ?></span>
                                genres</a>
                        </h1>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</main>