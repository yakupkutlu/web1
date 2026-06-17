define(function () {
  // French
  return {
    errorLoading: function () {
      return 'Les rÃ©sultats ne peuvent pas Ãªtre chargÃ©s.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'Supprimez ' + overChars + ' caractÃ¨re';

      if (overChars !== 1) {
        message += 's';
      }

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Saisissez ' + remainingChars + ' caractÃ¨re';

      if (remainingChars !== 1) {
        message += 's';
      }

      return message;
    },
    loadingMore: function () {
      return 'Chargement de rÃ©sultats supplÃ©mentairesâ€¦';
    },
    maximumSelected: function (args) {
      var message = 'Vous pouvez seulement sÃ©lectionner ' +
        args.maximum + ' Ã©lÃ©ment';

      if (args.maximum !== 1) {
        message += 's';
      }

      return message;
    },
    noResults: function () {
      return 'Aucun rÃ©sultat trouvÃ©';
    },
    searching: function () {
      return 'Recherche en coursâ€¦';
    }
  };
});
