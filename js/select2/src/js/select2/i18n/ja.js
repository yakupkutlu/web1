define(function () {
  // Japanese
  return {
    errorLoading: function () {
      return 'çµæœãŒèª­ã¿è¾¼ã¾ã‚Œã¾ã›ã‚“ã§ã—ãŸ';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = overChars + ' æ–‡å­—ã‚’å‰Šé™¤ã—ã¦ãã ã•ã„';

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'å°‘ãªãã¨ã‚‚ ' + remainingChars + ' æ–‡å­—ã‚’å…¥åŠ›ã—ã¦ãã ã•ã„';

      return message;
    },
    loadingMore: function () {
      return 'èª­ã¿è¾¼ã¿ä¸­â€¦';
    },
    maximumSelected: function (args) {
      var message = args.maximum + ' ä»¶ã—ã‹é¸æŠã§ãã¾ã›ã‚“';

      return message;
    },
    noResults: function () {
      return 'å¯¾è±¡ãŒè¦‹ã¤ã‹ã‚Šã¾ã›ã‚“';
    },
    searching: function () {
      return 'æ¤œç´¢ã—ã¦ã„ã¾ã™â€¦';
    }
  };
});
