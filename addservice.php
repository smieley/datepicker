<?php session_start(); 
if(!isset ($_SESSION['idRegistro']) == true) {
unset($_SESSION['idRegistro']);
header('location:index.php');
} include("conexao.php");
?>
<!DOCTYPE html>
	<head>
		<!--Import Google Icon Font-->
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	    <!--Import materialize.css-->
	    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
		<meta http-equiv="Content-Type" content="text/xhtml; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>LabFácil</title>
	</head>
	<body>
		<div  class="row container ">
		   <nav class="nav-extended ">
			    <div class="nav-content ">
		      		<ul class="tabs tabs-transparent teal lighten-1">
				        <li class="tab"><a href="logout.php" class="waves-effect waves-light ">Sair</a></li>
				        <li class="tab"><a href="page.php" class="waves-effect waves-light">Ordem</a></li>
				        <li class="tab"><a href="dentista.php" class="waves-effect waves-light">Dentistas</a></li>
				        <li class="tab"><a href="trabalho.php" class="waves-effect waves-light">Serviços</a></li>
				        <li class="tab"><a href="addservice.php" class="waves-effect waves-light">Add Serviços</a></li>
				    </ul>
		    	</div>
		 	</nav>
		 	<div class="input-field col s12">
				<h5>Adcione um serviço</h5>
			</div>	
			<form method="post" enctype="multipart/form-data">
				<div class="input-field col s3">
		            <input id="ordem" type="text" name="ordem" class="validate" autocomplete="" >
		            <label class="active cyan-text text-lighten-4" for="ordem">ordem</label>            
	          	</div>
	  			<div class="input-field col s9">
		            <input id="paciente" type="text"  name="paciente" class="validate" autocomplete="" >
		            <label class="active cyan-text text-lighten-4" for="paciente">paciente(obrigatório)</label>            
	          	</div>
	          	<div class="input-field col s5">					
		  			<select class="browser-default" id="dentista" name="dentistas">
		  				<option value="" disabled selected>Dentistas</option>
						<?php					
							$sqll = "SELECT * FROM dentistas
								WHERE dentistas_registro = ".$_SESSION['idRegistro']."";
							$resultt = $conn->query($sqll);
							while ($roww = $resultt->fetch_assoc()){
						    	echo "<option value='".$roww["nomeDentistas"]."'>".$roww["nomeDentistas"]."</option>";
						 	}
						?>
		  			</select>
	  			</div>
	  			<div class="input-field col s7">
		  			<select class="browser-default" id="tipoServico" name="trabalhos">
		  				<option value="" disabled selected>Trabalhos</option>
						<?php					
							$sqli = "SELECT * FROM trabalhos
								WHERE trabalhos_registro = ".$_SESSION['idRegistro']."";
							$resulti = $conn->query($sqli);
							while ($rowi = $resulti->fetch_assoc()){
						echo "<option id='".$rowi["preco"]."' value='".$rowi["tipoTrabalhos"]."'>".$rowi["tipoTrabalhos"]."</option>";
						 	}
						?>
		  			</select>
	  			</div>
	  			<div class="input-field col s6">
		            <input id="datae" type="date"  name="datae" class="validate" autocomplete="" >
		            <label class="active cyan-text text-lighten-4" for="datae">data entrada</label>            
	          	</div>  			
	  			<div class="input-field col s6">
		            <input id="datas" type="date"  name="datas" class="validate" autocomplete="" >
		            <label class="active cyan-text text-lighten-4" for="datas">data saída</label>            
	          	</div>
	          	<div class="input-field col s12">
	          		<textarea id="observacao" name="observacao" class="materialize-textarea"></textarea>
		            <label class="active cyan-text text-lighten-4" for="observacao">observação</label>            
	          	</div>




	          	<div class="input-field col s12">
	          		 <input type="text" class="datepicker" placeholder="data">
	          	<div class="input-field col s4">
		          	<legend>Antagonista</legend>	          	
		          	<p>
		          		<label>
		          			<input type="radio" id="ant" name="ant" value="1" checked />
		          			<span style="color: white">Sim</span>
		          		</label></br>
		          		<label>
		          			<input type="radio" id="ant" name="ant" value="2" />
		          			<span style="color: white">Não</span>
		          		</label></br>
		          		<label>
		          			<input type="radio" id="ant" name="ant" value="3" />
		          			<span style="color: white">Indefinido</span>
		          		</label>
		          	</p>
	         	 </div>
	         	 <div class="input-field col s3">
		            <input id="cor" type="text"  name="cor" class="validate" autocomplete="" >
		            <label class="active cyan-text text-lighten-4" for="cor">cor</label>            
	          	</div>
	          	<div class="input-field col s3">
		            <input id="recebeValor" type="number"  name="valor" value="" class="validate" placeholder="valor" autocomplete="" >
		                       
	          	</div>
				<div class="input-field col s3">				
					<a class="waves-effect waves-light btn-small" onclick="serviceAction()">Salvar</a>
				</div>
			</form>
		</div>
			<script type="text/javascript">
	      		/*$(document).ready(function(){
    				$ ('. datepicker'). datepicker ({ 
						
						i18n: {
						months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
						monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
						weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
						weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
						weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
						today: 'Hoje',
						clear: 'Limpar',
						cancel: 'Sair',
						done: 'Confirmar',
						labelMonthNext: 'Próximo mês',
						labelMonthPrev: 'Mês anterior',
						labelMonthSelect: 'Selecione um mês',
						labelYearSelect: 'Selecione um ano',
						selectMonths: true,
						selectYears: 15,
						},
						format: 'dd mmmm, yyyy',
						container: '.container',
						minDate: new Date(),
						}); 

  				

	      		$('.datepicker').datepicker('methodName');
    $('.datepicker').datepicker('methodName', paramName);
    instance.open();
    instance.close();
    instance.toString();
    instance.setDate(new Date());
    instance.gotoDate(new Date());
    instance.destroy();
});/*
	      	</script>
			<script type="text/javascript" src="js/materialize.min.js"></script>
	     	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	      	<script type="text/javascript" src="js/open_cad.js"></script>
	      	


	      	<script type="text/javascript">      		
	      		$('#tipoServico').change(function(){
	      			$('#recebeValor').val($('#tipoServico option:selected').attr('id'));  		 
	      		}); 

	      		function serviceAction() {
	      		var queryString;	
				var ordem = $("#ordem").val();
				var paciente = $("#paciente").val();
				var dentista = $('#dentista option:selected').val();
				var datae = $("#datae").val();
				var tipoServico = $('#tipoServico option:selected').val();
				var datas = $("#datas").val();
				var cor = $("#cor").val();
				var observacao = $("#observacao").val();
				var ant = $($('input:radio[name=ant]:checked')).val();
				var recebeValor = $("#recebeValor").val();
				if($('#paciente').val()=='') {
					alert('Nome do paciente é necessário');
					return false;			
				}else{
					queryString ='ordem='+ordem+'&paciente='+paciente+'&dentista='+dentista+
					'&datae='+datae+'&tipoServico='+tipoServico+'&datas='+datas+'&cor='+cor+
					'&observacao='+observacao+'&ant='+ant+'&recebeValor='+recebeValor;
				}	
					jQuery.ajax({
					url: "insertService.php",
					data:queryString,
					type: "POST",
					success:function(data){
						alert(data);
					},	
					error:function (){}
					});
				}
	      	</script>
	</body>
</html>