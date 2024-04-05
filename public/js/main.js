document.addEventListener('DOMContentLoaded', function() {
    const categories = document.querySelectorAll('.categorie');
    const popups = document.querySelectorAll('.popup');
    const info =  document.querySelectorAll('.info')
    const information = document.querySelector('.information')

    categories.forEach(function(categorie) {
        categorie.style.cursor = 'pointer'
        categorie.addEventListener('mouseenter', function() {
            const target = this.getAttribute('data-target');
            const popup = document.getElementById(`${target}Popup`);
            if (popup) {
                popups.forEach(function(popup) {
                    popup.style.display = 'none';
                });
                popup.style.display = 'block';
            }
        });
    });

    popups.forEach(function(popup) {
        popup.addEventListener('mouseleave', function() {
            this.style.display = 'none';
        });
    });

    info.forEach(function(item){
        item.addEventListener('click' , function(){
            let id = item.id
            const url = `/view/${id}`;
            fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); 
            })
            .then(data => {

                const dateNaissance = data.dateNaissance.date;

                const formattedDate = new Date(dateNaissance).toLocaleDateString('en-GB');

                let popupContent = `
                    <div>
                        <h3> Information sur : ${data.name}</h3>
                        <strong>Nom : </strong><span> ${data.name}</span> <br>
                        <strong>Date de naissance </strong>:<span> ${formattedDate}</span>
                        <br>
                        <strong>Nationalite :</strong><span> ${data.nationalite}</span>
                        <br>
                        <strong>ClubTeam : </strong><span> ${data.club}</span>
                        <br>
                        <strong>NationalTeam : </strong><span> ${data.nationale}</span>
                        <br>
                        <strong>Nombre de but : </strong><span> ${data.nombreBut}</span>
                        <br>
                        <strong>Parcours : </strong><span> ${data.parcours}</span>
                        <hr>
                        <button class='btn btn-primary fermer'>Fermer</button>
                    </div>
            `;
                information.innerHTML = popupContent;
                information.style.display = 'block'

                const fermer =  document.querySelector('.fermer')
                fermer.addEventListener('click' , function(){
                    information.style.display = 'none'
                })
            })
            .catch(error => {
                console.error('There was a problem with your fetch operation:', error);
            });
        })
    })
 
});
