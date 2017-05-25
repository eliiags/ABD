$(document).ready(function() {
    
   
		// Get the modal
		var modal = document.getElementById('id01');

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}
		
		$("#nuevo").click(function(){
			document.getElementById('id01').style.display = "block";
		});
		
		$("#cerrar").click(function(){
			document.getElementById('id01').style.display = "none";
		});
		
		
		
		
		
});