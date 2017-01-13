<!DOCTYPE html>
<?php
			$bill_error = $percentage_error = "";

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				if (!empty($_POST["bill_total"]) && isset($_POST["percentage"])){
					$bill_total = floatval($_POST["bill_total"]);
					$selected_percentage = $_POST["percentage"];
					$percentage = floatval($_POST["percentage"])/100;
					$tip = round($bill_total * $percentage, 2);
					$total = round($bill_total + $tip, 2);
				}else {
					if(empty($_POST["bill_total"])){
						$bill_error = "Please enter bill total!";
					}
					if(!isset($_POST["percentage"])){
						$percentage_error = "Please select percentage";
					}
				}
		}
?>
<html>
	<head>
		<title>Tip Calculator</title>
		<!-- Latest compiled and minified CSS -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div style="height: 150px;"></div>
			<div class="row">
				<div class="col-lg-offset-4 col-lg-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Tip Calculator</h3>
						</div>
						<div class="panel-body">
							<?php if(!empty($bill_error) || !empty($percentage_error)) { ?>
								<div class="alert alert-danger" role="alert">
									<ul>
										<?php if(!empty($bill_error)){ ?>
										<li>
											<?php echo $bill_error; ?>
										</li>
										<?php } ?>
										<?php if(!empty($percentage_error)){ ?>
										<li>
											<?php echo $percentage_error; ?>
										</li>
										<?php } ?>
									</ul>
								</div>
							<?php } ?>
							
							<form action="index.php" method="post">
								<label>Enter bill subtotal:</label>
								<div class="input-group input-group-lg">
									<span class="input-group-addon">$</span>
									<input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="bill_total" <?php echo "value=\"$bill_total\"" ?>>
								</div>
								<br>
								<label>Tip Percentage:</label><br>
								<?php
									$percentage = array("15%", "18%", "20%");
									foreach ($percentage as $value){
										if($selected_percentage == $value){
											echo "<input type=\"radio\" name=\"percentage\" value=\"$value\" checked> $value		";
										}else{
											echo "<input type=\"radio\" name=\"percentage\" value=\"$value\"> $value		";
										}
									}
									
								?>
								<br><br>
								<input type="submit" name="submit" class="btn btn-primary">
								<br><br>
							</form>
							<div>
								<?php
									if(isset($_POST["bill_total"]) && isset($_POST["percentage"])){
									echo "<h3>Tip: \$$tip</h3>";
									echo "<h3>Total with tip: \$$total</h3>";
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		
	</body>
</html>