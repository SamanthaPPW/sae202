  function myFunction() {
      var x = document.getElementById("liens");
      if (x.classList.contains('show')) {
          x.classList.remove('show');
      } else {
          x.classList.add('show');
      }
  }

  // Paiement
  const select = document.querySelector('select[name="nombre_participants"]');
  const prixParDefaut = 39;
  const prixGroupe = 33;
  const prixTotalElem = document.getElementById('prix_total');

  if (select && prixTotalElem) {
      function calculerPrix() {
          const nb = parseInt(select.value);
          let prixUnitaire = nb >= 16 ? prixGroupe : prixParDefaut;
          let total = prixUnitaire * nb;
          prixTotalElem.textContent = total + "€";
      }

      calculerPrix();
      select.addEventListener('change', calculerPrix);
  }


