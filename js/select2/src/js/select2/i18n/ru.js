define(function () {
  // Russian
  function ending (count, one, couple, more) {
    if (count % 10 < 5 && count % 10 > 0 &&
        count % 100 < 5 || count % 100 > 20) {
      if (count % 10 > 1) {
        return couple;
      }
    } else {
      return more;
    }

    return one;
  }

  return {
    errorLoading: function () {
      return 'ĞĞµĞ²Ğ¾Ğ·Ğ¼Ğ¾Ğ¶Ğ½Ğ¾ Ğ·Ğ°Ğ³Ñ€ÑƒĞ·Ğ¸Ñ‚ÑŒ Ñ€ĞµĞ·ÑƒĞ»ÑŒÑ‚Ğ°Ñ‚Ñ‹';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'ĞŸĞ¾Ğ¶Ğ°Ğ»ÑƒĞ¹ÑÑ‚Ğ°, Ğ²Ğ²ĞµĞ´Ğ¸Ñ‚Ğµ Ğ½Ğ° ' + overChars + ' ÑĞ¸Ğ¼Ğ²Ğ¾Ğ»';

      message += ending(overChars, '', 'a', 'Ğ¾Ğ²');

      message += ' Ğ¼ĞµĞ½ÑŒÑˆĞµ';

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'ĞŸĞ¾Ğ¶Ğ°Ğ»ÑƒĞ¹ÑÑ‚Ğ°, Ğ²Ğ²ĞµĞ´Ğ¸Ñ‚Ğµ ĞµÑ‰Ğµ Ñ…Ğ¾Ñ‚Ñ Ğ±Ñ‹ ' + remainingChars +
        ' ÑĞ¸Ğ¼Ğ²Ğ¾Ğ»';

      message += ending(remainingChars, '', 'a', 'Ğ¾Ğ²');

      return message;
    },
    loadingMore: function () {
      return 'Ğ—Ğ°Ğ³Ñ€ÑƒĞ·ĞºĞ° Ğ´Ğ°Ğ½Ğ½Ñ‹Ñ…â€¦';
    },
    maximumSelected: function (args) {
      var message = 'Ğ’Ñ‹ Ğ¼Ğ¾Ğ¶ĞµÑ‚Ğµ Ğ²Ñ‹Ğ±Ñ€Ğ°Ñ‚ÑŒ Ğ½Ğµ Ğ±Ğ¾Ğ»ĞµĞµ ' + args.maximum + ' ÑĞ»ĞµĞ¼ĞµĞ½Ñ‚';

      message += ending(args.maximum, '', 'a', 'Ğ¾Ğ²');

      return message;
    },
    noResults: function () {
      return 'Ğ¡Ğ¾Ğ²Ğ¿Ğ°Ğ´ĞµĞ½Ğ¸Ğ¹ Ğ½Ğµ Ğ½Ğ°Ğ¹Ğ´ĞµĞ½Ğ¾';
    },
    searching: function () {
      return 'ĞŸĞ¾Ğ¸ÑĞºâ€¦';
    }
  };
});
