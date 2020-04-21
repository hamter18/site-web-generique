var listeDesMois = new Array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aôut', 'septembre', 'octobre', 'novembre', 'décembre');
var listeDesJours = new Array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
var dateJour = new Date();
dateJour.setHours(0,0,0,0);
var jourCourrant = new Date(dateJour.getFullYear(), dateJour.getMonth(), 1);
var content = document.createElement('div');
var divMois = document.createElement('div');
var domElement;
class Calendar
{
    constructor(domTarget)
    {
        domElement = document.querySelector(domTarget);
        let header = document.createElement('div');
        header.classList.add('header');
        domElement.appendChild(header);
        domElement.appendChild(content);
        let btnDiv1 = document.createElement('div');
        let previousButton = document.createElement('button');
        previousButton.setAttribute('data-action', '-1');
        previousButton.textContent = '<';
        btnDiv1.appendChild(previousButton);
        header.appendChild(btnDiv1);
        divMois.classList.add('month');
        header.appendChild(divMois);
        let btnDiv2 = document.createElement('div');
        let nextButton = document.createElement('button');
        nextButton.setAttribute('data-action', '1');
        nextButton.textContent = '>';
        btnDiv2.appendChild(nextButton);
        header.appendChild(btnDiv2);

        domElement.querySelectorAll('button').forEach(element =>
        {
            element.addEventListener('click', () =>
            {
                jourCourrant.setMonth(jourCourrant.getMonth() * 1 + element.getAttribute('data-action') * 1);
                loadMonth(jourCourrant);
                jourChoisie(jourCourrant);

            });
        });
        loadMonth(jourCourrant);
        jourChoisie(jourCourrant);
    }
}
    

const calendar = new Calendar('.calendar');
this.jourChoisie(jourCourrant);


function loadMonth(date)
{
    content.textContent = '';
    divMois.textContent = listeDesMois[date.getMonth()].toUpperCase() + ' ' + date.getFullYear();
    for(let i=0; i<listeDesJours.length; i++)
    {
        let cell = document.createElement('span');
        cell.classList.add('cell');
        cell.classList.add('day');
        cell.textContent = listeDesJours[i].substring(0, 3).toUpperCase();
        content.appendChild(cell);
    }
    for(let i=0; i<date.getDay(); i++)
    {
        let cell = document.createElement('span');
        cell.classList.add('cell');
        cell.classList.add('empty');
        content.appendChild(cell);
    }
    let monthLength = new Date(date.getFullYear(), date.getMonth()+1, 0).getDate();
    for(let i=1; i<=monthLength; i++)
    {
        let cell = document.createElement('span');
        cell.classList.add('cell');
        cell.textContent = i;
        content.appendChild(cell);
        let timestamp = new Date(date.getFullYear(), date.getMonth(), i).getTime();
        if(timestamp === dateJour.getTime())
        {
            cell.classList.add('dateJour');
        }
    }
}



function recupererDateDuJour(){
    let dateselectionner = document.querySelector('.dateJour');
    if(dateselectionner!=null){
        dateselectionner.classList.remove('dateJour');
    }
}

function jourChoisie(date){

    let cellChoisie = document.querySelectorAll('.cell');
    let dayChoisie = document.querySelectorAll('.day');
    cellChoisie.forEach(function(currentBtn){
        currentBtn.addEventListener('click', function(){
            recupererDateDuJour();
            var mois = listeDesMois[date.getMonth()].toUpperCase() + ' ' + date.getFullYear();
            document.querySelector('.jourChoisie').innerHTML = "Rendez-vous pour le " + currentBtn.textContent +" " + mois;
            currentBtn.classList.add('dateJour');
            document.querySelector('table').setAttribute('class','width');
            document.querySelector('.submit').setAttribute('class','width');
        });
    });
    
}

