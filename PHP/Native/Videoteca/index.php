<?php
    include 'config/config.php';
    include 'classes/Database.php';
    include 'classes/Film.php';

    $db = new Database();
    $conn = $db->getConn();
    $filmManager = new Film($conn);
    include 'config/manager.php';
    $filmList = $filmManager->getAllFilms();
?>
<html>

<head>
    <title>Videoteca PHP</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Videoteca</h1>
    <div class="pageContainerDiv">
        <div class="resultDiv" id="resultDiv"><?= $resultValue ?></div>
        <div class="videotecaBlockDiv" id="videotecaLeftBlockDiv">
            <h3>Video List ( <?= count($filmList) ?> )</h3>

            <div class="videoListContainerTitle">
                <div class="tdCell tdCellTitle tdCellLastRow">Titolo</div>
                <div class="tdCell tdCellTitle tdCellLastRow">Autore</div>
                <div class="tdCell tdCellTitle tdCellLastRow">Anno</div>
                <div class="tdCell tdCellTitle tdCellLastRow">Genere</div>
                <div class="tdCell tdCellTitle tdCellLastRow tdCellLast">&nbsp;</div>
                <div class="clearDiv"></div>
            </div>
            <div class="videoListContainer">
                <?php
                if (count($filmList)) {
                    foreach ($filmList as $f):
                ?>
                    <div class="tdCell tdCellLastRow" id="tdCellTitle_<?=$f['id']?>"><?= $f["title"] ?></div>
                    <div class="tdCell tdCellLastRow" id="tdCellAuthor_<?=$f['id']?>"><?= $f["author"] ?></div>
                    <div class="tdCell tdCellLastRow" id="tdCellYear_<?=$f['id']?>"><?= $f["year"] ?></div>
                    <div class="tdCell tdCellLastRow" id="tdCellGenre_<?=$f['id']?>"><?= $f["genre"] ?></div>
                    <div class="tdCell tdCellLastRow tdCellLast">
                        <span class='actionSpan' id="deleteSpan" opRef='delete' ref="<?= $f['id'] ?>">Rimuovi</span> |
                        <span class='actionSpan' id="updateSpan" opRef='update' ref="<?= $f['id'] ?>">Modifica</span>
                    </div>
                <?php
                    endforeach;
                } else {
                    echo "Nessun film presente";
                }
                ?>
            </div>
        </div>

        <div class="videotecaBlockDiv" id="videotecaLeftBlockDiv">
            <div class="actLabelDiv">Aggiornamento lista film</div>
            <form id="updateVideoForm" name="updateVideoForm" method="post" action="index.php">
                <input type="hidden" class="selectActionField" id="modField" name="modField" value="">
                <input type="hidden" id="idField" name="idField" placeholder="ID">
                <input type="text" id="titleField" name="titleField" placeholder="Titolo" required>
                <input type="text" id="authorField" name="authorField" placeholder="Autore" required>
                <input type="number" id="yearField" name="yearField" placeholder="Anno" min="1900" max="<?= date('Y') ?>" required>
                <input type="text" id="genreField" name="genreField" placeholder="Genere" required>
                <input type="button" class="changeFormBtn" id="changeFormBtn" name="changeFormBtn" ref="add" value="Aggiungi">
            </form>
        </div>
        <div class="clearDiv"></div>

    </div>
</body>

</html>

<script src="js/custom.js"></script>