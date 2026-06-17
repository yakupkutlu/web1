define(function () {
  // Hebrew
  return {
    errorLoading: function () {
      return '×©×’×™××” ×‘×˜×¢×™× ×ª ×”×ª×•×¦××•×ª';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = '× × ×œ××—×•×§ ';

      if (overChars === 1) {
        message += '×ª×• ××—×“';
      } else {
        message += overChars + ' ×ª×•×•×™×';
      }

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = '× × ×œ×”×›× ×™×¡ ';

      if (remainingChars === 1) {
        message += '×ª×• ××—×“';
      } else {
        message += remainingChars + ' ×ª×•×•×™×';
      }

      message += ' ××• ×™×•×ª×¨';

      return message;
    },
    loadingMore: function () {
      return '×˜×•×¢×Ÿ ×ª×•×¦××•×ª × ×•×¡×¤×•×ªâ€¦';
    },
    maximumSelected: function (args) {
      var message = '×‘××¤×©×¨×•×ª×š ×œ×‘×—×•×¨ ×¢×“ ';

      if (args.maximum === 1) {
        message += '×¤×¨×™×˜ ××—×“';
      } else {
        message += args.maximum + ' ×¤×¨×™×˜×™×';
      }

      return message;
    },
    noResults: function () {
      return '×œ× × ××¦××• ×ª×•×¦××•×ª';
    },
    searching: function () {
      return '××—×¤×©â€¦';
    }
  };
});
