define(function () {
  // Bulgarian
  return {
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'ĞœĞ¾Ğ»Ñ Ğ²ÑŠĞ²ĞµĞ´ĞµÑ‚Ğµ Ñ ' + overChars + ' Ğ¿Ğ¾-Ğ¼Ğ°Ğ»ĞºĞ¾ ÑĞ¸Ğ¼Ğ²Ğ¾Ğ»';

      if (overChars > 1) {
        message += 'a';
      }

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'ĞœĞ¾Ğ»Ñ Ğ²ÑŠĞ²ĞµĞ´ĞµÑ‚Ğµ Ğ¾Ñ‰Ğµ ' + remainingChars + ' ÑĞ¸Ğ¼Ğ²Ğ¾Ğ»';

      if (remainingChars > 1) {
        message += 'a';
      }

      return message;
    },
    loadingMore: function () {
      return 'Ğ—Ğ°Ñ€ĞµĞ¶Ğ´Ğ°Ñ‚ ÑĞµ Ğ¾Ñ‰Ğµâ€¦';
    },
    maximumSelected: function (args) {
      var message = 'ĞœĞ¾Ğ¶ĞµÑ‚Ğµ Ğ´Ğ° Ğ½Ğ°Ğ¿Ñ€Ğ°Ğ²Ğ¸Ñ‚Ğµ Ğ´Ğ¾ ' + args.maximum + ' ';

      if (args.maximum > 1) {
        message += 'Ğ¸Ğ·Ğ±Ğ¾Ñ€Ğ°';
      } else {
        message += 'Ğ¸Ğ·Ğ±Ğ¾Ñ€';
      }

      return message;
    },
    noResults: function () {
      return 'ĞÑĞ¼Ğ° Ğ½Ğ°Ğ¼ĞµÑ€ĞµĞ½Ğ¸ ÑÑŠĞ²Ğ¿Ğ°Ğ´ĞµĞ½Ğ¸Ñ';
    },
    searching: function () {
      return 'Ğ¢ÑŠÑ€ÑĞµĞ½Ğµâ€¦';
    }
  };
});
