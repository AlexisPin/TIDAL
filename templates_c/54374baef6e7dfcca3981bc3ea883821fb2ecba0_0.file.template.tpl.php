<?php
/* Smarty version 4.0.4, created on 2022-02-03 19:45:31
  from 'A:\CPE Lyon\4ETI\TIDAL\template\template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.4',
  'unifunc' => 'content_61fc30db8ab8a9_00852995',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54374baef6e7dfcca3981bc3ea883821fb2ecba0' => 
    array (
      0 => 'A:\\CPE Lyon\\4ETI\\TIDAL\\template\\template.tpl',
      1 => 1643916538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61fc30db8ab8a9_00852995 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Document</title>
</head>
<body>

<nav>
    <label class="logo">TIDAL</label>
    <ul>
      <li><a class="active" href="index.php">Acceuil</a></li>
      <li><a href=<?php echo $_smarty_tpl->tpl_vars['SearchPage']->value;?>
>Recherche avancée</a></li>
      <li><a href=<?php echo $_smarty_tpl->tpl_vars['ConnectionPage']->value;?>
>Connexion</a></li>
      <li><a href=<?php echo $_smarty_tpl->tpl_vars['BiblioPage']->value;?>
>Bibliographie</a></li>
    </ul>
</nav>


  <div class="sidebar">
    <header>Filtres</header>
    <div class="meridien">
      <h3>Meridien</h3>
      <li><a href="#">+ Poumon</a></li>
      <li><a href="#">+ Ren Mai</a></li>
      <li><a href="#">+ Rein</a></li>
    </div>
    <div class="type">
    <h3>Type</h3>
      <li><a href="#">+ Méridien</a></li>
      <li><a href="#">+ Organe</a></li>
      <li><a href="#">+ Luo</a></li>
    </div>
    <div class="caracteristique">
      <h3>Caracteristique </h3>
      <li><a href="#">+ Pleins</a></li>
      <li><a href="#">+ Chaud</a></li>
      <li><a href="#">+ Vide</a></li>
    </div>
  </div>

<div class="result">
 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pathos']->value, 'patho');
$_smarty_tpl->tpl_vars['patho']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['patho']->value) {
$_smarty_tpl->tpl_vars['patho']->do_else = false;
?>
    <a href="#">
      <div class="patho">
        <h4><?php echo $_smarty_tpl->tpl_vars['patho']->value['nom'];?>
</h4>
        <h5><?php echo $_smarty_tpl->tpl_vars['patho']->value['meridien'];?>
</h5>
        <p><?php echo $_smarty_tpl->tpl_vars['patho']->value['description'];?>
</p>
      </div>
    </a>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
  <div class="result">
    <a href="#">
    <div class="patho">
      <h4>Nom_Patho</h4>
      <h5>meridien</h5>
      <p>Description</p>
    </div>
    </a>
    <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a>
    <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a> <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a> <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a> <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a> <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a> <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a> <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a> <a href="#">
    <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a> <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a> <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a> <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
    </a> <a href="#">
      <div class="patho">
        <h4>Nom_Patho</h4>
        <h5>meridien</h5>
        <p>Description</p>
      </div>
  </div>
</body>
</html> 
<?php }
}
