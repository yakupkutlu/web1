define(function () {
  // Greek (el)
  return {
    errorLoading: function () {
      return 'Î¤Î± Î±Ï€Î¿Ï„ÎµÎ»Î­ÏƒÎ¼Î±Ï„Î± Î´ÎµÎ½ Î¼Ï€ÏŒÏÎµÏƒÎ±Î½ Î½Î± Ï†Î¿ÏÏ„ÏÏƒÎ¿Ï…Î½.';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'Î Î±ÏÎ±ÎºÎ±Î»Ï Î´Î¹Î±Î³ÏÎ¬ÏˆÏ„Îµ ' + overChars + ' Ï‡Î±ÏÎ±ÎºÏ„Î®Ï';

      if (overChars == 1) {
        message += 'Î±';
      }
      if (overChars != 1) {
        message += 'ÎµÏ‚';
      }

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Î Î±ÏÎ±ÎºÎ±Î»Ï ÏƒÏ…Î¼Ï€Î»Î·ÏÏÏƒÏ„Îµ ' + remainingChars +
        ' Î® Ï€ÎµÏÎ¹ÏƒÏƒÏŒÏ„ÎµÏÎ¿Ï…Ï‚ Ï‡Î±ÏÎ±ÎºÏ„Î®ÏÎµÏ‚';

      return message;
    },
    loadingMore: function () {
      return 'Î¦ÏŒÏÏ„Ï‰ÏƒÎ· Ï€ÎµÏÎ¹ÏƒÏƒÏŒÏ„ÎµÏÏ‰Î½ Î±Ï€Î¿Ï„ÎµÎ»ÎµÏƒÎ¼Î¬Ï„Ï‰Î½â€¦';
    },
    maximumSelected: function (args) {
      var message = 'ÎœÏ€Î¿ÏÎµÎ¯Ï„Îµ Î½Î± ÎµÏ€Î¹Î»Î­Î¾ÎµÏ„Îµ Î¼ÏŒÎ½Î¿ ' + args.maximum + ' ÎµÏ€Î¹Î»Î¿Î³';

      if (args.maximum == 1) {
        message += 'Î®';
      }

      if (args.maximum != 1) {
        message += 'Î­Ï‚';
      }

      return message;
    },
    noResults: function () {
      return 'Î”ÎµÎ½ Î²ÏÎ­Î¸Î·ÎºÎ±Î½ Î±Ï€Î¿Ï„ÎµÎ»Î­ÏƒÎ¼Î±Ï„Î±';
    },
    searching: function () {
      return 'Î‘Î½Î±Î¶Î®Ï„Î·ÏƒÎ·â€¦';
    }
  };
});