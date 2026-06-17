define(function () {
  // Serbian Cyrilic
  function ending (count, one, some, many) {
    if (count % 10 == 1 && count % 100 != 11) {
      return one;
    }

    if (count % 10 >= 2 && count % 10 <= 4 &&
      (count % 100 < 12 || count % 100 > 14)) {
        return some;
    }

    return many;
  }

  return {
    errorLoading: function () {
      return 'ĞŸÑ€ĞµÑƒĞ·Ğ¸Ğ¼Ğ°ÑšĞµ Ğ½Ğ¸Ñ˜Ğµ ÑƒÑĞ¿ĞµĞ»Ğ¾.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'ĞĞ±Ñ€Ğ¸ÑˆĞ¸Ñ‚Ğµ ' + overChars + ' ÑĞ¸Ğ¼Ğ±Ğ¾Ğ»';

      message += ending(overChars, '', 'Ğ°', 'Ğ°');

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Ğ£ĞºÑƒÑ†Ğ°Ñ˜Ñ‚Ğµ Ğ±Ğ°Ñ€ Ñ˜Ğ¾Ñˆ ' + remainingChars + ' ÑĞ¸Ğ¼Ğ±Ğ¾Ğ»';

      message += ending(remainingChars, '', 'Ğ°', 'Ğ°');

      return message;
    },
    loadingMore: function () {
      return 'ĞŸÑ€ĞµÑƒĞ·Ğ¸Ğ¼Ğ°ÑšĞµ Ñ˜Ğ¾Ñˆ Ñ€ĞµĞ·ÑƒĞ»Ñ‚Ğ°Ñ‚Ğ°â€¦';
    },
    maximumSelected: function (args) {
      var message = 'ĞœĞ¾Ğ¶ĞµÑ‚Ğµ Ğ¸Ğ·Ğ°Ğ±Ñ€Ğ°Ñ‚Ğ¸ ÑĞ°Ğ¼Ğ¾ ' + args.maximum + ' ÑÑ‚Ğ°Ğ²Ğº';

      message += ending(args.maximum, 'Ñƒ', 'Ğµ', 'Ğ¸');

      return message;
    },
    noResults: function () {
      return 'ĞĞ¸ÑˆÑ‚Ğ° Ğ½Ğ¸Ñ˜Ğµ Ğ¿Ñ€Ğ¾Ğ½Ğ°Ñ’ĞµĞ½Ğ¾';
    },
    searching: function () {
      return 'ĞŸÑ€ĞµÑ‚Ñ€Ğ°Ğ³Ğ°â€¦';
    }
  };
});
