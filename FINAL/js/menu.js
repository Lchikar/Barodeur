function Afficher()	{
	
	show = document.getElementById('hidden');
	hide1 = document.getElementById('menu');
	hide2 = document.getElementById('affiche_bar');
 	
	show.style.display = 'block';
    hide1.style.display = 'none';
    hide2.style.display = 'none';
		
}

function Cacher()	{
	
	hide = document.getElementById('hidden');
	show1 = document.getElementById('menu');
	show2 = document.getElementById('affiche_bar');
 	
    hide.style.display = 'none';
    show1.style.display = 'flex';
    show2.style.display = 'flex';
		
}

function Cacher2()	{
	
	hide = document.getElementById('hidden');
	show1 = document.getElementById('menu');
	show2 = document.getElementById('affiche_bar');
 	
    hide.style.display = 'none';
    show1.style.display = 'flex';
    show2.style.display = 'block';
		
}