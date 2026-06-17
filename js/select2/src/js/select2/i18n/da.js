define(function () {
  // Danish
  return {
    errorLoading: function () {
      return 'Resultaterne kunne ikke indlÃ¦ses.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'Angiv venligst ' + overChars + ' tegn mindre';

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Angiv venligst ' + remainingChars + ' tegn mere';

      return message;
    },
    loadingMore: function () {
      return 'IndlÃ¦ser flere resultaterâ€¦';
    },
    maximumSelected: function (args) {
      var message = 'Du kan kun vÃ¦lge ' + args.maximum + ' emne';

      if (args.maximum != 1) {
        message += 'r';
      }

      return message;
    },
    noResults: function () {
      return 'Ingen resultater fundet';
    },
    searching: function () {
      return 'SÃ¸gerâ€¦';
    }
  };
});
