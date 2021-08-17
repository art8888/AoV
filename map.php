<?php
include 'map_f.php';
$map = new Map;
?>
<head>
	<title>{$Title}</title>
   <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
   <script type="text/javascript" src="jquery.js"></script>
   <script type="text/javascript" src="mapgen.js"></script>
   <style type="text/css">
   	#map{
   		position:absolute;
   		top:5%;
   		left:3%;
   	}
   	.gras1{
   		background-image:url("graphics/map/gras1.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest0000{
   		background-image:url("graphics/map/forest0000.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest0001{
   		background-image:url("graphics/map/forest0001.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest0010{
   		background-image:url("graphics/map/forest0010.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest0011{
   		background-image:url("graphics/map/forest0011.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest0100{
   		background-image:url("graphics/map/forest0100.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest0101{
   		background-image:url("graphics/map/forest0101.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest0110{
   		background-image:url("graphics/map/forest0110.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest0111{
   		background-image:url("graphics/map/forest0111.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest1000{
   		background-image:url("graphics/map/forest1000.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest1001{
   		background-image:url("graphics/map/forest1001.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest1010{
   		background-image:url("graphics/map/forest1010.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest1011{
   		background-image:url("graphics/map/forest1011.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest1100{
   		background-image:url("graphics/map/forest1100.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest1101{
   		background-image:url("graphics/map/forest1101.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest1110{
   		background-image:url("graphics/map/forest1110.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
   	.forest1111{
   		background-image:url("graphics/map/forest1111.png");
   		background-repeat:no-repeat;
   		position: absolute;
   	}
      .berg1{
         background-image:url("graphics/map/berg1.png");
         background-repeat:no-repeat;
         position: absolute;
      }
      .berg2{
         background-image:url("graphics/map/berg2.png");
         background-repeat:no-repeat;
         position: absolute;
      }
      .berg3{
         background-image:url("graphics/map/berg3.png");
         background-repeat:no-repeat;
         position: absolute;
      }
      .berg4{
         background-image:url("graphics/map/berg4.png");
         background-repeat:no-repeat;
         position: absolute;
      }
      .see{
         background-image:url("graphics/map/see.png");
         background-repeat:no-repeat;
         position: absolute;
      }
   	.selected{
   		opacity:50%;
   	}
   	.tile:hover{
   		opacity:50%;
   	}
      .v1{
         background-image:url("graphics/map/v1.png");
         background-repeat:no-repeat;
         position: absolute;
      }
      .v1_left{
         background-image:url("graphics/map/v1_left.png");
         background-repeat:no-repeat;
         position: absolute;
      }
      .b1{
         background-image:url("graphics/map/b1.png");
         background-repeat:no-repeat;
         position: absolute;
      }
      .b1_left{
         background-image:url("graphics/map/b1_left.png");
         background-repeat:no-repeat;
         position: absolute;
      }
   </style>
</head>
<body>
	<form action="#" method="POST", id="prime_data">
			<label for="type_selector" id="type_selector">
				<input type="radio" id="type" name="type" value="forest">
				<label for="forest">Forest</label>
				<input type="radio" id="type" name="type" value="lake">
				<label for="lake">Lake</label>
				<input type="radio" id="type" name="type" value="mountain">
				<label for="mountain">Mountain</label>
			</label>
			<input type="button" id="cl" value="CLEAR">
			<input type="button" id="gen" value="Generate">
			<input type="button" id="edit" value="EDIT">
			
		</form>
	<div id="map">
		<?php $map->map_show(); ?>	
	</div>
</body>
</html>
