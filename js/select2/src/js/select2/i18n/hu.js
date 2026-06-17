define(function () {
  // Hungarian
  return {
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      return 'TÃºl hosszÃº. ' + overChars + ' karakterrel tÃ¶bb, mint kellene.';
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      return 'TÃºl rÃ¶vid. MÃ©g ' + remainingChars + ' karakter hiÃ¡nyzik.';
    },
    loadingMore: function () {
      return 'TÃ¶ltÃ©sâ€¦';
    },
    maximumSelected: function (args) {
      return 'Csak ' + args.maximum + ' elemet lehet kivÃ¡lasztani.';
    },
    noResults: function () {
      return 'Nincs talÃ¡lat.';
    },
    searching: function () {
      return 'KeresÃ©sâ€¦';
    }
  };
});
