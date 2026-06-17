define(function () {
  // Arabic
  return {
    errorLoading: function () {
      return 'Ù„Ø§ ÙŠÙ…ÙƒÙ† ØªØ­Ù…ÙŠÙ„ Ø§Ù„Ù†ØªØ§Ø¦Ø¬';
    },
    inputTooLong: function (args) {
      var overChars = args.input.length - args.maximum;

      var message = 'Ø§Ù„Ø±Ø¬Ø§Ø¡ Ø­Ø°Ù ' + overChars + ' Ø¹Ù†Ø§ØµØ±';

      return message;
    },
    inputTooShort: function (args) {
      var remainingChars = args.minimum - args.input.length;

      var message = 'Ø§Ù„Ø±Ø¬Ø§Ø¡ Ø¥Ø¶Ø§ÙØ© ' + remainingChars + ' Ø¹Ù†Ø§ØµØ±';

      return message;
    },
    loadingMore: function () {
      return 'Ø¬Ø§Ø±ÙŠ ØªØ­Ù…ÙŠÙ„ Ù†ØªØ§Ø¦Ø¬ Ø¥Ø¶Ø§ÙÙŠØ©...';
    },
    maximumSelected: function (args) {
      var message = 'ØªØ³ØªØ·ÙŠØ¹ Ø¥Ø®ØªÙŠØ§Ø± ' + args.maximum + ' Ø¨Ù†ÙˆØ¯ ÙÙ‚Ø·';

      return message;
    },
    noResults: function () {
      return 'Ù„Ù… ÙŠØªÙ… Ø§Ù„Ø¹Ø«ÙˆØ± Ø¹Ù„Ù‰ Ø£ÙŠ Ù†ØªØ§Ø¦Ø¬';
    },
    searching: function () {
      return 'Ø¬Ø§Ø±ÙŠ Ø§Ù„Ø¨Ø­Ø«â€¦';
    }
  };
});