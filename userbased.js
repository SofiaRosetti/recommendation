// calcolare similarità tra utenti e utente x con coefficiente di correlazione di Pearson
// se i valori ottenuti con Pearson sono > 0 si aggiunge l'utente al NN di x
// se non ci sono NN non si consiglia nessun item
// selezionare gli item votati dai NN che non sono stati votati da x
// se l'insieme è vuoto non si consiglia nessun item
// fare la predizione
// ordinare gli item in base al valore decrescente della predizione

function getRecommendation(id) {
  // caricare i ratings degli utenti (tutti ID utenti, tutti ID servizi,
  // controllo il ratings della coppia  ID servizio - ID utente e prendo il valore del rating relativo)
  // calcolare correlazione per ottenere i NN usando i ratings dell'utente
    // per ogni utente che ha dei ratings, se l'utente in questione non è sè stesso, calcolare Pearson
      // per l'utente target, si sommano tutti i voti che ha dato facendo anche count++
      // per l'altro utente, si sommano tutti i voti che ha dato facendo anche count++
      // si calcola la media dei voti per ognuno dei 2 utenti (somma/count)
      // per il numero di ratings dell'utente target, se i ratings di entrambi gli utenti sono diversi da 0
      // (quindi l'elemento è stato votato da entrambi) calcolo numeratore e denominatore
    // ORA HO UN ARRAY CON I COEFF DI CORRELAZIONE PEARSON DI OGNI UTENTE CON L'UTENTE TARGET
  // selezionare gli item da consigliare (servizi votati dai NN ma non ancora votati dall'utente)
  // per ogni item nell'elenco fare la predizione usando i ratings dell'utente e i NN


}
