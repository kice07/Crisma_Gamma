
// Sélection des éléments avec les classes "bloc"
const blocs = document.querySelectorAll('.bloc');

// Ajout d'un écouteur de survol à chaque bloc
blocs.forEach(bloc => {
    bloc.addEventListener('mouseover', () => {
        // Lorsque le bloc est survolé, on lui applique un style
        bloc.querySelector("i").style.display="block";
        bloc.style.transform = `scale(1.02)`;
        
    });

    bloc.addEventListener('mouseout', () => {
        // Lorsque le survol cesse, on réinitialise les styles
        blocs.forEach(bloc => {
            bloc.style.transform = `scale(1)`;
            bloc.querySelector("i").style.display = "none";
        });
    });
});
