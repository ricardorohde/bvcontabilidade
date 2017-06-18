<h1><?php echo $titulo;?></h1>

   
    <script type="text/javascript">
		$(function() { 
				
				$("#formcontato").validate();
				
				$("#telefone").setMask("(99) 999999999");
				
				$('#map_canvas').gmap({
					'center': '-1.427715,-48.459313', 
					'zoom': 15, 
					'disableDefaultUI':false,
					'control': google.maps.ControlPosition.LEFT_TOP, 
					'callback': function() {
						var self = this;
						self.addMarker({'position': this.get('map').getCenter() }).click(function() {
							self.openInfoWindow({ 'content': '<div style="width: 190px;">Travessa Piraj&aacute;, 1298 - sala 02<br />Marco - Bel&eacute;m, PA<br />CEP 66095-631</div>'}, this);
						});	
				}});
			});
</script>

<form action="paginas/envia.php?op=contato" method="post" style="width: 360px; float: left;" id="formcontato">
<input type="text" name="nome" class="inputbox required" placeholder="Nome:" style="width:350px;" /><br />
<input type="text" name="email" class="inputbox required email" placeholder="E-mail:" style="width:350px;" /><br />
<input type="text" name="telefone" class="inputbox" id="telefone" placeholder="Telefone:" style="width:350px;" /><br />
<input type="text" name="assunto" class="inputbox required" placeholder="Assunto:" style="width:350px;" /><br />
<textarea name="mensagem" class="inputbox required" placeholder="Mensagem:" style="width: 350px; height: 150px;"></textarea><br />
<input type="submit" class="button" value="Enviar" />
</form>

<div style="float: left; width: 300px; margin-left: 50px;">
	<h3 style="margin-top: 0; padding-top: 0;">Telefone: (91) 3228.0364 / 3352.0200</h3>
	<div id="map_canvas" style="height: 272px; width: 300px; background: #EEE;"></div>

</div>

<br style="clear: both;" />