define(function () {
  // Chinese (Traditional)
  return {
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'è«‹åˆªæ‰' + overChars + 'å€‹å­—å…ƒ';

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'è«‹å†è¼¸å…¥' + remainingChars + 'å€‹å­—å…ƒ';

      return message;
    },
    loadingMore: function () {
      return 'è¼‰å…¥ä¸­â€¦';
    },
    maximumSelected: function (args) {
      var message = 'ä½ åªèƒ½é¸æ“‡æœ€å¤š' + args.maximum + 'é …';

      return message;
    },
    noResults: function () {
      return 'æ²’æœ‰æ‰¾åˆ°ç›¸ç¬¦çš„é …ç›®';
    },
    searching: function () {
      return 'æœå°‹ä¸­â€¦';
    }
  };
});
