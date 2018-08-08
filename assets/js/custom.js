function getImage(id){
			if(document.getElementById(id).checked){ 
			var val= document.getElementById(id).value;
			// alert(val);
			document.getElementById("imgs").innerHTML+="<input type='hidden' name='selectedImgs[]' value='"+val+"' >";
			// disable the checkbox
			document.getElementById(id).disabled=true;
			}// end if
			
		}