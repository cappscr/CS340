//the following arrays are the name of attributes for the entity
var videogame = ["Name", "Release Date", "Platforms", "Characters", "Genre", "Developer"];
var platform = ["Name", "Manufacturer", "Release Date"];
var developer = ["Name", "Games"];
var artist = ["Name", "Games", "Developer"];
var composer = ["Name", "Games", "Developer"];
var genre = ["Name", "Games"];
var series = ["Name", "Games"];
var character = ["Name", "Games", "Abilities"];
var programmer = ["Name", "Developer", "Games"];

document.getElementById("videogame").addEventListener("click",
function(event)
{
	//remove form if it is already there
	var form = document.getElementById("searchForm");
	document.body.removeChild(form);
	
	//make a form using the videogame array as the list of attributes
	var form = document.createElement("form");
	form.setAttribute("id", "searchForm");
	document.body.appendChild(form);
	
	for(var i = 0; i < 5; i++)
	{
		var fieldSet = document.createElement("fieldset");
		
		var label = document.createElement("label");
		label.textContent = videogame[i] + ": ";
		
		var input = document.createElement("input");
		input.setAttribute("name", videogame[i]);
		
		//if date attribute, data should be collected as a date
		if(i == 1)
			input.setAttribute("type", "date");
		//all other attributes can be collected as text
		else
			input.setAttribute("type", "text");
		
		label.appendChild(input);
		
		fieldSet.appendChild(label);
		
		//adds the new fieldset to the form
		form.appendChild(fieldSet);
		
		//if at end of for loop, place a submit button
		if(i == 4)
		{
			var submit = document.createElement("input");
			submit.setAttribute("id", "videogameSubmit");
			submit.setAttribute("type", "submit");
			form.appendChild(submit);
		}
	}
	
});

document.getElementById("platform").addEventListener("click",
function(event)
{
	//remove form if it is already there
	var form = document.getElementById("searchForm");
	document.body.removeChild(form);
	
	//make a form using the videogame array as the list of attributes
	var form = document.createElement("form");
	form.setAttribute("id", "searchForm");
	document.body.appendChild(form);
	
	for(var i = 0; i < 3; i++)
	{
		var fieldSet = document.createElement("fieldset");
		
		var label = document.createElement("label");
		label.textContent = platform[i] + ": ";
		
		var input = document.createElement("input");
		
		//if date attribute, data should be collected as a date
		if(i == 2)
			input.setAttribute("type", "date");
		//all other attributes can be collected as text
		else
			input.setAttribute("type", "text");
		
		label.appendChild(input);
		fieldSet.appendChild(label);
		
		//adds the new fieldset to the form
		form.appendChild(fieldSet);
		
		//if at end of for loop, place a submit button
		if(i == 2)
		{
			var submit = document.createElement("input");
			submit.setAttribute("id", "platformSubmit");
			submit.setAttribute("type", "submit");
			form.appendChild(submit);
		}
	}
});

document.getElementById("developer").addEventListener("click",
function(event)
{
	//remove form if it is already there
	var form = document.getElementById("searchForm");
	document.body.removeChild(form);
	
	//make a form using the videogame array as the list of attributes
	var form = document.createElement("form");
	form.setAttribute("id", "searchForm");
	document.body.appendChild(form);
	
	for(var i = 0; i < 2; i++)
	{
		var fieldSet = document.createElement("fieldset");
		
		var label = document.createElement("label");
		label.textContent = developer[i] + ": ";
		
		var input = document.createElement("input");
		
		//all attributes can be recorded as text
		input.setAttribute("type", "text");
		
		label.appendChild(input);
		fieldSet.appendChild(label);
		
		//adds the new fieldset to the form
		form.appendChild(fieldSet);
		
		//if at end of for loop, place a submit button
		if(i == 1)
		{
			var submit = document.createElement("input");
			submit.setAttribute("id", "developerSubmit");
			submit.setAttribute("type", "submit");
			form.appendChild(submit);
		}
	}
});

document.getElementById("artist").addEventListener("click",
function(event)
{
	//remove form if it is already there
	var form = document.getElementById("searchForm");
	document.body.removeChild(form);
	
	//make a form using the videogame array as the list of attributes
	var form = document.createElement("form");
	form.setAttribute("id", "searchForm");
	document.body.appendChild(form);
	
	for(var i = 0; i < 3; i++)
	{
		var fieldSet = document.createElement("fieldset");
		
		var label = document.createElement("label");
		label.textContent = artist[i] + ": ";
		
		var input = document.createElement("input");
		
		//all attributes can be recorded as text
		input.setAttribute("type", "text");
		
		label.appendChild(input);
		fieldSet.appendChild(label);
		
		//adds the new fieldset to the form
		form.appendChild(fieldSet);
		
		//if at end of for loop, place a submit button
		if(i == 2)
		{
			var submit = document.createElement("input");
			submit.setAttribute("id", "artistSubmit");
			submit.setAttribute("type", "submit");
			form.appendChild(submit);
		}
	}
});

document.getElementById("composer").addEventListener("click",
function(event)
{
	//remove form if it is already there
	var form = document.getElementById("searchForm");
	document.body.removeChild(form);
	
	//make a form using the videogame array as the list of attributes
	var form = document.createElement("form");
	form.setAttribute("id", "searchForm");
	document.body.appendChild(form);
	
	for(var i = 0; i < 3; i++)
	{
		var fieldSet = document.createElement("fieldset");
		
		var label = document.createElement("label");
		label.textContent = composer[i] + ": ";
		
		var input = document.createElement("input");
		
		//all attributes can be recorded as text
		input.setAttribute("type", "text");
		
		label.appendChild(input);
		fieldSet.appendChild(label);
		
		//adds the new fieldset to the form
		form.appendChild(fieldSet);
		
		//if at end of for loop, place a submit button
		if(i == 2)
		{
			var submit = document.createElement("input");
			submit.setAttribute("id", "composerSubmit");
			submit.setAttribute("type", "submit");
			form.appendChild(submit);
		}
	}
});

document.getElementById("genre").addEventListener("click",
function(event)
{
	//remove form if it is already there
	var form = document.getElementById("searchForm");
	document.body.removeChild(form);
	
	//make a form using the videogame array as the list of attributes
	var form = document.createElement("form");
	form.setAttribute("id", "searchForm");
	document.body.appendChild(form);
	
	for(var i = 0; i < 2; i++)
	{
		var fieldSet = document.createElement("fieldset");
		
		var label = document.createElement("label");
		label.textContent = genre[i] + ": ";
		
		var input = document.createElement("input");
		
		//all attributes can be recorded as text
		input.setAttribute("type", "text");
		
		label.appendChild(input);
		fieldSet.appendChild(label);
		
		//adds the new fieldset to the form
		form.appendChild(fieldSet);
		
		//if at end of for loop, place a submit button
		if(i == 1)
		{
			var submit = document.createElement("input");
			submit.setAttribute("id", "genreSubmit");
			submit.setAttribute("type", "submit");
			form.appendChild(submit);
		}
	}
});

document.getElementById("series").addEventListener("click",
function(event)
{
	//remove form if it is already there
	var form = document.getElementById("searchForm");
	document.body.removeChild(form);
	
	//make a form using the videogame array as the list of attributes
	var form = document.createElement("form");
	form.setAttribute("id", "searchForm");
	document.body.appendChild(form);
	
	for(var i = 0; i < 2; i++)
	{
		var fieldSet = document.createElement("fieldset");
		
		var label = document.createElement("label");
		label.textContent = series[i] + ": ";
		
		var input = document.createElement("input");
		
		//all attributes can be recorded as text
		input.setAttribute("type", "text");
		
		label.appendChild(input);
		fieldSet.appendChild(label);
		
		//adds the new fieldset to the form
		form.appendChild(fieldSet);
		
		//if at end of for loop, place a submit button
		if(i == 1)
		{
			var submit = document.createElement("input");
			submit.setAttribute("id", "seriesSubmit");
			submit.setAttribute("type", "submit");
			form.appendChild(submit);
		}
	}
});

document.getElementById("character").addEventListener("click",
function(event)
{
	//remove form if it is already there
	var form = document.getElementById("searchForm");
	document.body.removeChild(form);
	
	//make a form using the videogame array as the list of attributes
	var form = document.createElement("form");
	form.setAttribute("id", "searchForm");
	document.body.appendChild(form);
	
	for(var i = 0; i < 3; i++)
	{
		var fieldSet = document.createElement("fieldset");
		
		var label = document.createElement("label");
		label.textContent = character[i] + ": ";
		
		var input = document.createElement("input");
		
		//all attributes can be recorded as text
		input.setAttribute("type", "text");
		
		label.appendChild(input);
		fieldSet.appendChild(label);
		
		//adds the new fieldset to the form
		form.appendChild(fieldSet);
		
		//if at end of for loop, place a submit button
		if(i == 2)
		{
			var submit = document.createElement("input");
			submit.setAttribute("id", "characterSubmit");
			submit.setAttribute("type", "submit");
			form.appendChild(submit);
		}
	}
});

document.getElementById("programmer").addEventListener("click",
function(event)
{
	//remove form if it is already there
	var form = document.getElementById("searchForm");
	document.body.removeChild(form);
	
	//make a form using the videogame array as the list of attributes
	var form = document.createElement("form");
	form.setAttribute("id", "searchForm");
	document.body.appendChild(form);
	
	for(var i = 0; i < 3; i++)
	{
		var fieldSet = document.createElement("fieldset");
		
		var label = document.createElement("label");
		label.textContent = programmer[i] + ": ";
		
		var input = document.createElement("input");
		
		//all attributes can be recorded as text
		input.setAttribute("type", "text");
		
		label.appendChild(input);
		fieldSet.appendChild(label);
		
		//adds the new fieldset to the form
		form.appendChild(fieldSet);
		
		//if at end of for loop, place a submit button
		if(i == 2)
		{
			var submit = document.createElement("input");
			submit.setAttribute("id", "programmerSubmit");
			submit.setAttribute("type", "submit");
			form.appendChild(submit);
		}
	}
});