define(function () {
  // Swedish
  return {
    errorLoading: function () {
      return 'Resultat kunde inte laddas.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'VÃ¤nligen sudda ut ' + overChars + ' tecken';

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'VÃ¤nligen skriv in ' + remainingChars +
                    ' eller fler tecken';

      return message;
    },
    loadingMore: function () {
      return 'Laddar fler resultatâ€¦';
    },
    maximumSelected: function (args) {
      var message = 'Du kan max vÃ¤lja ' + args.maximum + ' element';

      return message;
    },
    noResults: function () {
      return 'Inga trÃ¤ffar';
    },
    searching: function () {
      return 'SÃ¶kerâ€¦';
    }
  };
});
