//from w3 school
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("city"); //เรียก element จาก class ที่มี city
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none"; //เปลี่ยน display เป็น none
  }
  tablinks = document.getElementsByClassName("tablink"); //เรียก element จาก class ที่มี tabline
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-border-blue", ""); //เปลี่ยน w3-border-blue ไห้เป็น String ว่าง
  }
  document.getElementById(cityName).style.display = "block"; //เปลี่ยน display จาก none เป็น block
  evt.currentTarget.firstElementChild.className += " w3-border-blue"; //เติม w3-border-blue ลงไปใน class
}
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}