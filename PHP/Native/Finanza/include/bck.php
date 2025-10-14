<div class='bckCsontentContainer'>
    <table class='table table-striped table-bordered'>
        <tbody>
            <?php foreach($bckContent as $backupFile): ?>
                <tr class='bckTr'>
                    <td class='bckTd'>
                        <div class='bckTdSection bkpTdAction' ref='<?=$backupFile?>'><?=$backupFile?></div>
                        <div class='bckTdSection bkpTdAction' act='reload' ref='<?=$backupFile?>'>Reload</div>
                        <?php if($backupFile != 'db_init.sql'){ ?><div class='bckTdSection bkpTdAction' act='del' ref='<?=$backupFile?>'>Delete</div><?php } ?>
                        <div class="clearDiv"></div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
