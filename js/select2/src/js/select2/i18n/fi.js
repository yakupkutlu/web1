define(function () {
  // Finnish
  return {
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      return 'Ole hyvÃ¤ ja anna ' + overChars + ' merkkiÃ¤ vÃ¤hemmÃ¤n';
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      return 'Ole hyvÃ¤ ja anna ' + remainingChars + ' merkkiÃ¤ lisÃ¤Ã¤';
    },
    loadingMore: function () {
      return 'Ladataan lisÃ¤Ã¤ tuloksiaâ€¦';
    },
    maximumSelected: function (args) {
      return 'Voit valita ainoastaan ' + args.maximum + ' kpl';
    },
    noResults: function () {
      return 'Ei tuloksia';
    },
    searching: function () {

    }
  };
});
