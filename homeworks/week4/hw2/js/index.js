 

function validate_required(field){
  with (field){
    if (value==null||value==""){
	  return false
	} else {return true}
  }
}

function validate_form(thisform){
  with (thisform){
    if (validate_required(email)==false){
	  document.querySelector('.row.row1').style.background = '#ffebee';
	  document.querySelector('.reminder').style.display = 'block';
	  email.style.background = 'none';
	  email.style.borderBottom = '1px solid #ea3535';
	  return false
    }else  if (validate_required(name)==false){
	  document.querySelector('.row.row2').style.background = '#ffebee';
	  document.querySelector('.row2 .reminder').style.display = 'block';
	  name.style.background = 'none';
	  name.style.borderBottom = '1px solid #ea3535';
	  return false
    }else  if (!type1.checked && !type2.checked){
	  document.querySelector('.row.row3').style.background = '#ffebee';
	  document.querySelector('.row3 .reminder').style.display = 'block';
	  return false
    }else  if (validate_required(job)==false){
	  document.querySelector('.row.row4').style.background = '#ffebee';
	  document.querySelector('.row4 .reminder').style.display = 'block';
	  job.style.background = 'none';
	  job.style.borderBottom = '1px solid #ea3535';
	  return false
    } else  if (validate_required(experience)==false){
	  document.querySelector('.row.row5').style.background = '#ffebee';
	  document.querySelector('.row5 .reminder').style.display = 'block';
	  experience.style.background = 'none';
	  experience.style.borderBottom = '1px solid #ea3535';
	  return false
    }else{
      alert("Submit!")
	}
	
  } 
}  