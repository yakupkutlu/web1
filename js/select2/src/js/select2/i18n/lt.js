define(function () {
  // rules from
  // http://www.unicode.org/cldr/charts/latest/supplemental/language_plural_rules.html#lt
  function ending(count, one, few, other) {
    if (count % 10 === 1 && (count % 100 < 11 || count % 100 > 19)) {
      return one;
    } else if (
      (count % 10 >= 2 && count % 10 <= 9) &&
      (count % 100 < 11 || count % 100 > 19)) {
      return few;
    } else {
      return other;
    }
  }

  return {
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'PaÅ¡alinkite ' + overChars + ' simbol';

      message += ending(overChars, 'Ä¯', 'ius', 'iÅ³');

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Ä®raÅ¡ykite dar ' + remainingChars + ' simbol';

      message += ending(remainingChars, 'Ä¯', 'ius', 'iÅ³');

      return message;
    },
    loadingMore: function () {
      return 'Kraunama daugiau rezultatÅ³â€¦';
    },
    maximumSelected: function (args) {
      var message = 'JÅ«s galite pasirinkti tik ' + args.maximum + ' element';

      message += ending(args.maximum, 'Ä…', 'us', 'Å³');

      return message;
    },
    noResults: function () {
      return 'AtitikmenÅ³ nerasta';
    },
    searching: function () {
      return 'IeÅ¡komaâ€¦';
    }
  };
});
