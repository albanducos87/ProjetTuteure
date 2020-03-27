$(document).ready(function() {
let selectAll = document.querySelector('#selectAll');
selectAll.addEventListener('click',function (){
	let cases = document.getElementsByTagName('input');   // on recupere tous les INPUT
	   for(let i=0; i<cases.length; i++)     // on les parcourt
	      if(cases[i].type == 'checkbox')     // si on a une checkbox...
			  if(cases[i].checked == true){
			  	cases[i].checked = false;
			  }
	   		else {
	   			cases[i].checked = true;
			  }// ... on la coche ou non
	});
let valider = document.querySelector('#valider');
valider.addEventListener('click',function(){
	let cases = document.querySelectorAll('input');
	let casesValides = new Array();
		for (let i=0;i<cases.length;i++){
			if(cases[i].type == 'checkbox'){
				if(cases[i].checked == true){
					casesValides.push(cases[i].name);
						}
					}
				}
		let href = "";
		let i = 0;
		while (i< casesValides.length) {
			href = href + "&" + "idStage" + String(i) + "=" + String(casesValides[i]);
			i = i+1;
		}
		href = href + "&nbStage=" + i;
		valider.href = "index.php?page=29" + href;
	});
});