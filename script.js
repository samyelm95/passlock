// Récupération de l'élément d'entrée pour le mot de passe
var motdepasse = document.getElementById('motdepasse');

// Tableaux de caractères possibles pour chaque catégorie
var tableauminuscule = ["a", "z", "e", "r", "t", "y", "u", "i", "o", "p", "q", "s", "d", "f", "g", "h", "j", "k", "l", "m", "w", "x", "c", "v", "b", "n"];
var tableaumajuscule = ["A", "Z", "E", "R", "T", "Y", "U", "I", "O", "P", "Q", "S", "D", "F", "G", "H", "J", "K", "L", "M", "W", "X", "C", "V", "B", "N"];
var tableaunumero = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
var tableausymbole = ["$", "%", "^", "&", "!", "@", "#", ":", ";", "'", ",", ".", ">", "/", "*", "-", ",", "|", "?", "~", "_", "=", "+"];

// Fonction pour générer le mot de passe
function generateur() {
  // Concaténation de tous les tableaux de caractères sélectionnés
  var tableauxregroupé = [].concat(
    lowercase.checked ? tableauminuscule : [],
    uppercase.checked ? tableaumajuscule : [],
    numbers.checked ? tableaunumero : [],
    symbols.checked ? tableausymbole : []);

  // Récupération de la longueur du mot de passe
  var passwordLength = parseInt(document.getElementById('taille').value);
  var mdp = '';

  // Vérification des critères de génération du mot de passe
  if (tableauxregroupé.length < 1 && passwordLength < 6) {
    alert('Tu dois sélectionner au moins un critère et la longueur doit être d\'au moins 6 caractères');
  } else if (tableauxregroupé.length >= 1 && passwordLength < 6) {
    alert('La longueur minimale du mot de passe doit être d\'au moins 6 caractères');
  } else if (tableauxregroupé.length < 1 && passwordLength < 12) {
    alert('Tu dois sélectionner au moins un critère et la longueur doit être d\'au moins 12 caractères');
  } else if (tableauxregroupé.length < 1 && passwordLength >= 6) {
    alert('Tu dois sélectionner au moins un critère');
  } else {
    // Génération du mot de passe
    for (i = 0; i < passwordLength; i++) {
      mdp += tableauxregroupé[Math.floor(Math.random() * tableauxregroupé.length)];
    }
    // Affichage du mot de passe généré
    motdepasse.value = mdp;
  }
}

// Fonction pour copier le mot de passe dans le presse-papiers
function copie() {
  if (document.getElementById('motdepasse').value == 0) {
    alert('La case est vide, il n\'y a rien à copier');
  } else {
    motdepasse.select();
    document.execCommand('copy');
    alert('Mot de passe copié dans le presse-papiers');
  }
}

// Fonction pour générer le meilleur mot de passe possible
function best() {
  // Réinitialisation des paramètres pour le meilleur mot de passe
  document.getElementById('taille').value = 16;
  document.getElementById('lowercase').checked = true;
  document.getElementById('uppercase').checked = true;
  document.getElementById('numbers').checked = true;
  document.getElementById('symbols').checked = true;
  // Génération du mot de passe
  generateur();
}
