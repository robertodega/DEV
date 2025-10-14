<?php
/* Smarty version 4.5.5, created on 2025-06-10 15:03:18
  from '/opt/lampp/htdocs/WWW/PROJECTS/PHP/Smarty/rubricaSmarty/templates/home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.5',
  'unifunc' => 'content_68482d16b4ef22_55510121',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7184c376ef4a82843d492807a995e98f2213ad77' => 
    array (
      0 => '/opt/lampp/htdocs/WWW/PROJECTS/PHP/Smarty/rubricaSmarty/templates/home.tpl',
      1 => 1749560597,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68482d16b4ef22_55510121 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="it">
<head>
    <title>Rubrica Smarty</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"><?php echo '</script'; ?>
>

    <link rel="icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['imgPath']->value;?>
favicon.ico" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['cssPath']->value;?>
custom.css">
</head>

<body>
    <div class="headerDiv"><a href='<?php echo $_smarty_tpl->tpl_vars['rootPath']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['appTitle']->value;?>
</a></div>
    <div class="boxDiv" id="searchDiv">
        
        <form id="searchForm" method="post" action="./">
            <input type="hidden" name="action" value="search">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="searchText" placeholder="Search for a contact..." aria-label="Search for a contact...">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </div>
        </form>
        <div class="text-center">
            <a href="./?action=add" class="btn btn-primary">Add a contact</a>
            <a href="./?action=showAll" class="btn btn-primary">Show all contacts</a>
        </div>

        <div class="boxDiv" id="resultsDiv">
            <?php echo $_smarty_tpl->tpl_vars['resultTable']->value;?>

        </div>

    </div>
</body>

</html>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['jsPath']->value;?>
custom.js"><?php echo '</script'; ?>
>
<?php }
}
