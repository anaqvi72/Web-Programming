<!DOCTYPE html>
<html>
<head>
	<script src="./jquery/jquery-3.6.0.min.js"></script>
</head>
<body>
	This is an ajax example.<p>

	<form onsubmit="return(insertPeople())">
		First Name: <input type="text" text id="firstName">
  		Last Name: <input type="text" text id="lastName">
  		Telephone: <input type="text" text id="telephone">
		<input type="submit" value=submit>
		
	</form>

	<div id=showPeople></div>
	<script>
			function insertPeople() {
				fName = $("#firstName").val();
				lName = $("#lastName").val();
				tphone= $("#telephone").val();
				
				$.get("./week8ajax.php",{"cmd":"create","firstName":fName,"lastName": lName,"telephone":tphone},
					function(data) {
						$("#showPeople").html(data);
				});
				return(false);
			}

			function DeletePeople(val) {


				$.get("./week8ajax.php",{"cmd":"delete","id":val},
					function(data) {
						$("#showPeople").html(data);
				});

				return(false);
			}

		function showPeople() {
			$.get("./week8ajax.php",{"cmd":""},
				function(data) {
				$("#showPeople").html(data);
			});
			return(false);
		}
		
		showPeople();

	</script>

</body>
</html>