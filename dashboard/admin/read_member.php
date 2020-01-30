		

<?php
require '../../include/db_conn.php';
page_protect();
?>


<!DOCTYPE html>
<html lang="es">
<head>

    <title>ConfiguroWeb | Historial de Miembro</title>
   	<link rel="stylesheet" href="../../css/style.css"  id="style-resource-5">
    <script type="text/javascript" src="../../js/Script.js"></script>
    <link rel="stylesheet" href="../../css/dashMain.css">
    <link rel="stylesheet" type="text/css" href="../../css/entypo.css">
<link href="a1style.css" rel="stylesheet" type="text/css">     
    <style>
    	.page-container .sidebar-menu #main-menu li#hassubopen > a {
    	background-color: #2b303a;
    	color: #ffffff;
		}

    </style>


</head>
   <body class="page-body  page-fade" onload="collapseSidebar()">

    	<div class="page-container sidebar-collapsed" id="navbarcollapse">	
	
		<div class="sidebar-menu">
	
			<header class="logo-env">
			
			<!-- logo -->
			<div class="logo">
				<a href="main.php">
					<img src="../../images/logo.png" alt="" width="192" height="80" />
				</a>
			</div>
			
					<!-- logo collapse icon -->
					<div class="sidebar-collapse" onclick="collapseSidebar()">
				<a href="#" class="sidebar-collapse-icon with-animation"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
			</div>
							
			
		
			</header>
    		<?php include('nav.php'); ?>
    	</div>


    		<div class="main-content">
		
				<div class="row">
					
					<!-- Profile Info and Notifications -->
					<div class="col-md-6 col-sm-8 clearfix">	
							
					</div>
					
					
					<!-- Raw Links -->
					<div class="col-md-6 col-sm-4 clearfix hidden-xs">
						
						<ul class="list-inline links-list pull-right">

							<li>Bienvenido <?php echo $_SESSION['full_name']; ?> 
							</li>							
						
							<li>
								<a href="logout.php">
									Cerrar Sesión <i class="entypo-logout right"></i>
								</a>
							</li>
						</ul>
						
					</div>
					
				</div>

		<h3>Historial de Miembro</h3>

			Details of : - <?php
			$id     = $_POST['name'];
			$query  = "select * from users WHERE userid='$id'";
			//echo $query;
			$result = mysqli_query($con, $query);

			if (mysqli_affected_rows($con) != 0) {
			    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			        $name = $row['username'];
			        $memid=$row['userid'];
			        $gender=$row['gender'];
			        $mobile=$row['mobile'];
			        $email=$row['email'];
			        $joinon=$row['joining_date'];
			        echo $name;
			    }
			}
			?>

		<hr />


		
		<table border=1>
			<thead>
				<tr>
					<th>ID Membresía</th>
					<th>Nombre</th>
					<th>Género</th>
				    <th>Móvil</th>
				    <th>Correo</th>
					<th>Ingresó en</th>
				</tr>
			</thead>
				<tbody>
					<?php
					
					        
					     echo "<tr><td>" . $memid . "</td>";
					     
					     echo "<td>" . $name . "</td>";
			     	     
			     	     echo "<td>" . $gender . "</td>";
			
		      	         echo "<td>" . $mobile . "</td>";

		      	         echo "<td>" . $email . "</td>";

					     echo "<td>" . $joinon . "</td></tr>";
					    
					?>								
				</tbody>
		</table>
				<br>
				<br>

				<h3>Historial de Pago de: <?php echo $name;?></h3>

		<table border=1>
			<thead>
				<tr>
					<th>Sl.No</th>
					<th>Nombre de Plan</th>
					<th>Descuento de Plan</th>
					<th>Validez</th>
					<th>Monto</th>
					<th>Fecha de Pago</th>
					<th>Fecha de Expiración</th>
					<th>Acción</th>
				</tr>
			</thead>
				<tbody>
					<?php
						
						$query1  = "select * from enrolls_to WHERE uid='$memid'";
						//echo $query;
						$result = mysqli_query($con, $query1);
						$sno    = 1;

						if (mysqli_affected_rows($con) != 0) {
						    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						      $pid=$row['pid'];
						      $query2="select * from plan where pid='$pid'";
						      $result2=mysqli_query($con,$query2);
						      if($result2){
						      	$row1=mysqli_fetch_array($result2,MYSQLI_ASSOC);

						        echo "<td>" . $sno . "</td>";

						        echo "<td>" . $row1['planName'] . "</td>";

						        echo "<td width='380'>" . $row1['description'] . "</td>";

						        echo "<td>" . $row1['validity'] . "</td>";

						        echo "<td>" . $row1['amount'] . "</td>";

						        echo "<td>" . $row['paid_date'] . "</td>";

						        echo "<td>" . $row['expire'] . "</td>";
						        
						        $sno++;
						    }
						        
						        echo '<td><a href="gen_invoice.php?id='.$row['uid'].'&pid='.$row['pid'].'&etid='.$row['et_id'].'"><input type="button" class="a1-btn a1-blue" value="Memo" ></a></td></tr>';
						        $memid = 0;
						    }
						    
						}

					?>							
				</tbody>
		</table>


			<?php include('footer.php'); ?>
    	</div>
    </body>
</html>

