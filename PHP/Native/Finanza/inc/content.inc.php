<?php
include __DIR__ . "/update-op.inc.php";
$verticalMonthsPages = ["contocorrente", "stipendio", "mutuo"];
$gtype = (($_GET["gtype"]) && (in_array($_GET["gtype"], ["Pie", "Bar", "Area"]))) ? $_GET["gtype"] : $graphType[$p];
$graphMonth = $_GET['month'] ?? date('m');
?>
<div class="mainContentDiv" id="mainContentDiv">
    <table class='table table-striped table-bordered'>
        <?php
        #   Lista backup files
        if (in_array($p, ["backup"])) {
            $c = $_GET['c'] ?? '';
            $bckContent = $manager->scanContentDir(DB_PATH);
            if ($c) {
                $manager->backupDb();
                header('Location:backup');
            }
        ?>
            <tr>
                <td class='tdbckname'>
                    <a href="backupDb" title="Backup">&#128189;</a>
                </td>
            </tr>
            <?php
            foreach ($bckContent as $bck) {
            ?>
                <tr>
                    <td class='tdbckname'><a href='<?= DB_PATH . $bck ?>' target="_blank"><?= $bck ?></a></td>
                    <td class='tdbckdel'><?php if ($bck !== 'db_init.sql'): ?><a href="javascript:deleteBck('<?= $bck ?>')" title="Delete">&#128465;</a><?php endif; ?></td>
                </tr>
            <?php } ?>
        <?php
        }
        #   Fine lista backup files
        else {
        ?>
            <thead>
                <th></th>
                <?php
                #   Intestazione orizzontale tabella
                if (in_array($tablesList[$p], $verticalMonthsPages)) {
                    foreach ($allowedTags[$p] as $tt) {
                ?>
                        <th class="thtitle"><?= ucfirst(str_replace("_", " ", $tt)) ?></th>
                    <?php
                    }
                } else {
                    foreach ($months as $k => $v) {
                    ?><th class="thtitle"><?= $k ?></th><?php
                                                    }
                                                }
                                                #   fine intestazione orizzontale tabella
                                                        ?>
            </thead>

            <?php
            #   Intestazione verticale tabella
            if (in_array($tablesList[$p], $verticalMonthsPages)) {
                $dataSetVertical = [];
                foreach ($dataContent[$p] as $record) {
                    foreach ($allowedTags[$p] as $key) {
                        $dataSetVertical[$record["ref_year"]][$record["ref_month"]][$key] = $record[$key];
                    }

                    // Stipendio section
                    if ($p === "stipendio") {
                        if (!empty($record['lordo'])) {
                            $dataSetVertical[$record["ref_year"]][$record["ref_month"]]["taxes_perc"] = round((($record['lordo'] - $record['netto']) / $record['lordo'] * 100), 2) . " %";
                            $dataSetVertical[$record["ref_year"]][$record["ref_month"]]["taxes"] = round($record['lordo'] - $record['netto'], 2);
                        }
                        $dataSetVertical[$record["ref_year"]][$record["ref_month"]]["tot_income"] = round(($record['ticket_n'] * $record['ticket_value']) + $record['netto'], 2);
                    }
                }

                // Totali section
                if ($p === "totali") {

                    $stipendio_list = [];

                    foreach ($months as $k => $v) {
                        $dataSetVertical[$refYear][$v]["spese_fisse"] = 0;
                        $dataSetVertical[$refYear][$v]["spese_extra"] = 0;
                        $dataSetVertical[$refYear][$v]["spese_totali"] = 0;
                    }
                    foreach ($months as $k => $v) {
                        foreach ($dataContent["overview"] as $record) {
                            if ($record["ref_year"] == $refYear && $record["ref_month"] == $v) {
                                $dataSetVertical[$refYear][$v]["spese_fisse"] += $record["amount"];
                            }
                        }
                        foreach ($dataContent["bollette"] as $bill) {
                            if ($bill["ref_year"] == $refYear && $bill["ref_month"] == $v) {
                                $dataSetVertical[$refYear][$v]["spese_fisse"] += $bill["amount"];
                            }
                        }
                        foreach ($dataContent["mutuo"] as $loan) {
                            if ($loan["ref_year"] == $refYear && $loan["ref_month"] == $v) {
                                $dataSetVertical[$refYear][$v]["spese_fisse"] += $loan["amount"];
                            }
                        }

                        if($v == 1){
                            $prevYear = $refYear - 1;
                            $prevMonth = 12;
                        } else {
                            $prevYear = $refYear;
                            $prevMonth = $v - 1;
                        }

                        foreach ($dataContent["stipendio"] as $record) {
                            if ($record["ref_year"] == $refYear && $record["ref_month"] == $v) {
                                $stipendio_list[$refYear][$v] = $record['netto'];
                            }
                        }
                        
                        $saldo_mese_precedente = $dataSetVertical[$prevYear][$prevMonth]["saldo"] ?? 0;
                        $saldo_mese_attuale = $dataSetVertical[$refYear][$v]["saldo"] ?? 0;
                        $stipendio_mese_attuale = $stipendio_list[$refYear][$v] ?? 0;
                        
                        $dataSetVertical[$refYear][$v]["spese_totali"] = $saldo_mese_precedente - $saldo_mese_attuale + $stipendio_mese_attuale;
                        $dataSetVertical[$refYear][$v]["spese_extra"] = $dataSetVertical[$refYear][$v]["spese_totali"]- $dataSetVertical[$refYear][$v]["spese_fisse"];
                    }
                }

                foreach ($months as $k => $v) {
                    $evidenceSelectedMonth = ((!empty($m)) && ($m == $v)) ? "evidenceSelectedMonth" : "";
                    $docLink = in_array($p, ["stipendio", "mutuo"]) ? true : false;
                    $docFolder = ($p === "stipendio") ? INCOME_DOCS_PATH : MUTUO_DOCS_PATH;
            ?>
                    <tr class="trRow">
                        <td>
                            <?php if ($docLink): ?>
                                <span class="docViewerSpan <?= $evidenceSelectedMonth ?>" id="docViewerSpan" pageRef="<?= $p ?>" docFolder="<?= $docFolder ?>" refYear="<?= $refYear ?>" refMonth="<?= $v ?>"><?= $k ?></span>
                            <?php else: ?>
                                <span class="monthSpan <?= $evidenceSelectedMonth ?>" refMonth="<?= $v ?>"><?= $k ?></span>
                            <?php endif; ?>
                        </td>

                        <!-- Fine intestazione verticale tabella -->

                        <?php

                        foreach ($allowedTags[$p] as $tt) {
                            $editableField = (in_array($tt, $editableTags[$p])) ? "editableField" : "notAllowedField";
                            $cellValue = ($dataSetVertical[$refYear][$v][$tt]) ? $dataSetVertical[$refYear][$v][$tt] : "";
                            if(($tt == "spese_extra") && (isset($dataSetVertical[$refYear][$v]["spese_extra"])) && (isset($dataSetVertical[$refYear][$v]["spese_fisse"])) && ($dataSetVertical[$refYear][$v]["spese_extra"] > $dataSetVertical[$refYear][$v]["spese_fisse"])){
                                $tt .= "_red";
                            }
                        ?>
                            <td class='valueCell td<?= $tt ?> <?= $editableField ?> <?= $evidenceSelectedMonth ?>' id='<?= $refYear ?>_<?= $v ?>_<?= $tt ?>_update' year='<?= $refYear ?>' month='<?= $v ?>' table='<?= $tablesList[$p] ?>' column='<?= $tt ?>'><?= $cellValue ?></td>
                        <?php
                        }
                    }
                } else {
                    $dataSet = [];

                    foreach ($dataContent[$p] as $record) {
                        $dataSet[$record["ref_year"]][$record["ref_month"]][$record["name"]] = $record["amount"];
                    }

                    if ($p === "overview") {
                        $dataBills = $dataContent["bollette"];
                        foreach ($dataBills as $bill) {
                            $dataSet[$bill["ref_year"]][$bill["ref_month"]]["Bollette"] = 0;
                        }
                        foreach ($dataBills as $bill) {
                            $dataSet[$bill["ref_year"]][$bill["ref_month"]]["Bollette"] += $bill["amount"];
                        }

                        $dataLoan = $dataContent["mutuo"];
                        foreach ($dataLoan as $loan) {
                            $dataSet[$loan["ref_year"]][$loan["ref_month"]]["Mutuo"] = 0;
                        }
                        foreach ($dataLoan as $loan) {
                            $dataSet[$loan["ref_year"]][$loan["ref_month"]]["Mutuo"] += $loan["amount"];
                        }
                    }

                    foreach ($allowedTags[$p] as $key) {
                        $editableField = (in_array($key, $editableTags[$p])) ? "editableField" : "notAllowedField";
                        ?>
                    <tr class="trRow">
                        <td class="valueCell valueCellTitle" id="<?= $key ?>_titleCell"><?= ucfirst(str_replace("_", " ", $key)) ?></td>
                        <?php
                        foreach ($months as $k => $v) {
                            $cellValue = ($dataSet[$refYear][$v][ucfirst($key)]) ? $dataSet[$refYear][$v][ucfirst($key)] : "";
                            $evidenceSelectedMonth = ((!empty($m)) && ($m == $v)) ? "evidenceSelectedMonth" : "";
                        ?>
                            <td class='valueCell td<?= ucfirst($key) ?> <?= $editableField ?> <?= $evidenceSelectedMonth ?>' id='<?= $refYear ?>_<?= $v ?>_<?= $key ?>_amount' year='<?= $refYear ?>' month='<?= $v ?>' table='<?= $tablesList[$p] ?>' column='<?= ucfirst($key) ?>'><?= $cellValue ?></td>
                        <?php
                        }
                        ?>
                    </tr>
        <?php
                    }
                }
            }
        ?>

    </table>
</div>
<?php include __DIR__ . "/update-form.inc.php"; ?>
<?php include __DIR__ . "/doc-viewer-form.inc.php"; ?>