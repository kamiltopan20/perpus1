///////////////////////////////
/*
Programer : Agus Sumarna
Describe  : File Ajax untuk halaman USER
*/
//////////////////////////////

var xmlhttp = false;

try {
	xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}

if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
	xmlhttp = new XMLHttpRequest();
}


//untuk tampil
function tampilpeminjaman(no_peminjaman){
	var obj=document.getElementById("pencarianpeminjaman");
	var url='modul/pencarian/prosespeminjaman.php?no_peminjaman='+no_peminjaman;
	
	xmlhttp.open("GET", url);
	
	xmlhttp.onreadystatechange = function() {
		if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
			obj.innerHTML = xmlhttp.responseText;
		} else {
			obj.innerHTML = "<div align ='center'>Tunggu...</div>";
		}
	}
	xmlhttp.send(null);
}
