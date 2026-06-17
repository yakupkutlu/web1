define(function () {
  // Italian
  return {
    errorLoading: function () {
      return 'I risultati non possono essere caricati.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'Per favore cancella ' + overChars + ' caratter';

      if (overChars !== 1) {
        message += 'i';
      } else {
        message += 'e';
      }

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Per favore inserisci ' +remainingChars+ ' o piÃ¹ caratteri';

      return message;
    },
    loadingMore: function () {
      return 'Caricando piÃ¹ risultatiâ€¦';
    },
    maximumSelected: function (args) {
      var message = 'Puoi selezionare solo ' + args.maximum + ' element';

      if (args.maximum !== 1) {
        message += 'i';
      } else {
        message += 'o';
      }

      return message;
    },
    noResults: function () {
      return 'Nessun risultato trovato';
    },
    searching: function () {
      return 'Sto cercandoâ€¦';
    }
  };
});
