define(function () {
  // Romanian
  return {
    errorLoading: function () {
      return 'Rezultatele nu au putut fi incÄƒrcate.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'VÄƒ rugÄƒm sÄƒ È™tergeÈ›i' + overChars + ' caracter';

      if (overChars !== 1) {
        message += 'e';
      }

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'VÄƒ rugÄƒm sÄƒ introduceÈ›i ' + remainingChars +
        'sau mai multe caractere';

      return message;
    },
    loadingMore: function () {
      return 'Se Ã®ncarcÄƒ mai multe rezultateâ€¦';
    },
    maximumSelected: function (args) {
      var message = 'AveÈ›i voie sÄƒ selectaÈ›i cel mult ' + args.maximum;
      message += ' element';

      if (args.maximum !== 1) {
        message += 'e';
      }

      return message;
    },
    noResults: function () {
      return 'Nu au fost gÄƒsite rezultate';
    },
    searching: function () {
      return 'CÄƒutareâ€¦';
    }
  };
});
