define(function () {
  // Chinese (Simplified)
  return {
    errorLoading: function () {
      return 'æ— æ³•è½½å…¥ç»“æœã€‚';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'è¯·åˆ é™¤' + overChars + 'ä¸ªå­—ç¬¦';

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'è¯·å†è¾“å…¥è‡³å°‘' + remainingChars + 'ä¸ªå­—ç¬¦';

      return message;
    },
    loadingMore: function () {
      return 'è½½å…¥æ›´å¤šç»“æœâ€¦';
    },
    maximumSelected: function (args) {
      var message = 'æœ€å¤šåªèƒ½é€‰æ‹©' + args.maximum + 'ä¸ªé¡¹ç›®';

      return message;
    },
    noResults: function () {
      return 'æœªæ‰¾åˆ°ç»“æœ';
    },
    searching: function () {
      return 'æœç´¢ä¸­â€¦';
    }
  };
});
