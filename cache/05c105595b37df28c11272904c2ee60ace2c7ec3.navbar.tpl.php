<?php
/* Smarty version 4.0.4, created on 2022-02-17 17:55:42
  from 'A:\CPE Lyon\4ETI\TIDAL\template\navbar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.4',
  'unifunc' => 'content_620e8c1ee401d2_39167702',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fd72c818a3dc2b8134478dbe4b8f97627cac2ce0' => 
    array (
      0 => 'A:\\CPE Lyon\\4ETI\\TIDAL\\template\\navbar.tpl',
      1 => 1645119145,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 3600,
),true)) {
function content_620e8c1ee401d2_39167702 (Smarty_Internal_Template $_smarty_tpl) {
?><nav>
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">TIDAL</label>
    <ul>
        <li><a href="?filter" class=<?php echo '<?php'; ?>
 if ($uri == '/?filter' || $uri == '/') {
                                        echo "active";
                                    } <?php echo '?>'; ?>
> Accueil</a></li>
                <li><a href="?login" class=<?php echo '<?php'; ?>
 if ($uri == '/?login') {
                                        echo "active";
                                    } <?php echo '?>'; ?>
>Connexion</a></li>
                <li><a href="?bibliographie" class=<?php echo '<?php'; ?>
 if ($uri == '/?bibliographie') {
                                                echo "active";
                                            } <?php echo '?>'; ?>
>Bibliographie</a></li>
    </ul>
</nav><?php }
}
