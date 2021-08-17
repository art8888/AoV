$(document).ready(function(){
	
	$("#cl").click(function(e){
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: 'map_f.php',
			data:{action:'cl'},
			success:function(data){
				alert("MAP CLEARED");
			}
		});
	});

	$("#gen").click(function(e){
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: 'map_f.php',
			data:{action:'gen'},
			success:function(data){alert("MAP GENERATED!");}
		});
	});

	let ids = [];
	$(".tile").click(function(e){
		e.preventDefault();
		
		$("#"+this.id+"").toggleClass("selected");

		if($("#"+this.id+"").hasClass("selected")){
			ids.push(this.id);
		} else {
			ids.splice(ids.indexOf(this.id), 1);
		}
	});
    
	$("#edit").click(function(e){
		e.preventDefault();

		var i;
		var grid = ids[0];

		for(i = 1; i<ids.length; i++){
			grid += "-"+ids[i]+"";
		}
		$.ajax({
			type:'POST',
			url: 'map_f.php',
			data:{action:'edit',grid:grid, type:$("input[name='type']:checked").val()},
			success:function(data){alert("MAP EDITED!");}
		});
	});
});