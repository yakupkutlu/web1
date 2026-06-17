define(function () {
  // Ukranian
  function ending (count, one, couple, more) {
    if (count % 100 > 10 && count % 100 < 15) {
      return more;
    }
    if (count % 10 === 1) {
      return one;
    }
    if (count % 10 > 1 && count % 10 < 5) {
      return couple;
    }
    return more;
  }

  return {
    errorLoading: function () {
      return 'ĞĞµĞ¼Ğ¾Ğ¶Ğ»Ğ¸Ğ²Ğ¾ Ğ·Ğ°Ğ²Ğ°Ğ½Ñ‚Ğ°Ğ¶Ğ¸Ñ‚Ğ¸ Ñ€ĞµĞ·ÑƒĞ»ÑŒÑ‚Ğ°Ñ‚Ğ¸';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;
      return 'Ğ‘ÑƒĞ´ÑŒ Ğ»Ğ°ÑĞºĞ°, Ğ²Ğ¸Ğ´Ğ°Ğ»Ñ–Ñ‚ÑŒ ' + overChars + ' ' +
        ending(args.maximum, 'Ğ»Ñ–Ñ‚ĞµÑ€Ñƒ', 'Ğ»Ñ–Ñ‚ĞµÑ€Ğ¸', 'Ğ»Ñ–Ñ‚ĞµÑ€');
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;
      return 'Ğ‘ÑƒĞ´ÑŒ Ğ»Ğ°ÑĞºĞ°, Ğ²Ğ²ĞµĞ´Ñ–Ñ‚ÑŒ ' + remainingChars + ' Ğ°Ğ±Ğ¾ Ğ±Ñ–Ğ»ÑŒÑˆĞµ Ğ»Ñ–Ñ‚ĞµÑ€';
    },
    loadingMore: function () {
      return 'Ğ—Ğ°Ğ²Ğ°Ğ½Ñ‚Ğ°Ğ¶ĞµĞ½Ğ½Ñ Ñ–Ğ½ÑˆĞ¸Ñ… Ñ€ĞµĞ·ÑƒĞ»ÑŒÑ‚Ğ°Ñ‚Ñ–Ğ²â€¦';
    },
    maximumSelected: function (args) {
      return 'Ğ’Ğ¸ Ğ¼Ğ¾Ğ¶ĞµÑ‚Ğµ Ğ²Ğ¸Ğ±Ñ€Ğ°Ñ‚Ğ¸ Ğ»Ğ¸ÑˆĞµ ' + args.maximum + ' ' +
        ending(args.maximum, 'Ğ¿ÑƒĞ½ĞºÑ‚', 'Ğ¿ÑƒĞ½ĞºÑ‚Ğ¸', 'Ğ¿ÑƒĞ½ĞºÑ‚Ñ–Ğ²');
    },
    noResults: function () {
      return 'ĞÑ–Ñ‡Ğ¾Ğ³Ğ¾ Ğ½Ğµ Ğ·Ğ½Ğ°Ğ¹Ğ´ĞµĞ½Ğ¾';
    },
    searching: function () {
      return 'ĞŸĞ¾ÑˆÑƒĞºâ€¦';
    }
  };
});
