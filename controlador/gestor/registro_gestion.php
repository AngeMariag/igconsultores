<section>
	<div class="container mt-5">
		<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">

        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
            aria-controls="nav-home" aria-selected="true">REGISTRO DE GESTIONES POR DEUDOR</a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
            aria-controls="nav-profile" aria-selected="false">GESTIONES AGREGADAS</a>
        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
            aria-controls="nav-contact" aria-selected="false">RECORDATORIOS</a>
</div>
  </nav>
  <div>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      	<?php include('listgestion.php'); ?>
        <!-- {% include('gestor/listgestion.html') %} -->
      </div>
      <!-- div class="tab-pane fade " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
        {% include('gestor/gestion.html') %}
      </div>
      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
        {% include('gestor/recordatorios.html') %}
      </div> -->
    </div>
  </div>
</div>
	
</section>