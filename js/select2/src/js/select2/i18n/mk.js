define(function () {
  // Macedonian
  return {
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'Ğ’Ğµ Ğ¼Ğ¾Ğ»Ğ¸Ğ¼Ğµ Ğ²Ğ½ĞµÑĞµÑ‚Ğµ ' + args.maximum + ' Ğ¿Ğ¾Ğ¼Ğ°Ğ»ĞºÑƒ ĞºĞ°Ñ€Ğ°ĞºÑ‚ĞµÑ€';

      if (args.maximum !== 1) {
        message += 'Ğ¸';
      }

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Ğ’Ğµ Ğ¼Ğ¾Ğ»Ğ¸Ğ¼Ğµ Ğ²Ğ½ĞµÑĞµÑ‚Ğµ ÑƒÑˆÑ‚Ğµ ' + args.maximum + ' ĞºĞ°Ñ€Ğ°ĞºÑ‚ĞµÑ€';

      if (args.maximum !== 1) {
        message += 'Ğ¸';
      }

      return message;
    },
    loadingMore: function () {
      return 'Ğ’Ñ‡Ğ¸Ñ‚ÑƒĞ²Ğ°ÑšĞµ Ñ€ĞµĞ·ÑƒĞ»Ñ‚Ğ°Ñ‚Ğ¸â€¦';
    },
    maximumSelected: function (args) {
      var message = 'ĞœĞ¾Ğ¶ĞµÑ‚Ğµ Ğ´Ğ° Ğ¸Ğ·Ğ±ĞµÑ€ĞµÑ‚Ğµ ÑĞ°Ğ¼Ğ¾ ' + args.maximum + ' ÑÑ‚Ğ°Ğ²Ğº';

      if (args.maximum === 1) {
        message += 'Ğ°';
      } else {
        message += 'Ğ¸';
      }

      return message;
    },
    noResults: function () {
      return 'ĞĞµĞ¼Ğ° Ğ¿Ñ€Ğ¾Ğ½Ğ°Ñ˜Ğ´ĞµĞ½Ğ¾ ÑĞ¾Ğ²Ğ¿Ğ°Ñ“Ğ°ÑšĞ°';
    },
    searching: function () {
      return 'ĞŸÑ€ĞµĞ±Ğ°Ñ€ÑƒĞ²Ğ°ÑšĞµâ€¦';
    }
  };
});
