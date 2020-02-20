
// hypothetical input search: <input type="text" id="input-search" placeholder="Search for...">

//this script checks whether the given input exists or not in the table, by using the indexOf() method.
$(document).ready(function(){
  $("#input-search").keyup(function() {
    var input = $(this).val().toLowerCase();
    $("#my-table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(input) > -1)
    });
  });
});

//Sorts table based on: a) string, b) dates, and c) integers in either asc or desc order.
function sortTable(n) {
  	var table, rows, switching, i, x, y, shouldSwitch, direction, switchcount = 0;
  	table = document.getElementsByClassName("my-table");
  	switching = true;
  	direction = "asc"; 
  	while (switching) {
	    switching = false;
	    rows = table.rows;
	    for (i = 1; i < (rows.length - 1); i++) {
	    	shouldSwitch = false;
	    	x = rows[i].getElementsByTagName("TD")[n];
	     	y = rows[i + 1].getElementsByTagName("TD")[n];
	      	if (typeOf x === 'String' && typeOf y = 'String') {
		  		if (direction == "asc") {
	        		if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
	          			shouldSwitch = true;
	          			break;
	        		}
	    		else if (direction == "desc") {
	        		if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
	          			shouldSwitch = true;
	          			break;
	       			}
	      		}
			}  
			if (!Number.isNaN(x) && !Number.isNaN(y)) {
				if (x instanceOf Date && y instanceOf Date) {
					if (direction == "asc") {
	    				if (Number(x.innerHTML) > Number(y.innerHTML)) {
	        				shouldSwitch = true;
	       				 	break;
	    				}
					} else if (direction == "desc") {
	    				if (Number(x.innerHTML) < Number(y.innerHTML)) {
	        				shouldSwitch = true;
	        				break;
	    				}
					}
				} else {
					if (direction == "asc") {
					    if (Number(x.innerHTML) > Number(y.innerHTML)) {
					        shouldSwitch = true;
					        break;
					    }
					} else if (direction == "desc") {
					    if (Number(x.innerHTML) < Number(y.innerHTML)) {
					        shouldSwitch = true;
					        break;
					    }
					}	
				}	
			}
	    }
	    if (shouldSwitch) {
	      	rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
	      	switching = true;
	      	switchcount ++;      
	    } else if (switchcount == 0 && direction == "asc") {
	        direction = "desc";
	        switching = true;
	    }
  	}	
}

