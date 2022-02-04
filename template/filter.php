<?php
   $sql = "SELECT * FROM public.patho;";
   $pathos = $conn->prepare($sql);
   $pathos->execute();
?>

  <div class="sidebar">
    <h1>Filtres</h1>
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
  <?php foreach($pathos as $patho): ?>
    <a href="#">
       <div class="patho">
         <h4><?= $patho['desc'];?></h4>
         <p><?= $patho['idp'];?></p>
         <p><?= $patho['mer'];?></p>
       </div>
     </a>
    <?php endforeach; ?>
</div>

