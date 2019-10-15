var main = (()=>{

	let $bt2 = document.getElementById('palabra');
	let $entrada2 = document.getElementById('entrada2');
	let $entrada3 = document.getElementById('entrada3');

alert(" funciona!!");

	$bt2.addEventListener("click",()=>{
		let band = false;
		for (let index = 0; index < $entrada3.value.length; index++) { 
			if($entrada3.value[index] == $entrada2.value){
				console.log($entrada2.value + " pertenece a la frase "+ $entrada3.value);
				alert($entrada2.value + " pertenece a la frase "+ $entrada3.value);
				band = true;
				index = $entrada3.value.length;
			}
		}
		if(!band){
    		console.log($entrada2.value + " NO pertenece a la frase "+ $entrada3.value);
			alert($entrada2.value + " NO pertenece a la frase "+ $entrada3.value);
    	}
	});

})();